<?php
/**
 * 	API Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class api {

	/*
		1	= Guest/Basic
		2	= Admin
	*/
	private $access_level = 0;

	function __construct() {
	
	}
	
	//receives incoming json connection
	public function receive($array) {
	
		if (!isset($array['data'])) {
			return json_encode(array());
		}
	
		$receive_array = json_decode($array['data'], true);

		$return_array = array();

		if (is_array($receive_array)) {

			if (isset($receive_array['api_version'])) {
			
				switch ($receive_array['api_version']) {
				
					case 1:
						$return_array = $this->version_1($receive_array);
					break;
				
				}
			
			}
		}
			
		return json_encode($return_array);
		
	}
	
	//API Version 1
	private function version_1($array) {
		$plugins				= &singleton::get(__NAMESPACE__ . '\plugins');
	
		if ($this->authenticate($array)) {
						
			$return = array();
			
			if (isset($array['api_action'])) {
				switch ($array['api_action']) {

					case 'add_user':
						$return = $this->add_user($array);
					break;
				
					case 'add_ticket_guest':
						$return = $this->add_ticket_guest($array);
					break;
					
					case 'get_ticket_priorities':
						$return = $this->get_ticket_priorities();
					break;

					case 'get_ticket_departments':
						$return = $this->get_ticket_departments();
					break;
					
					case 'authenticate':
						$return = $this->login($array);
					break;
					
					default:
						if ($plugins->run('api_hook_authenticated_' . $array['api_action'], $array)) {
							$return = $array['return'];
						}
						else {
							if ($plugins->run('api_default_action', $array)) {
								$return = $array['return'];
							}
							else {
								$return = array('message' => 'Unknown Call', 'success' => false);
							}
						}
					break;
				
				}
			}
			else {
				$return = array('message' => 'Unknown Call', 'success' => false);		
			}					
		}
		else {
			if ($plugins->run('api_hook_unauthenticated_' . $array['api_action'], $array)) {
				$return = $array['return'];
			}
			else {
				if ($plugins->run('api_unauthenticate_action', $array)) {
					$return = $array['return'];
				}
				else {
					$return = array('message' => 'Login Failed', 'success' => false);
				}
			}
		}
		
		return $return;

	}
	
	private function get_ticket_priorities($get_array = NULL) {
	
		$ticket_priorities			= &singleton::get(__NAMESPACE__ . '\ticket_priorities');

		$array = $ticket_priorities->get(array('enabled' => 1));
		
		$return = array();
		foreach($array as $item) {
			$return[] = array('name' => $item['name'], 'id' => $item['id']);
		}
		
		return $return;

	}
	
	private function get_ticket_departments($get_array = NULL) {
	
		$ticket_departments			= &singleton::get(__NAMESPACE__ . '\ticket_departments');

		$array = $ticket_departments->get(array('enabled' => 1, 'public_view' => 1));
		
		$return = array();
		foreach($array as $item) {
			$return[] = array('name' => $item['name'], 'id' => $item['id']);
		}
		
		return $return;
	}
	
	private function add_ticket_guest($array) {
		$success 	= false;
			
		$config					= &singleton::get(__NAMESPACE__ . '\config');
		$users					= &singleton::get(__NAMESPACE__ . '\users');
		$ticket_departments		= &singleton::get(__NAMESPACE__ . '\ticket_departments');
		$tickets				= &singleton::get(__NAMESPACE__ . '\tickets');
		$language				= &singleton::get(__NAMESPACE__ . '\language');
			
		if (isset($array['name']) && !empty($array['name'])) {
			if (isset($array['subject']) && !empty($array['subject'])) {
				if (isset($array['description']) && !empty($array['description'])) {
					if (isset($array['email']) && !empty($array['email']) && check_email_address($array['email'])) {

						$access_key = rand_str(32);
						
						$add_array = 
							array(
								'subject'			=> $array['subject'],
								'description'		=> $array['description'],
								'name'				=> $array['name'],
								'email'				=> $array['email'],
								'access_key'		=> $access_key,
								'html'				=> 0
							);
						
						if ($config->get('html_enabled') && isset($array['html']) && $array['html'] == 1) {
							$add_array['html'] = 1;
						}
						
						$clients 					= $users->get(array('email' => $array['email'], 'limit' => 1));
						if (count($clients) == 1) {
							$add_array['user_id']	= $clients[0]['id'];
						}
						
						if (isset($array['priority_id'])) {
							$add_array['priority_id']	= (int) $array['priority_id'];
						}
						
						if (isset($array['department_id']) && ($array['department_id'] != '')) {
							if ($ticket_departments->count(array('id' => $array['department_id'], 'public_view' => 1)) > 0) {
								$add_array['department_id']	= (int) $array['department_id'];
							}
						}
									
						$id = $tickets->add($add_array);
						
						$message 	= $language->get('Ticket Created');
						$success 	= true;
						
						return array('message' => $message, 'success' => $success, 'id' => $id);
					}
					else {
						$message = $language->get('Email Address Invalid');
					}
				}
				else {
					$message = $language->get('Description Empty');					
				}
			}
			else {
				$message = $language->get('Subject Empty');
			}
		}
		else {
			$message = $language->get('Name Empty');
		}
		
		return array('message' => $message, 'success' => $success);
	}
	
	private function add_user($array) {
		$users					= &singleton::get(__NAMESPACE__ . '\users');

		if ($this->access_level == 2) {	
			$result = $users->add_user($array);

			return $result;
		}
		else {
			return array('message' => 'Permission Denied', 'success' => false);		
		}
	}
	
	private function authenticate($array) {
		$api_keys					= &singleton::get(__NAMESPACE__ . '\api_keys');
						
		if (isset($array['api_key']) && !empty($array['api_key'])) {

			$keys = $api_keys->get(array('where' => array('key' => $array['api_key'])));
						
			if (!empty($keys)) {
				$this->access_level = (int) $keys[0]['access_level'];
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}

	}
	
	private function login($array) {
		$auth					= &singleton::get(__NAMESPACE__ . '\auth');

		if ($auth->login(array('username' => $array['username'], 'password' => $array['password']))) {
			$send_array['success'] 	= true;
			$send_array['name'] 	= $_SESSION['user_data']['name'];
			$send_array['email'] 	= $_SESSION['user_data']['email'];
			$send_array['id'] 		= $_SESSION['user_data']['id'];
			$send_array['message'] 	= 'Login Success';
			
			return $send_array;
		}
		else {
			return array('message' => 'Login Failed', 'success' => false);		
		}
	}
	
	public function get_access_level() {
		return $this->access_level;
	}
}

?>
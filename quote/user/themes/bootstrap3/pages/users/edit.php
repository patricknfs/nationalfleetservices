<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Edit User'));
$site->set_config('container-type', 'container');

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

$user_id = (int) $url->get_item();

if ($user_id == 0) {
	header('Location: ' . $config->get('address') . '/users/');
	exit;
}

$users_array = $users->get(array('id' => $user_id));

if (count($users_array) == 1) {
	$user = $users_array[0];
}
else {
	header('Location: ' . $config->get('address') . '/users/');
	exit;
}

$edit_user = true;

if (isset($_POST['save'])) {
	if (!empty($_POST['name'])) {
		if (empty($_POST['email']) || check_email_address($_POST['email'])) {
			if (empty($_POST['username']) || !$users->check_username_taken(array('username' => $_POST['username'], 'id' => $user_id))) {			
				$edit_array = 
					array(
						'id'					=> $user_id,
						'name' 					=> $_POST['name'], 
						'email' 				=> $_POST['email'],
						'address'				=> $_POST['address'],
						'phone_number'			=> $_POST['phone_number'],
						'email_notifications'	=> $_POST['email_notifications'] ? 1 : 0
					);
					
				if ($config->get('pushover_enabled') && isset($_POST['pushover_key'])) {
					$edit_array['pushover_key']	= $_POST['pushover_key'];
				}
				
				if (isset($_POST['company_id'])) {
					$edit_array['company_id']	= (int) $_POST['company_id'];				
				}
			
				if ($_POST['allow_login'] == 1) {
					$edit_array['user_level']			= (int) $_POST['user_level'];
					$edit_array['allow_login'] 			= 1;
					$edit_array['username'] 			= $_POST['username'];
					
					if (SAAS_MODE) {
						if ($user['user_level'] == 0 || $user['user_level'] == 1) {
							if ($edit_array['user_level'] != 0 && $edit_array['user_level'] != 1) {
								if ($users->count(array('user_levels' => array('2,3,4,5,6'))) >= SAAS_MAX_USERS) {
									$edit_user				= false;
									$message				= $language->get('Maximum number of paid users reached');
								}
							}
						}
					}
					
					if (empty($_POST['username'])) {
						$edit_user				= false;
						$message = $language->get('Username Empty');						
					}
					else {
						if ((int) $_POST['authentication_id'] == 1) {
							$edit_array['authentication_id']	= 1;

							if (!empty($_POST['password']) && ($_POST['password'] == $_POST['password2'])) {
								$edit_array['password']	= $_POST['password'];
							}
							else if (empty($_POST['password'])) {
								//don't change password
							}
							else {
								$edit_user				= false;
								$message = $language->get('Invalid Password');
							}
						}
						else if((int) $_POST['authentication_id'] == 2 || (int) $_POST['authentication_id'] == 3 || (int) $_POST['authentication_id'] == 4) {
							$edit_array['authentication_id']	= (int) $_POST['authentication_id'];
						}
					}
				}
				else {
					$edit_array['password'] 		= '';
					$edit_array['user_level'] 		= 0;
					$edit_array['allow_login'] 		= 0;					
				}
				
				if ($edit_user) {
					$users->edit($edit_array);
					
					$users_to_departments->delete(array('user_id' => $user_id));
				
					if (isset($_POST['departments']) && !empty($_POST['departments'])) {
						foreach($_POST['departments'] as $department) {
							$users_to_departments->add(array('user_id' => $user_id, 'department_id' => (int) $department));
						}
					}
							
					header('Location: ' . $config->get('address') . '/users/view/' . $user_id . '/');
					exit;
				}
			}
			else {
				$message = $language->get('Username In Use');
			}
		}
		else {
			$message = $language->get('Email Address Invalid');
		}
	}
	else {
		$message = $language->get('Name Empty');
	}
}


if (isset($_POST['delete'])) {
	if ($auth->get('id') !== $user['id']) {
		$users->delete(array('id' => $user_id));
		header('Location: ' . $config->get('address') . '/users/');
		exit;
	}
}

$departments 	= $ticket_departments->get(array('get_other_data' => true, 'user_id' => $user_id));

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<div class="row">
	<script type="text/javascript">
		$(document).ready(function () {
			$('#delete').click(function () {
				if (confirm("<?php echo safe_output($language->get('Are you sure you wish to delete this user?')); ?>")){
					return true;
				}
				else{
					return false;
				}
			});
		});
	</script>
	
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div class="col-md-3">
			<div class="well well-sm">
				<div class="pull-left">
					<h4><?php echo safe_output($language->get('User')); ?></h4>
				</div>
				<div class="pull-right">
					<p>
						<button type="submit" name="save" class="btn btn-primary"><?php echo safe_output($language->get('Save')); ?></button>
						<a href="<?php echo $config->get('address'); ?>/users/view/<?php echo (int) $user['id']; ?>/" class="btn btn-default"><?php echo safe_output($language->get('Cancel')); ?></a>
					</p>
				</div>
				
				<div class="clearfix"></div>
			
				<div class="pull-right">
					<?php if ($auth->get('id') == $user['id']) { ?>
						<p><?php echo safe_output($language->get('You cannot delete yourself.')); ?></p>
					<?php } else { ?>
						<p class="seperator"><button type="submit" id="delete" name="delete" class="btn btn-danger"><?php echo safe_output($language->get('Delete')); ?></button></p>		
					<?php } ?>
				</div>
				
				<div class="clearfix"></div>

			</div>
		</div>

		<div class="col-md-9">
		
			<?php if (isset($message)) { ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php echo html_output($message); ?>
				</div>
			<?php } ?>
		
			<div class="well well-sm">	
				
				<p><?php echo safe_output($language->get('Full Name')); ?><br /><input type="text" name="name" size="20" value="<?php echo safe_output($user['name']); ?>" /></p>
				
				<?php $plugins->run('edit_user_form_after_name', $user); ?>
				
				<p><?php echo safe_output($language->get('Email Address (recommended)')); ?><br /><input type="text" name="email" size="30" value="<?php echo safe_output($user['email']); ?>" /></p>

				<p><?php echo safe_output($language->get('Email Notifications')); ?><br />
				<select name="email_notifications">
					<option value="0"><?php echo safe_output($language->get('Off')); ?></option>
					<option value="1"<?php if ($user['email_notifications'] == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('On')); ?></option>
				</select></p>				

				<p><?php echo safe_output($language->get('Phone Number (optional)')); ?><br /><input type="text" name="phone_number" size="20" value="<?php echo safe_output($user['phone_number']); ?>" /></p>

				<p><?php echo safe_output($language->get('Address (optional)')); ?><br />
					<textarea id="address" name="address" cols="30" rows="5"><?php echo safe_output($user['address']); ?></textarea>
				</p>	

				<p><?php echo safe_output($language->get('Allow Login')); ?><br />
				<select name="allow_login" id="allow_login">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($user['allow_login'] == 1) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>
				
				<div id="login_user_account_form">
					
					<p><?php echo safe_output($language->get('Username')); ?><br /><input type="text" name="username" value="<?php echo safe_output($user['username']); ?>" /></p>
					
					<p><?php echo safe_output($language->get('Authentication Type')); ?><br />
					<select name="authentication_id" id="authentication_id">
						<option value="1"><?php echo safe_output($language->get('Local')); ?></option>
						<?php if (!SAAS_MODE) { ?>
							<option value="2"<?php if ($user['authentication_id'] == 2) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Active Directory')); ?></option>
							<option value="3"<?php if ($user['authentication_id'] == 3) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('LDAP')); ?></option>
						<?php } ?>
						<option value="4"<?php if ($user['authentication_id'] == 4) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('JSON')); ?></option>
					</select></p>
		
					<div id="login_user_password_fields">
						<p><?php echo safe_output($language->get('Password (if blank the password is not changed)')); ?><br /><input type="password" name="password" value="" autocomplete="off" /></p>
						<p><?php echo safe_output($language->get('Password Again')); ?><br /><input type="password" name="password2" value="" autocomplete="off" /></p>
					</div>	
					
					<p><?php echo safe_output($language->get('Permissions')); ?><br />
					<select name="user_level">
						<option value="1"><?php echo safe_output($language->get('Submitter')); ?></option>
						<option value="3"<?php if ($user['user_level'] == 3) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('User')); ?></option>
						<option value="4"<?php if ($user['user_level'] == 4) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Staff')); ?></option>
						<option value="5"<?php if ($user['user_level'] == 5) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Moderator')); ?></option>
						<option value="6"<?php if ($user['user_level'] == 6) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Global Moderator')); ?></option>
						<option value="2"<?php if ($user['user_level'] == 2) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Administrator')); ?></option>
					</select></p>
		
					
					<?php if ($config->get('pushover_enabled')) { ?>
						<p><?php echo $language->get('Pushover Key'); ?><br /><input type="text" name="pushover_key" size="35" value="<?php echo safe_output($user['pushover_key']); ?>" /></p>
					<?php } ?>
				</div>
				
				<p><?php echo safe_output($language->get('Departments')); ?><br />
				<?php foreach ($departments as $department) { ?>
					<?php if ($department['is_user_member']) { ?>
						<input type="checkbox" name="departments[]" value="<?php echo (int) $department['id']; ?>" checked="checked" /> <?php echo safe_output($department['name']); ?><br />
					<?php } else { ?>
						<input type="checkbox" name="departments[]" value="<?php echo (int) $department['id']; ?>" /> <?php echo safe_output($department['name']); ?><br />					
					<?php } ?>
				<?php } ?>
				</p>

				<div class="clearfix"></div>

			</div>
		</div>
	</form>
</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>
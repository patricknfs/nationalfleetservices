<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Tickets'));
$site->set_config('container-type', 'container');

if (isset($_GET['page']) && (int) $_GET['page'] != 0) {
	$page = (int) $_GET['page'];
}
else {
	$page = 1;
}

//mass edit
if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {

	if (isset($_POST['action']) && isset($_POST['selected_tickets']) && is_array($_POST['selected_tickets'])) {
	
		if (is_numeric($_POST['action_id'])) {
			$action_status 		= $ticket_status->get(array('enabled' => 1, 'id' => (int) $_POST['action_id']));
			if (!empty($action_status)) {
				$action_status	= $action_status[0]['name'];
			}
			else {
				$action_status	= '';
			}
		}
	
		unset($_SESSION['merge']);
		
		foreach ($_POST['selected_tickets'] as $mod_ticket) {
			$mod_ticket_id = (int) $mod_ticket;
			
			$allowed = true;
			if ($auth->get('user_level') == 5) {
				if (!$tickets_support->can(array('action' => 'view', 'id' => $mod_ticket_id))) {
					$allowed = false;
				}
			}
			
			if ($allowed) {
				if (is_numeric($_POST['action_id'])) {
					$mod_ticket_array['id']						= $mod_ticket_id;
					$mod_ticket_array['state_id']				= (int) $_POST['action_id'];
					$mod_ticket_array['date_state_changed'] 	= datetime();

					
					$ticket_note['description']			= $language->get('Changed to') . ' ' . $action_status . '.';
					$ticket_note['ticket_id']			= $mod_ticket_id;
					
					$ticket_notes->add($ticket_note);
					$tickets->edit($mod_ticket_array);

					
					unset($mod_ticket_array);			
				}
				else if ($_POST['action_id'] == 'delete') {
					$mod_ticket_array['id']				= $mod_ticket_id;
					$tickets->delete($mod_ticket_array);
					unset($mod_ticket_array);
				}
				else if ($_POST['action_id'] == 'merge') {
					$_SESSION['merge']['ticket_ids'][] = $mod_ticket_id;
				}
			}
		}
		
		if ($_POST['action_id'] == 'merge') {
			if (count($_SESSION['merge']['ticket_ids']) > 1) {
				header('Location: ' . $config->get('address') . '/tickets/merge/');
				exit;
			}
		}
		
	}
}

/*
	Get Tickets
*/

if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) {
	//all tickets
}
else if ($auth->get('user_level') == 5) {
	//moderator
	$t_array['department_or_assigned_or_user_id']	= $auth->get('id');
}
else if ($auth->get('user_level') == 4) {
	//staff
	$t_array['department_or_assigned_or_user_id']	= $auth->get('id');
}
else if ($auth->get('user_level') == 3) {
	//select assigned tickets or personal tickets
	$t_array['assigned_or_user_id'] 		= $auth->get('id');
}
else {
	//sub
	$t_array['user_id'] 					= $auth->get('id');
}

$t_array['get_other_data'] 	= true;
$t_array['limit']			= 50;


/*
	Ticket Filters
	
	It would be nice to clean this up :D
*/

//not needed and breaks filter system
unset($_GET['url']);

//State (open/closed etc) Filter
$state_id_temp = '';
if (isset($_GET['state_id']) && ($_GET['state_id'] != '') && ((int) $_GET['state_id'] != 0)) {
	$t_array['state_id'] 					= (int) $_GET['state_id'];
	$state_id_temp 							= $t_array['state_id'];
	$_SESSION['ticket_view']['state_id'] 	= (int) $_GET['state_id'];
}
else if (isset($_SESSION['ticket_view']['state_id']) && empty($_GET)) {
	$t_array['state_id'] 					= $_SESSION['ticket_view']['state_id'];
	$state_id_temp 							= $t_array['state_id'];
}
else {
	unset($_SESSION['ticket_view']['state_id']);
}

//Department
$department_id_temp = '';
if (isset($_GET['department_id']) && ($_GET['department_id'] != '') && ((int) $_GET['department_id'] != 0)) {
	$t_array['department_id'] 					= (int) $_GET['department_id'];
	$department_id_temp 							= $t_array['department_id'];
	$_SESSION['ticket_view']['department_id'] 	= (int) $_GET['department_id'];
}
else if (isset($_SESSION['ticket_view']['department_id']) && empty($_GET)) {
	$t_array['department_id'] 					= $_SESSION['ticket_view']['department_id'];
	$department_id_temp 							= $t_array['department_id'];
}
else {
	unset($_SESSION['ticket_view']['department_id']);
}

//priority_id
$priority_id_temp = '';
if (isset($_GET['priority_id']) && ($_GET['priority_id'] != '') && ((int) $_GET['priority_id'] != 0)) {
	$t_array['priority_id'] 					= (int) $_GET['priority_id'];
	$priority_id_temp 							= $t_array['priority_id'];
	$_SESSION['ticket_view']['priority_id'] 	= (int) $_GET['priority_id'];
}
else if (isset($_SESSION['ticket_view']['priority_id']) && empty($_GET)) {
	$t_array['priority_id'] 					= $_SESSION['ticket_view']['priority_id'];
	$priority_id_temp 							= $t_array['priority_id'];
}
else {
	unset($_SESSION['ticket_view']['priority_id']);
}

//ticket_id
$ticket_id_temp = '';
if (isset($_GET['ticket_id']) && ($_GET['ticket_id'] != '') && ((int) $_GET['ticket_id'] != 0)) {
	$t_array['id'] 								= (int) $_GET['ticket_id'];
	$ticket_id_temp 							= $t_array['id'];
	$_SESSION['ticket_view']['ticket_id'] 		= (int) $_GET['ticket_id'];
}
else if (isset($_SESSION['ticket_view']['ticket_id']) && empty($_GET)) {
	$t_array['id'] 								= $_SESSION['ticket_view']['ticket_id'];
	$ticket_id_temp 							= $t_array['id'];
}
else {
	unset($_SESSION['ticket_view']['ticket_id']);
}

$user_id_temp 			= '';
$assigned_user_id_temp 	= '';
$company_id_temp 		= '';

if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {
	//company_id
	if (isset($_GET['company_id']) && ($_GET['company_id'] != '') && ((int) $_GET['company_id'] != 0)) {
		$t_array['company_id'] 					= (int) $_GET['company_id'];
		$company_id_temp 						= $t_array['company_id'];
		$_SESSION['ticket_view']['company_id'] 	= (int) $_GET['company_id'];
	}
	else if (isset($_SESSION['ticket_view']['company_id']) && empty($_GET)) {
		$t_array['company_id'] 					= $_SESSION['ticket_view']['company_id'];
		$company_id_temp 						= $t_array['company_id'];
	}
	else {
		unset($_SESSION['ticket_view']['company_id']);
	}
	
	//user_id
	if (isset($_GET['user_id']) && ($_GET['user_id'] != '') && ((int) $_GET['user_id'] != 0)) {
		$t_array['user_id'] 					= (int) $_GET['user_id'];
		$user_id_temp 							= $t_array['user_id'];
		$_SESSION['ticket_view']['user_id'] 	= (int) $_GET['user_id'];
	}
	else if (isset($_SESSION['ticket_view']['user_id']) && empty($_GET)) {
		$t_array['user_id'] 					= $_SESSION['ticket_view']['user_id'];
		$user_id_temp 							= $t_array['user_id'];
	}
	else {
		unset($_SESSION['ticket_view']['user_id']);
	}
	
	//assigned_user_id
	if (isset($_GET['assigned_user_id']) && ($_GET['assigned_user_id'] != '') && ((int) $_GET['assigned_user_id'] != 0)) {
		$t_array['assigned_user_id'] 					= (int) $_GET['assigned_user_id'];
		$assigned_user_id_temp 							= $t_array['assigned_user_id'];
		$_SESSION['ticket_view']['assigned_user_id'] 	= (int) $_GET['assigned_user_id'];
	}
	else if (isset($_SESSION['ticket_view']['assigned_user_id']) && empty($_GET)) {
		$t_array['assigned_user_id'] 					= $_SESSION['ticket_view']['assigned_user_id'];
		$assigned_user_id_temp 							= $t_array['assigned_user_id'];
	}
	else {
		unset($_SESSION['ticket_view']['assigned_user_id']);
	}
}


//limit filter
if (isset($_GET['limit']) && ($_GET['limit'] != '') && ((int) $_GET['limit'] != 0)) {
	$t_array['limit'] 						= (int) $_GET['limit'];
	$_SESSION['ticket_view']['limit'] 		= (int) $_GET['limit'];
}
else if (isset($_SESSION['ticket_view']['limit']) && empty($_GET)) {
	$t_array['limit'] 						= $_SESSION['ticket_view']['limit'];
}
else {
	unset($_SESSION['ticket_view']['limit']);
}

//search
$like_search_temp = '';
if (isset($_GET['like_search']) && ($_GET['like_search'] != '')) {
	$t_array['like_search'] 				= $_GET['like_search'];
	$like_search_temp 						= safe_output($_GET['like_search']);
	$_SESSION['ticket_view']['like_search']	= $_GET['like_search'];
}
else if (isset($_SESSION['ticket_view']['like_search']) && empty($_GET)) {
	$t_array['like_search'] 				= $_SESSION['ticket_view']['like_search'];
	$like_search_temp 						= $t_array['like_search'];
}
else {
	unset($_SESSION['ticket_view']['like_search']);
}

//active status
$active_temp = '';
if (isset($_GET['active']) && ($_GET['active'] != '')) {
	$t_array['active'] 						= (int) $_GET['active'];
	$active_temp 							= (int) $_GET['active'];
	$_SESSION['ticket_view']['active']	= (int) $_GET['active'];
}
else if (isset($_SESSION['ticket_view']['active']) && empty($_GET)) {
	$t_array['active'] 					= (int) $_SESSION['ticket_view']['active'];
	$active_temp 						= (int) $t_array['active'];
}
else {
	unset($_SESSION['ticket_view']['active']);
}

//order by
$order_by_temp = '';
if (isset($_GET['order_by']) && ($_GET['order_by'] != '')) {
	$t_array['order_by'] 					= $_GET['order_by'];
	$order_by_temp 							= safe_output($_GET['order_by']);
	$_SESSION['ticket_view']['order_by']	= $_GET['order_by'];
}
else if (isset($_SESSION['ticket_view']['order_by']) && empty($_GET)) {
	$t_array['order_by'] 				= $_SESSION['ticket_view']['order_by'];
	$order_by_temp 						= $t_array['order_by'];
}
else {
	unset($_SESSION['ticket_view']['order_by']);
}

$order_temp = '';
if (isset($_GET['order']) && ($_GET['order'] != '')) {
	$t_array['order'] 						= $_GET['order'];
	$order_temp 							= safe_output($_GET['order']);
	$_SESSION['ticket_view']['order']		= $_GET['order'];
}
else if (isset($_SESSION['ticket_view']['order']) && empty($_GET)) {
	$t_array['order'] 						= $_SESSION['ticket_view']['order'];
	$order_temp 							= $t_array['order'];
}
else {
	unset($_SESSION['ticket_view']['order']);
}

/*
	Paging Support
*/
$page_array_temp 			= paging_start(array('page' => $page, 'limit' => $t_array['limit']));
$t_array['offset'] 			= $page_array_temp['offset'];

$tickets_array 				= $tickets->get($t_array);

$page_array 				= paging_finish(array('events' => count($tickets_array), 'limit' => $t_array['limit'], 'next_page' => $page_array_temp['next_page']));
$next_page 					= $page_array['next_page'];
$previous_page 				= $page_array_temp['previous_page'];

$upgrade 		= new upgrade();

if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) {
	$users_array	= $users->get();
	//$users_array = array();
}
	
if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) {
	$departments	= $ticket_departments->get(array('enabled' => 1));
} else {
	$departments 	= $ticket_departments->get(array('enabled' => 1, 'get_other_data' => true, 'user_id' => $auth->get('id')));
}

$priorities 	= $ticket_priorities->get(array('enabled' => 1));
$status 		= $ticket_status->get(array('enabled' => 1));

$page_url 		= $config->get('address') 	. '/tickets/' 
				. '?active=' 				. $active_temp 
				. '&amp;state_id=' 			. (int)$state_id_temp 
				. '&amp;priority_id=' 		. (int)$priority_id_temp 
				. '&amp;like_search=' 		. safe_output($like_search_temp) 
				. '&amp;department_id=' 	. safe_output($department_id_temp) 
				. '&amp;company_id=' 		. safe_output($company_id_temp) 
				. '&amp;user_id=' 			. safe_output($user_id_temp) 
				. '&amp;assigned_user_id=' 	. safe_output($assigned_user_id_temp)
				. '&amp;limit=' 			. (int)$t_array['limit'];
				
$page_previous 	= $page_url . '&amp;order_by=' . safe_output($order_by_temp) . '&amp;order=' . safe_output($order_temp) . '&amp;page=' . (int)$previous_page;
$page_next 		= $page_url . '&amp;order_by=' . safe_output($order_by_temp) . '&amp;order=' . safe_output($order_temp) . '&amp;page=' . (int)$next_page;

if ($order_temp == 'asc') {
	$order_reverse = 'desc';
}
else {
	$order_reverse = 'asc';
}

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<div class="row">
	<div class="col-md-3">
		<div class="well well-sm">
			<div class="pull-right">
				<a href="<?php echo $config->get('address'); ?>/tickets/add/" class="btn btn-default"><?php echo safe_output($language->get('Add Ticket')); ?></a>
			</div>
			
			<div class="pull-left">
			<p>
				<a href="<?php echo $config->get('address'); ?>/tickets/?active=1" class="btn btn-info btn-sm"><?php echo safe_output($language->get('Show Open Tickets')); ?></a>	
			</p>
			<p>
				<a href="<?php echo $config->get('address'); ?>/tickets/?active=0" class="btn btn-info btn-sm"><?php echo safe_output($language->get('Show Closed Tickets')); ?></a>
			</p>
			</div>
	
			<div class="clearfix"></div>
		</div>
		<div class="well well-sm">
			<div class="show-filter">
				<div class="pull-right">
					<a href="#" class="btn btn-info" id="show-filter-button"><?php echo safe_output($language->get('Show Filter')); ?></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="filter">
				<form method="get" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>" role="form">
						
					<?php $plugins->run('view_tickets_filter_list_start'); ?>
									
					<div class="form-group">		
						<input type="text" class="form-control" placeholder="<?php echo safe_output($language->get('Search')); ?>" name="like_search" value="<?php if (isset($like_search_temp)) echo safe_output($like_search_temp); ?>" size="10" />
					</div>
					
					<div class="clearfix"></div>
					
					<label class="left-result"><?php echo safe_output($language->get('Type')); ?></label>
					<p class="right-result">
						<select name="active">
							<option value="">&nbsp;</option>
							<option value="1"<?php if ($active_temp === 1) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Open')); ?></option>
							<option value="0"<?php if ($active_temp === 0) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Closed')); ?></option>							
						</select>
					</p>
					<div class="clearfix"></div>
						
				
					<label class="left-result"><?php echo safe_output($language->get('Status')); ?></label>
					<p class="right-result">
						<select name="state_id">
							<option value="">&nbsp;</option>
							<?php foreach ($status as $status_item) { ?>
							<option value="<?php echo (int) $status_item['id']; ?>"<?php if (isset($t_array['state_id']) && ($t_array['state_id'] == $status_item['id'])) { echo ' selected="selected"'; } ?>><?php echo safe_output($status_item['name']); ?></option>
							<?php } ?>
						</select>
					</p>
					<div class="clearfix"></div>
					
					<label class="left-result"><?php echo safe_output($language->get('Priority')); ?></label>
					<p class="right-result">
						<select name="priority_id">
							<option value="">&nbsp;</option>
							<?php foreach ($priorities as $priority) { ?>
							<option value="<?php echo (int) $priority['id']; ?>"<?php if (isset($t_array['priority_id']) && ($t_array['priority_id'] == $priority['id'])) { echo ' selected="selected"'; } ?>><?php echo safe_output($priority['name']); ?></option>
							<?php } ?>
						</select>
					</p>
					<div class="clearfix"></div>
					
					<label class="left-result"><?php echo safe_output($language->get('Department')); ?></label>
					<p class="right-result">
						<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) { ?>
							<select name="department_id" id="update_department_id">
								<option value="">&nbsp;</option>
								<?php foreach ($departments as $department) { ?>
								<option value="<?php echo (int) $department['id']; ?>"<?php if (isset($t_array['department_id']) && ($t_array['department_id'] == $department['id'])) { echo ' selected="selected"'; } ?>><?php echo safe_output($department['name']); ?></option>
								<?php } ?>
							</select>
						<?php } else { ?>
							<select name="department_id" id="update_department_id">
								<option value="">&nbsp;</option>
								<?php foreach ($departments as $department) { ?>
									<?php if ($department['is_user_member'] || $department['public_view']) { ?>
										<option value="<?php echo (int) $department['id']; ?>"<?php if (isset($t_array['department_id']) && ($t_array['department_id'] == $department['id'])) { echo ' selected="selected"'; } ?>><?php echo safe_output($department['name']); ?></option>
									<?php } ?>
								<?php } ?>
							</select>						
						<?php } ?>
					</p>
					<div class="clearfix"></div>

					<?php $plugins->run('view_tickets_filter_list_after_department', $t_array); ?>
					
					<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>			
						<label class="left-result"><?php echo safe_output($language->get('User')); ?></label>
						<p class="right-result">
							<select name="user_id" id="user_id">
								<option value="">&nbsp;</option>
								<?php if ($auth->get('user_level') == 5) { ?>
									<?php if (isset($t_array['user_id'])) { ?>
										<option value="<?php echo (int) $t_array['user_id']; ?>" selected="selected"></option>
									<?php } ?>
								<?php } else { ?>
									<?php foreach ($users_array as $user) { ?>
										<option value="<?php echo (int) $user['id']; ?>"<?php if (isset($t_array['user_id']) && ($t_array['user_id'] == $user['id'])) { echo ' selected="selected"'; } ?>><?php echo safe_output(ucwords($user['name'])); ?></option>
									<?php } ?>
								<?php  } ?>
							</select>
						</p>
						<div class="clearfix"></div>

						<label class="left-result"><?php echo safe_output($language->get('Assigned User')); ?></label>
						<p class="right-result">
							<select name="assigned_user_id" id="assigned_user_id">
								<option value="">&nbsp;</option>
								<?php if ($auth->get('user_level') == 5) { ?>
									<?php if (isset($t_array['assigned_user_id'])) { ?>
										<option value="<?php echo (int) $t_array['assigned_user_id']; ?>" selected="selected"></option>
									<?php } ?>
								<?php } else { ?>
									<?php foreach ($users_array as $user) { ?>
										<option value="<?php echo (int) $user['id']; ?>"<?php if (isset($t_array['assigned_user_id']) && ($t_array['assigned_user_id'] == $user['id'])) { echo ' selected="selected"'; } ?>><?php echo safe_output(ucwords($user['name'])); ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</p>
						<div class="clearfix"></div>
					<?php } ?>
					
					<label class="left-result"><?php echo safe_output($language->get('Sort By')); ?></label>
					<p class="right-result">
						<select name="order_by">
								<option value="">&nbsp;</option>
								<option value="date_added"<?php if ($order_by_temp == 'date_added') echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Added')); ?></option>
								<option value="state_id"<?php if ($order_by_temp == 'state_id') echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Status')); ?></option>
								<option value="priority_id"<?php if ($order_by_temp == 'priority_id') echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Priority')); ?></option>
								<option value="user_id"<?php if ($order_by_temp == 'user_id') echo ' selected="selected"'; ?>><?php echo safe_output($language->get('User')); ?></option>
								<option value="assigned_user_id"<?php if ($order_by_temp == 'assigned_user_id') echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Assigned')); ?></option>
								<option value="last_modified"<?php if ($order_by_temp == 'last_modified') echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Updated')); ?></option>								
								<option value="id"<?php if ($order_by_temp == 'id') echo ' selected="selected"'; ?>><?php echo safe_output($language->get('ID')); ?></option>								
						</select>
					</p>
					<div class="clearfix"></div>

					
					<label class="left-result"><?php echo safe_output($language->get('Sort Order')); ?></label>
					<p class="right-result">
						<select name="order">
								<option value="">&nbsp;</option>
								<option value="asc"<?php if ($order_temp == 'asc') echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Ascending')); ?></option>
								<option value="desc"<?php if ($order_temp == 'desc') echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Descending')); ?></option>							
						</select>
					</p>
					<div class="clearfix"></div>

					
					<label class="left-result"><?php echo safe_output($language->get('Page Limit')); ?></label>
					<p class="right-result">
						<select name="limit">
								<option value="10"<?php if ($t_array['limit'] == 10) echo ' selected="selected"'; ?>>10</option>
								<option value="25"<?php if ($t_array['limit'] == 25) echo ' selected="selected"'; ?>>25</option>
								<option value="50"<?php if ($t_array['limit'] == 50) echo ' selected="selected"'; ?>>50</option>
								<option value="100"<?php if ($t_array['limit'] == 100) echo ' selected="selected"'; ?>>100</option>
								<option value="250"<?php if ($t_array['limit'] == 250) echo ' selected="selected"'; ?>>250</option>		
						</select>
					</p>
					<div class="clearfix"></div>
					
					<?php $plugins->run('view_tickets_filter_list_finish'); ?>
					<br />
					<div class="pull-right">
						<button type="submit" name="filter" class="btn btn-info"><?php echo safe_output($language->get('Filter')); ?></button>
						<a href="<?php echo safe_output($config->get('address')); ?>/tickets/?limit=" class="btn btn-default"><?php echo safe_output($language->get('Clear')); ?></a>
					</div>
					<div class="clearfix"></div>
					
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">
			<?php if (!SAAS_MODE && ($auth->get('user_level') == 2) && (($config->get('database_version') !== $upgrade->get_db_version()) || ($config->get('program_version') !== $upgrade->get_program_version()))) { ?>
			<div class="alert alert-warning">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong><?php echo $language->get('Warning'); ?>:</strong>
				<?php echo html_output($language->get('The database needs upgrading.')); ?>
				<strong><a href="<?php echo safe_output($config->get('address')); ?>/upgrade/"><?php echo safe_output($language->get('Upgrade')); ?></a></strong>
			</div>
			<?php } ?>
			
			<?php $plugins->run('view_tickets_content_start'); ?>
						
			<?php if (!empty($tickets_array)) { ?>

				<?php $plugins->run('view_tickets_content_has_tickets'); ?>
				
				<div class="pull-left">
					<p class="text-muted"><small><?php echo safe_output($language->get('Showing')); ?> <?php echo count($tickets_array); ?> <?php echo safe_output($language->get('Tickets')); ?></small></p>
				</div>
									
				<div class="pull-right">
					<ul class="pagination pagination-sm">
						<li><a href="<?php echo $page_previous; ?>">&laquo; <?php echo safe_output($language->get('Previous')); ?></a></li>
						<li><a href=""><?php echo (int)$page; ?></a></li>
						<li><a href="<?php echo $page_next; ?>"><?php echo safe_output($language->get('Next')); ?> &raquo;</a></li>
					</ul>
				</div>
				
				<div class="clearfix"></div>

				<section id="no-more-tables">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>
									<th><a href="#" class="toggle_all_tickets"><?php echo safe_output($language->get('Toggle')); ?></a></th>
								<?php } ?>
								<th><a href="<?php echo $page_url . '&amp;order_by=date_added&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('Added')); ?></a></th>
								<th><a href="<?php echo $page_url . '&amp;order_by=state_id&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('Status')); ?></a></th>
								<th><a href="<?php echo $page_url . '&amp;order_by=priority_id&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('Priority')); ?></a></th>
								<th><?php echo safe_output($language->get('Subject')); ?></th>
								<th><a href="<?php echo $page_url . '&amp;order_by=user_id&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('User')); ?></a></th>
								<th><a href="<?php echo $page_url . '&amp;order_by=assigned_user_id&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('Assigned')); ?></a></th>
								<th><a href="<?php echo $page_url . '&amp;order_by=last_modified&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('Updated')); ?></a></th>
								<?php $plugins->run('view_tickets_table_header_finish'); ?>
							</tr>
						</thead>
						
						<tfoot>
							<tr>
								<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>
									<th><a href="#" class="toggle_all_tickets"><?php echo safe_output($language->get('Toggle')); ?></a></th>
								<?php } ?>
								<th><a href="<?php echo $page_url . '&amp;order_by=date_added&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('Added')); ?></a></th>
								<th><a href="<?php echo $page_url . '&amp;order_by=state_id&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('Status')); ?></a></th>
								<th><a href="<?php echo $page_url . '&amp;order_by=priority_id&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('Priority')); ?></a></th>
								<th><?php echo safe_output($language->get('Subject')); ?></th>
								<th><a href="<?php echo $page_url . '&amp;order_by=user_id&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('User')); ?></a></th>
								<th><a href="<?php echo $page_url . '&amp;order_by=assigned_user_id&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('Assigned')); ?></a></th>
								<th><a href="<?php echo $page_url . '&amp;order_by=last_modified&amp;order=' . safe_output($order_reverse); ?>"><?php echo safe_output($language->get('Updated')); ?></a></th>
								<?php $plugins->run('view_tickets_table_footer_finish'); ?>
							</tr>
						</tfoot>
						<tbody id="view-tickets-table-body">
							<?php
								$i = 0;
								foreach ($tickets_array as $ticket) {
							?>
							<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
								<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>
									<td data-title="Select">
										<div class="btn-toolbar">
											<div class="btn-group" data-toggle="buttons">
												<label class="btn btn-default btn-xs">
													<input type="checkbox" name="selected_tickets[]" class="selection_checkbox" value="<?php echo (int) $ticket['id']; ?>" id="checkbox_<?php echo (int) $ticket['id']; ?>" />
													<span class="glyphicon glyphicon-check"></span>
												</label>
												<label class="custom_modal btn btn-default btn-xs" data-href="<?php echo $config->get('address'); ?>/tickets/editmodal/<?php echo (int) $ticket['id']; ?>/">
													<span class="glyphicon glyphicon-edit"></span>
												</label>
											</div>
										</div>
									</td>
								<?php } ?>
								<td data-title="<?php echo safe_output($language->get('Added')); ?>"><a href="<?php echo $config->get('address'); ?>/tickets/view/<?php echo (int) $ticket['id']; ?>/"><?php echo safe_output(time_ago_in_words($ticket['date_added'])); ?> <?php echo safe_output($language->get('ago')); ?></a></td>
								<td data-title="<?php echo safe_output($language->get('Status')); ?>" class="<?php if ($ticket['state_id'] == 1) { echo 'ticket-open'; } elseif ($ticket['state_id'] == 2) { echo 'ticket-closed'; } ?> centre" style="background-color: <?php echo safe_output($ticket['status_colour']); ?>"><?php echo safe_output($ticket['status_name']); ?></td>
								<td data-title="<?php echo safe_output($language->get('Priority')); ?>"><?php echo safe_output($ticket['priority_name']); ?></td>
								<td data-title="<?php echo safe_output($language->get('Subject')); ?>"><a href="<?php echo $config->get('address'); ?>/tickets/view/<?php echo (int) $ticket['id']; ?>/"><?php echo safe_output($ticket['subject']); ?></a></td>
								<td data-title="<?php echo safe_output($language->get('Owner')); ?>"><?php echo safe_output(ucwords($ticket['owner_name'])); ?></td>
								<td data-title="<?php echo safe_output($language->get('Assigned')); ?>"><?php echo safe_output(ucwords($ticket['assigned_name'])); ?></td>
								<td data-title="<?php echo safe_output($language->get('Updated')); ?>">
									<a href="<?php echo $config->get('address'); ?>/tickets/view/<?php echo (int) $ticket['id']; ?>/"><?php echo safe_output(time_ago_in_words($ticket['last_modified'])); ?> <?php echo safe_output($language->get('ago')); ?></a>
								</td>
								<?php $plugins->run('view_tickets_table_item_body_finish'); ?>
							</tr>
							<?php $i++; } ?>
						</tbody>
					</table>
				</section>

				<div class="pull-right">
					<ul class="pagination pagination-sm">
						<li><a href="<?php echo $page_previous; ?>">&laquo; <?php echo safe_output($language->get('Previous')); ?></a></li>
						<li><a href=""><?php echo (int)$page; ?></a></li>
						<li><a href="<?php echo $page_next; ?>"><?php echo safe_output($language->get('Next')); ?> &raquo;</a></li>
					</ul>
				</div>	
				<div class="clearfix"></div>
					
				<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>
					<label><?php echo safe_output($language->get('Selected Tickets')); ?></label>
					
					<p>
						<select id="action" name="action_id">
							<option value="">&nbsp;</option>
							<?php foreach($status as $item) { ?>
								<option value="<?php echo (int) $item['id']; ?>"><?php echo safe_output($item['name']); ?></option>
							<?php } ?>
							<option value="merge"><?php echo safe_output($language->get('Merge')); ?></option>
							<option value="delete"><?php echo safe_output($language->get('Delete')); ?></option>
						</select>
					
						<button id="submit" type="submit" name="action" class="btn btn-primary"><?php echo safe_output($language->get('Do')); ?></button>	
					</p>
					<div class="clearfix"></div>
				<?php } ?>
				

			<?php } else { ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Notice:</strong>
					<?php echo html_output($language->get('No Tickets Found.')); ?>
				</div>
			<?php } ?>

			<?php $plugins->run('view_tickets_content_finish'); ?>
			
		</form>
	</div>
</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>
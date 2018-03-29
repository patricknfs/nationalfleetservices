<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Edit Department'));
$site->set_config('container-type', 'container');

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

$id = (int) $url->get_item();

$departments		= $ticket_departments->get(array('id' => $id));
	
if (empty($departments)) {
	header('Location: ' . $config->get('address') . '/settings/tickets/#departments');
	exit;
}

$item = $departments[0];

if (isset($_POST['delete'])) {
	if ($item['id'] != 1) {
		$ticket_departments->delete(array('id' => $item['id']));
		header('Location: ' . $config->get('address') . '/settings/tickets/#departments');
		exit;
	}
}

if (isset($_POST['save'])) {

	if (!empty($_POST['name'])) {
		$add_array['name']				= $_POST['name'];
		$add_array['id']				= $id;
		$add_array['public_view']		= 1;
		if ($item['id'] != 1) {
			$add_array['public_view'] 	= $_POST['public_view'] ? 1 : 0;
		}
	
		$ticket_departments->edit($add_array);
		
		$user_levels_to_department_notifications->delete(array('columns' => array('department_id' => $id)));
		
		if (!empty($_POST['new_department_ticket'])) {
			foreach ($_POST['new_department_ticket'] as $user_level) {
				$user_levels_to_department_notifications->add(array('columns' => array('department_id' => $id, 'user_level' => (int) $user_level, 'type' => 'new_department_ticket')));
			}
		}
		
		if (!empty($_POST['new_department_ticket_reply'])) {
			foreach ($_POST['new_department_ticket_reply'] as $user_level) {
				$user_levels_to_department_notifications->add(array('columns' => array('department_id' => $id, 'user_level' => (int) $user_level, 'type' => 'new_department_ticket_reply')));
			}
		}
		
		
		header('Location: ' . $config->get('address') . '/settings/tickets/#departments');
		exit;
		//$message = $language->get('Saved');
		
	}
	else {
		$message = $language->get('Name empty');
	}
	$departments	= $ticket_departments->get(array('id' => $id));
	$item 			= $departments[0];
}

$users_array = $users->get(array('department_id' => $id));

$notifications_array = $user_levels_to_department_notifications->get(array('where' => array('department_id' => $item['id'], 'type' => 'new_department_ticket')));

$new_array = array();
foreach($notifications_array as $x) {
	$new_array[] = $x['user_level'];
}

$notifications_array = $user_levels_to_department_notifications->get(array('where' => array('department_id' => $item['id'], 'type' => 'new_department_ticket_reply')));

$reply_array = array();
foreach($notifications_array as $i) {
	$reply_array[] = $i['user_level'];
}

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>

<script type="text/javascript">
	$(document).ready(function () {
		$('#delete').click(function () {
			if (confirm("<?php echo safe_output($language->get('Are you sure you wish to delete this Department?')); ?>")){
				return true;
			}
			else{
				return false;
			}
		});
	});
</script>

<div class="row">
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div class="col-md-3">
			<div class="well well-sm">
				<div class="pull-left">
					<h4><?php echo safe_output($language->get('Department')); ?></h4>
				</div>
			
				
				<div class="pull-right">
					<p>
						<button type="submit" name="save" class="btn btn-primary"><?php echo safe_output($language->get('Save')); ?></button>
						<a href="<?php echo $config->get('address'); ?>/settings/tickets/#departments" class="btn btn-default"><?php echo safe_output($language->get('Cancel')); ?></a>
					</p>
				</div>
					
				<div class="clearfix"></div>	
				
				<?php if ($item['id'] != 1) { ?>
					<br />
					<div class="pull-right"><button type="submit" id="delete" name="delete" class="btn btn-danger"><?php echo safe_output($language->get('Delete')); ?></button></div>
					<div class="clearfix"></div>
				<?php } else { ?>
					<br />
					<div class="pull-right">
					<?php echo safe_output($language->get('Default Department cannot be deleted.')); ?>
					</div>
					<div class="clearfix"></div>
					
				<?php } ?>

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
				
				<p><?php echo $language->get('Name'); ?><br /><input type="text" name="name" value="<?php echo safe_output($item['name']); ?>" size="30" /></p>

				<?php if ($item['id'] != 1) { ?>
					<p><?php echo safe_output($language->get('Public')); ?><br />
					<select name="public_view">
						<option value="0"><?php echo safe_output($language->get('No')); ?></option>
						<option value="1"<?php if ($item['public_view'] == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
					</select></p>	
				<?php } else { ?>
					<p><?php echo safe_output($language->get('Default Department must be public.')); ?>
					<input name="public_view" type="hidden" value="1" /></p>
				<?php } ?>


			</div>
			
			<div class="well well-sm">
				<h3><?php echo $language->get('Notifications'); ?></h3>
				
				<p><?php echo safe_output($language->get('On top of the normal email notifications you can send notices to the following user groups within the department.')); ?></p>

				<p><strong><?php echo safe_output($language->get('New Department Ticket')); ?></strong></p>
			
				<p>
				<input type="checkbox" name="new_department_ticket[]" value="4" <?php if (in_array(4, $new_array)) echo 'checked="checked"'; ?> /> <?php echo safe_output($language->get('Staff')); ?><br />
				<input type="checkbox" name="new_department_ticket[]" value="5" <?php if (in_array(5, $new_array)) echo 'checked="checked"'; ?> /> <?php echo safe_output($language->get('Moderator')); ?><br />
				<input type="checkbox" name="new_department_ticket[]" value="6" <?php if (in_array(6, $new_array)) echo 'checked="checked"'; ?> /> <?php echo safe_output($language->get('Global Moderator')); ?><br />
				<input type="checkbox" name="new_department_ticket[]" value="2" <?php if (in_array(2, $new_array)) echo 'checked="checked"'; ?> /> <?php echo safe_output($language->get('Administrator')); ?><br />
				</p>
				
				<p><strong><?php echo safe_output($language->get('New Department Ticket Reply')); ?></strong></p>

				<p>
				<input type="checkbox" name="new_department_ticket_reply[]" value="4" <?php if (in_array(4, $reply_array)) echo 'checked="checked"'; ?>> <?php echo safe_output($language->get('Staff')); ?><br />
				<input type="checkbox" name="new_department_ticket_reply[]" value="5" <?php if (in_array(5, $reply_array)) echo 'checked="checked"'; ?>> <?php echo safe_output($language->get('Moderator')); ?><br />
				<input type="checkbox" name="new_department_ticket_reply[]" value="6" <?php if (in_array(6, $reply_array)) echo 'checked="checked"'; ?>> <?php echo safe_output($language->get('Global Moderator')); ?><br />
				<input type="checkbox" name="new_department_ticket_reply[]" value="2" <?php if (in_array(2, $reply_array)) echo 'checked="checked"'; ?>> <?php echo safe_output($language->get('Administrator')); ?><br />
				</p>
				
			</div>
			
			<?php if (!empty($users_array)) { ?>
				<div class="well well-sm">
					<h3><?php echo $language->get('Members'); ?></h3>
						
					<section id="no-more-tables">										
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th><?php echo $language->get('Name'); ?></th>
									<th><?php echo $language->get('Permissions'); ?></th>
								</tr>
							</thead>
							
							<tbody>
								<?php $i = 0; 
									foreach($users_array as $user) { ?>
									<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
										<td data-title="Name" class="centre"><a href="<?php echo $config->get('address'); ?>/users/view/<?php echo (int) $user['id']; ?>/"><?php echo safe_output($user['name']); ?></a></td>
										<td data-title="Permissions" class="centre">
										<?php switch($user['user_level']) {
											case 1:
												echo safe_output($language->get('Submitter'));
											break;
											case 2:
												echo safe_output($language->get('Administrator'));
											break;
											case 3:
												echo safe_output($language->get('User'));
											break;
											case 4:
												echo safe_output($language->get('Staff'));
											break;
											case 5:
												echo safe_output($language->get('Moderator'));
											break;
											case 6:
												echo safe_output($language->get('Global Moderator'));
											break;					
										}
										?>
										</td>
									</tr>
								<?php $i++; } ?>
							</tbody>
						</table>
					</section>
					
				</div>
			<?php } ?>
				
			<div class="clearfix"></div>

		</div>

	</form>
</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>
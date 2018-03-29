<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Add Department'));
$site->set_config('container-type', 'container');

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_POST['add'])) {
	if (!empty($_POST['name'])) {		
		$add_array['name']				= $_POST['name'];
		$add_array['enabled']			= 1;
		$add_array['public_view'] 		= $_POST['public_view'] ? 1 : 0;
			
		$id = $ticket_departments->add($add_array);
		
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
		
	}
	else {
		$message = $language->get('Name Empty');
	}
}

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<div class="row">
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div class="col-md-3">
			<div class="well well-sm">
				<div class="pull-left">
					<h4><?php echo safe_output($language->get('Department')); ?></h4>
				</div>
			
				
				<div class="pull-right">
					<p>
					<button type="submit" name="add" class="btn btn-primary"><?php echo safe_output($language->get('Add')); ?></button>
					<a href="<?php echo $config->get('address'); ?>/settings/tickets/#departments" class="btn btn-default"><?php echo safe_output($language->get('Cancel')); ?></a>
					</p>
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

				<div class="clear"></div>
				
				<p><?php echo $language->get('Name'); ?><br /><input type="text" required name="name" value="<?php if (isset($_POST['name'])) echo safe_output($_POST['name']); ?>" size="30" /></p>

				<p><?php echo safe_output($language->get('Public')); ?><br />
				<select name="public_view">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if (isset($_POST['public_view']) && ($_POST['public_view'] == 1)) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>	
	
			</div>

			<div class="well well-sm">
				<h3><?php echo $language->get('Notifications'); ?></h3>
				
				<p><?php echo safe_output($language->get('On top of the normal email notifications you can send notices to the following user groups within the department.')); ?></p>

				<p><strong><?php echo safe_output($language->get('New Department Ticket')); ?></strong></p>
			
				<p>
				<input type="checkbox" name="new_department_ticket[]" value="4" <?php if (isset($_POST['new_department_ticket']) && in_array(4, $_POST['new_department_ticket'])) echo 'checked="checked"'; ?> /> <?php echo safe_output($language->get('Staff')); ?><br />
				<input type="checkbox" name="new_department_ticket[]" value="5" <?php if (isset($_POST['new_department_ticket']) && in_array(5, $_POST['new_department_ticket'])) echo 'checked="checked"'; ?> /> <?php echo safe_output($language->get('Moderator')); ?><br />
				<input type="checkbox" name="new_department_ticket[]" value="6" <?php if (isset($_POST['new_department_ticket']) && in_array(6, $_POST['new_department_ticket'])) echo 'checked="checked"'; ?> /> <?php echo safe_output($language->get('Global Moderator')); ?><br />
				<input type="checkbox" name="new_department_ticket[]" value="2" <?php if (isset($_POST['new_department_ticket']) && in_array(2, $_POST['new_department_ticket'])) echo 'checked="checked"'; ?> /> <?php echo safe_output($language->get('Administrator')); ?><br />
				</p>
				
				<p><strong><?php echo safe_output($language->get('New Department Ticket Reply')); ?></strong></p>

				<p>
				<input type="checkbox" name="new_department_ticket_reply[]" value="4" <?php if (isset($_POST['new_department_ticket_reply']) && in_array(4, $_POST['new_department_ticket_reply'])) echo 'checked="checked"'; ?>> <?php echo safe_output($language->get('Staff')); ?><br />
				<input type="checkbox" name="new_department_ticket_reply[]" value="5" <?php if (isset($_POST['new_department_ticket_reply']) && in_array(5, $_POST['new_department_ticket_reply'])) echo 'checked="checked"'; ?>> <?php echo safe_output($language->get('Moderator')); ?><br />
				<input type="checkbox" name="new_department_ticket_reply[]" value="6" <?php if (isset($_POST['new_department_ticket_reply']) && in_array(6, $_POST['new_department_ticket_reply'])) echo 'checked="checked"'; ?>> <?php echo safe_output($language->get('Global Moderator')); ?><br />
				<input type="checkbox" name="new_department_ticket_reply[]" value="2" <?php if (isset($_POST['new_department_ticket_reply']) && in_array(2, $_POST['new_department_ticket_reply'])) echo 'checked="checked"'; ?>> <?php echo safe_output($language->get('Administrator')); ?><br />
				</p>
				
			</div>
			
			<div class="clearfix"></div>

		</div>

	</form>
</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>
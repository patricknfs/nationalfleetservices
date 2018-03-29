<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Add Status'));
$site->set_config('container-type', 'container');

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_POST['add'])) {
	if (!empty($_POST['name'])) {
		$add_array['name']				= $_POST['name'];
		$add_array['colour']			= $_POST['colour'];
		$add_array['active']			= $_POST['active'] ? 1 : 0;
		$add_array['enabled']			= 1;

		$id = $ticket_status->add($add_array);
	
		header('Location: ' . $config->get('address') . '/settings/tickets/#status');
		
	}
	else {
		$message = $language->get('Name Empty');
	}
}



include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<link rel="stylesheet" href="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/css/colorpicker.css" type="text/css" />	
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/js/colourpicker.js"></script>

<div class="row">
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div class="col-md-3">
			<div class="well well-sm">
				<div class="pull-left">
					<h4><?php echo safe_output($language->get('Status')); ?></h4>
				</div>
			
				
				<div class="pull-right">
					<p>
					<button type="submit" name="add" class="btn btn-primary"><?php echo safe_output($language->get('Add')); ?></button>
					<a href="<?php echo $config->get('address'); ?>/settings/tickets/#status" class="btn btn-default"><?php echo safe_output($language->get('Cancel')); ?></a>
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
				
				<p><?php echo $language->get('Name'); ?><br /><input type="text" name="name" value="<?php if (isset($_POST['name'])) echo safe_output($_POST['name']); ?>" size="30" /></p>
			
				<p><?php echo $language->get('Colour'); ?><br />
				<input type="text" name="colour" id="cp1" value="<?php if (isset($_POST['colour'])) echo safe_output($_POST['colour']); ?>" maxlength="7" class="input-small">
				</p>
				
				<p><?php echo $language->get('Type'); ?><br />
					<select name="active">
						<option value="1"<?php if (isset($_POST['active']) && $_POST['active'] == '1') { echo ' selected="selected"'; } ?>><?php echo $language->get('Open'); ?></option>
						<option value="0"<?php if (isset($_POST['active']) && $_POST['active'] == '0') { echo ' selected="selected"'; } ?>><?php echo $language->get('Closed'); ?></option>
					</select>
				</p>
				

			</div>
				
			<div class="clearfix"></div>

		</div>

	</form>
</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>
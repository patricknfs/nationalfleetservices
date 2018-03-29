<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Add API Key'));
$site->set_config('container-type', 'container');

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_POST['add'])) {
	if (!empty($_POST['name'])) {	
		if (!empty($_POST['key'])) {
			$add_array['name']				= $_POST['name'];
			$add_array['date_added'] 		= datetime();
			$add_array['key']				= $_POST['key'];
			$add_array['access_level']		= (int) $_POST['access_level'];

			
			$id = $api_keys->add(array('columns' => $add_array));
		
			header('Location: ' . $config->get('address') . '/settings/api/');
		}
		else {
			$message = $language->get('Key Empty');
		}
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
				<div class="pull-right">
					<p>
					<button type="submit" name="add" class="btn btn-primary"><?php echo safe_output($language->get('Add')); ?></button>
					<a href="<?php echo $config->get('address'); ?>/settings/api/" class="btn btn-default"><?php echo safe_output($language->get('Cancel')); ?></a>
					</p>
				</div>
				
				<div class="pull-left">
					<h4><?php echo safe_output($language->get('API Key')); ?></h4>
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

				<p><?php echo safe_output($language->get('Access Level')); ?><br />
				<select name="access_level">
					<option value="1"<?php if (isset($_POST['access_level']) && $_POST['access_level'] == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Guest')); ?></option>
					<option value="2"<?php if (isset($_POST['access_level']) && $_POST['access_level'] == 2) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Admin')); ?></option>
				</select></p>			
				
				<p><?php echo $language->get('Key'); ?><br /><input type="text" name="key" value="<?php if (isset($_POST['key'])) { echo safe_output($_POST['key']); } else { echo safe_output(uuid()); } ?>" size="40" /></p>				
		
			</div>
				
		</div>

	</form>
</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>
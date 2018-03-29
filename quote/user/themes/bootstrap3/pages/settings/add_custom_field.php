<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Custom Fields'));
$site->set_config('container-type', 'container');

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_POST['add'])) {
	if (!empty($_POST['name'])) {
		$add_array['type']				= $_POST['type'];
		$add_array['name']				= $_POST['name'];
		$add_array['client_modify']		= 1;
		$add_array['enabled']			= $_POST['enabled'] ? 1 : 0;

		$id = $ticket_custom_fields->add_group($add_array);
		
		if ($add_array['type'] == 'dropdown') {
			foreach($_POST['dropdown_field'] as $index => $value){
				if (!empty($value)) {
					$ticket_custom_fields->add_field(array('ticket_field_group_id' => $id, 'value' => $value));
				}
			}
		}
		
		header('Location: ' . $config->get('address') . '/settings/tickets/#custom_fields');
		
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
				<h4><?php echo safe_output($language->get('Custom Fields')); ?></h4>
			</div>
		
			
			<div class="pull-right">
				<p>
				<button type="submit" name="add" class="btn btn-primary"><?php echo safe_output($language->get('Add')); ?></button>
				<a href="<?php echo $config->get('address'); ?>/settings/tickets/#custom_fields" class="btn btn-default"><?php echo safe_output($language->get('Cancel')); ?></a>
				</p>
			</div>
				
			<div class="clearfix"></div>	
			
			<p><?php echo $language->get('Custom Fields allow you to add extra global fields to your tickets.'); ?></p>
			<h4><?php echo $language->get('Input Options'); ?></h4>
			<ul>
				<li><?php echo $language->get('Text Input (single line of text).'); ?></li>
				<li><?php echo $language->get('Text Area (multiple lines of text).'); ?></li>
				<li><?php echo $language->get('Dropdown box with options.'); ?></li>
			</ul>

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
			
			<p><?php echo $language->get('Name'); ?><br /><input type="text" name="name" value="<?php if (isset($_POST['name'])) echo safe_output($_POST['name']); ?>" size="30" /></p>
			
			<p><?php echo $language->get('Enabled'); ?><br />
				<select name="enabled">
					<option value="0"<?php if (isset($_POST['enabled']) && $_POST['enabled'] == '0') { echo ' selected="selected"'; } ?>><?php echo $language->get('No'); ?></option>
					<option value="1"<?php if (isset($_POST['enabled']) && $_POST['enabled'] == '1') { echo ' selected="selected"'; } ?>><?php echo $language->get('Yes'); ?></option>
				</select>
			</p>
			
			<p><?php echo $language->get('Input Type'); ?><br />
				<select name="type" id="custom_field_type">
					<option value="textinput"<?php if (isset($_POST['type']) && $_POST['type'] == 'textinput') { echo ' selected="selected"'; } ?>><?php echo $language->get('Text Input'); ?></option>
					<option value="textarea"<?php if (isset($_POST['type']) && $_POST['type'] == 'textarea') { echo ' selected="selected"'; } ?>><?php echo $language->get('Text Area'); ?></option>
					<option value="dropdown"<?php if (isset($_POST['type']) && $_POST['type'] == 'dropdown') { echo ' selected="selected"'; } ?>><?php echo $language->get('Drop Down'); ?></option>
				</select>
			</p>
			
			<div id="dropdown_fields">
				<br />
				<h3><a name="add_dropdown"></a><?php echo $language->get('Dropdown Fields'); ?> <a id="add_dropdown_field" href="#add_dropdown" class="btn btn-info"><?php echo $language->get('Add'); ?></a></h3>
				<div class="dropdown_field">
					<p><?php echo $language->get('Option'); ?><br /><input type="text" name="dropdown_field[]" value="" size="30" /></p>
				</div>
				<div class="extra_dropdown_field"></div>
			</div>

		</div>
			
		<div class="clearfix"></div>

	</div>

	</form>
</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>
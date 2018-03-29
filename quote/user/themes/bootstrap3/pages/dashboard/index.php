<?php
namespace sts;
use sts as core;

$site->set_title('Dashboard');
$site->set_config('container-type', 'container');

$your_open_tickets = $tickets->count(array('user_id' => $auth->get('id'), 'get_other_data' => true, 'active' => 1));
$assigned_open_tickets = $tickets->count(array('assigned_user_id' => $auth->get('id'), 'get_other_data' => true, 'active' => 1));

$plugins->run('view_dashboard_header_start');

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<div class="row">

	<?php $plugins->run('view_dashboard_container_start'); ?>

	<div class="col-md-3">
		<div class="well well-sm">
			<div class="pull-left">
				<h4><?php echo $language->get('Dashboard'); ?></h4>
			</div>
			<div class="pull-right">
				<div class="btn-group">
					<a href="<?php echo safe_output($config->get('address')); ?>/profile/" class="btn btn-default btn-sm"><?php echo safe_output($language->get('View Profile')); ?></a>
				</div>							
			</div>
			<div class="clearfix"></div>

			
			<label class="left-result"><?php echo safe_output($language->get('Name')); ?></label>
			<p class="right-result"><?php echo safe_output($auth->get('name')); ?></p>
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('Username')); ?></label>
			<p class="right-result"><?php echo safe_output($auth->get('username')); ?></p>
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('Email')); ?></label>
			<p class="right-result"><?php echo safe_output($auth->get('email')); ?></p>
			<div class="clearfix"></div>

			<label class="left-result"><?php echo safe_output($language->get('Private Messages')); ?></label>
			<p class="right-result"><a href="<?php echo safe_output($config->get('address')); ?>/profile/"><?php echo safe_output($pm_unread_count); ?></a></p>
			<div class="clearfix"></div>
			
		</div>

		<div class="well well-sm">
			<div class="pull-left">
				<h4><?php echo safe_output($language->get('Tickets')); ?></h4>
			</div>
			<div class="pull-right">
				<div class="btn-group">
					<a href="<?php echo safe_output($config->get('address')); ?>/tickets/add/" class="btn btn-default btn-sm"><?php echo safe_output($language->get('Add')); ?></a>
					<a href="<?php echo safe_output($config->get('address')); ?>/tickets/" class="btn btn-default btn-sm"><?php echo safe_output($language->get('View')); ?></a>
				</div>							
			</div>
			
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('Your Open Tickets')); ?></label>
			<p class="right-result"><a href="<?php echo safe_output($config->get('address')); ?>/tickets/?user_id=<?php echo (int) $auth->get('id'); ?>&amp;active=1"><?php echo (int) $your_open_tickets; ?></a></p>
			<div class="clearfix"></div>
			
			<?php if ($auth->get('user_level') != 1) { ?>
				<label class="left-result"><?php echo safe_output($language->get('Assigned Open Tickets')); ?></label>
				<p class="right-result"><a href="<?php echo safe_output($config->get('address')); ?>/tickets/?assigned_user_id=<?php echo (int) $auth->get('id'); ?>&amp;active=1"><?php echo (int) $assigned_open_tickets; ?></a></p>
				<div class="clearfix"></div>
			<?php } ?>

		</div>		
		
		<?php $plugins->run('view_dashboard_sidebar_finish'); ?>

	</div>

	<div class="col-md-9">
		<?php $plugins->run('view_dashboard_content_start'); ?>	
		<?php $plugins->run('view_dashboard_content_finish'); ?>			
	</div>
	
	<?php $plugins->run('view_dashboard_container_finish'); ?>			

	</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>
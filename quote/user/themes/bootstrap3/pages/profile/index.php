<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Profile'));
$site->set_config('container-type', 'container');

$items = $messages->get(array('to_from_user_id' => $auth->get('id')));

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<div class="row">
	<div class="col-md-3">
		<div class="well well-sm">
			<div class="pull-left">
				<h4><?php echo safe_output($language->get('Profile')); ?></h4>
			</div>
			
			<div class="pull-right">
				<p><a href="<?php echo safe_output($config->get('address')); ?>/profile/edit/" class="btn btn-default"><?php echo safe_output($language->get('Edit')); ?></a></p>
			</div>		
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('Name')); ?></label>
			<p class="right-result">
				<?php echo safe_output(ucwords($auth->get('name'))); ?>
			</p>	
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('Username')); ?></label>
			<p class="right-result">
				<?php echo safe_output($auth->get('username')); ?>
			</p>					
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('Email')); ?></label>
			<p class="right-result">
				<?php echo safe_output($auth->get('email')); ?>
			</p>	

			<div class="clearfix"></div>
			<?php if ($config->get('gravatar_enabled')) { ?>
			<label class="left-result"><?php echo safe_output($language->get('Gravatar')); ?></label>
			<p class="right-result">
				<?php $gravatar->setEmail($auth->get('email')); ?>
				<img src="<?php echo $gravatar->getUrl(); ?>" alt="Gravatar" />
			</p>
			<?php } ?>
			<div class="clearfix"></div>
		
			
		</div>
	</div>

	<div class="col-md-9">

		<?php if (isset($message)) { ?>
			<div id="content">
				<?php echo message($message); ?>
				<div class="clear"></div>
			</div>
		<?php } ?>

		<!--<div class="well well-sm">-->
			<div class="pull-left">
				<h4><?php echo safe_output($language->get('Private Messages')); ?></h4>
			</div>
			
			<div class="pull-right">
				<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 3 || $auth->get('user_level') == 4 || $auth->get('user_level') == 6) { ?>
					<p><a href="<?php echo safe_output($config->get('address')); ?>/messages/add/" class="btn btn-default"><?php echo safe_output($language->get('Add')); ?></a></p>
				<?php } ?>
			</div>
			
			<div class="clearfix"></div>

			
			<?php if (!empty($items)) { ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><?php echo safe_output($language->get('Subject')); ?></th>
							<th><?php echo safe_output($language->get('To')); ?></th>
							<th><?php echo safe_output($language->get('From')); ?></th>
							<th><?php echo safe_output($language->get('Date')); ?></th>
							<th><?php echo safe_output($language->get('Unread')); ?></th>
						</tr>
					</thead>
					
					<tbody>
						
						<?php 
						$i = 0;
						foreach ($items as $item) {
						?>
						<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
							<td class="centre"><a href="<?php echo $config->get('address'); ?>/messages/view/<?php echo safe_output($item['id']); ?>/"><?php echo safe_output(ucfirst($item['subject'])); ?></a></td>
							<td class="centre"><?php echo safe_output(ucfirst($item['to_name'])); ?></td>
							<td class="centre"><?php echo safe_output(ucfirst($item['from_name'])); ?></td>
							<td class="centre"><?php echo safe_output(date('D, d M Y g:i A', strtotime($item['date_added']))); ?></td>
							<td class="centre"><?php echo (int) $item['unread_count']; ?></td>
						</tr>
						<?php $i++; } ?>
						
					</tbody>
				</table>
			<?php } else {
				echo message($language->get('No Messages'));
			} ?>

			<div class="clearfix"></div>

		<!--</div>-->
		
		<?php $plugins->run('profile_content_finish'); ?>
	</div>
</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>
<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('View Ticket'));
$site->set_config('container-type', 'container');

$id = (int) $url->get_item();

if ($id == 0) {
	header('Location: ' . $config->get('address') . '/tickets/');
	exit;
}

//admin and global mods
if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) {
	//all tickets
}
//moderator
else if ($auth->get('user_level') == 5) {
	$t_array['department_or_assigned_or_user_id']	= $auth->get('id');
}
else if ($auth->get('user_level') == 4) {
	//staff
	$t_array['department_or_assigned_or_user_id']	= $auth->get('id');
}
//users and user plus
else if ($auth->get('user_level') == 3) {
	//select assigned tickets or personal tickets
	$t_array['assigned_or_user_id'] 		= $auth->get('id');
}
//sub
else {
	//just personal tickets
	$t_array['user_id'] 					= $auth->get('id');
}

$t_array['id']				= $id;
$t_array['get_other_data'] 	= true;
$t_array['limit']			= 1;

$tickets_array = $tickets->get($t_array);

if (count($tickets_array) == 1) {
	$ticket = $tickets_array[0];
}
else {
	header('Location: ' . $config->get('address') . '/tickets/');
	exit;
}

if (isset($_POST['delete'])) {
	if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {
		$tickets->delete(array('id' => $id));
		header('Location: ' . $config->get('address') . '/tickets/');
		exit;
	}
}

$note_get_array['ticket_id'] 		= (int) $ticket['id'];
$note_get_array['get_other_data'] 	= true;

if ($auth->get('user_level') == 1) {
	$note_get_array['private'] 		= 0;
}

$notes_array = $ticket_notes->get($note_get_array);

$status 		= $ticket_status->get(array('enabled' => 1));

if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) {
	$departments	= $ticket_departments->get(array('enabled' => 1));
} else {
	$departments 	= $ticket_departments->get(array('enabled' => 1, 'get_other_data' => true, 'user_id' => $auth->get('id')));
}

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<script type="text/javascript">
	$(document).ready(function () {
		$('#delete').click(function () {
			if (confirm("<?php echo safe_output($language->get('Are you sure you wish to delete this ticket?')); ?>")){
				return true;
			}
			else{
				return false;
			}
		});
	});
</script>
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/js/user_selector2.js"></script>

<div class="row">
	<div class="col-md-3">
		<div class="well well-sm">
			<div class="pull-left">
				<h4><?php echo safe_output($language->get('Ticket')); ?></h4>
			</div>

			<div class="pull-right">
				<a href="<?php echo $config->get('address'); ?>/tickets/edit/<?php echo (int) $ticket['id']; ?>/" class="btn btn-default"><?php echo safe_output($language->get('Edit')); ?></a>
			</div>

			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('User')); ?></label>
			<p class="right-result">
				<?php echo safe_output(ucwords($ticket['owner_name'])); ?>
			</p>
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('Status')); ?></label>
			<p class="right-result"><?php echo safe_output($ticket['status_name']);  ?></p>
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('Priority')); ?></label>
			<p class="right-result"><?php echo safe_output($ticket['priority_name']); ?></p>
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('Submitted By')); ?></label>
			<p class="right-result">
				<?php echo safe_output(ucwords($ticket['submitted_name'])); ?>
			</p>
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('Assigned User')); ?></label>
			<p class="right-result">
				<?php echo safe_output(ucwords($ticket['assigned_name'])); ?>
			</p>			
			<div class="clearfix"></div>

			<label class="left-result"><?php echo safe_output($language->get('Department')); ?></label>
			<p class="right-result"><?php echo safe_output(ucwords($ticket['department_name'])); ?></p>
			<div class="clearfix"></div>			
			
			<?php $plugins->run('view_ticket_details_after_department', $ticket); ?>
			
			<label class="left-result"><?php echo safe_output($language->get('Added')); ?></label>
			<p class="right-result"><abbr title="<?php echo safe_output(nice_datetime($ticket['date_added'])); ?>"><?php echo safe_output(time_ago_in_words($ticket['date_added'])); ?> <?php echo safe_output($language->get('ago')); ?></abbr></p>
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('Updated')); ?></label>
			<p class="right-result"><abbr title="<?php echo safe_output(nice_datetime($ticket['last_modified'])); ?>"><?php echo safe_output(time_ago_in_words($ticket['last_modified'])); ?> <?php echo safe_output($language->get('ago')); ?></abbr></p>
			<div class="clearfix"></div>
			
			<label class="left-result"><?php echo safe_output($language->get('ID')); ?></label>
			<p class="right-result"><?php echo safe_output($ticket['id']); ?></p>
			<div class="clearfix"></div>

			<?php if ($ticket['pop_account_name'] != '' && $auth->get('user_level') != 1) { ?>
				<label class="left-result"><?php echo safe_output($language->get('Email Account')); ?></label>
				<p class="right-result"><?php echo safe_output($ticket['pop_account_name']); ?></p>
				<div class="clearfix"></div>
			<?php } ?>
			
			<?php if (!empty($ticket['cc'])) { ?>
				<?php $cc = unserialize($ticket['cc']); ?>
				<label class="left-result"><?php echo safe_output($language->get('CC')); ?></label>
				<p class="right-result">
					<a href="#" class="popover-item" 
					data-html="true"
					data-content="
					<ul>
					<?php foreach($cc as $cc_item) { ?>
						<li><?php echo safe_output($cc_item); ?></li>
					<?php } ?>
					</ul>
					" data-title="CC'ed Email Addresses">
						<?php echo (int) count($cc); ?>
					</a>
				</p>
				<div class="clearfix"></div>
			<?php } ?>			
			
			<?php $plugins->run('view_ticket_details_finish'); ?>
		
			<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>
				<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">
					<div class="pull-right">
						<button type="submit" id="delete" name="delete" class="btn btn-danger"><?php echo safe_output($language->get('Delete')); ?></button>
					</div>
				</form>
				<div class="clearfix"></div>
			<?php } ?>

		</div>
	
		
		<div class="well well-sm">	
			<div class="pull-left">
				<h4><?php echo safe_output($language->get('User Details')); ?></h4>
			</div>

			<?php if ($ticket['user_id'] == 0 && $auth->get('user_level') == 2) { ?>
				<div class="pull-right">
					<a href="<?php echo $config->get('address'); ?>/users/add/?name=<?php echo safe_output($ticket['name']); ?>&amp;email=<?php echo safe_output($ticket['email']); ?>" class="btn"><?php echo safe_output($language->get('Create Account')); ?></a>
				</div>
			<?php } ?>
			
			<div class="clearfix"></div>

			<?php if ($ticket['user_id'] == 0) { ?>		
				<p class="center"><?php echo safe_output($language->get('This ticket is from a user without an account.')); ?></p>

				<label class="left-result"><?php echo safe_output($language->get('Name')); ?></label>
				<p class="right-result"><?php echo safe_output(ucwords($ticket['name'])); ?></p>
				<div class="clearfix"></div>
				
				<label class="left-result"><?php echo safe_output($language->get('Email')); ?></label>
				<p class="right-result"><a href="mailto:<?php echo safe_output($ticket['email']); ?>"><?php echo safe_output($ticket['email']); ?></a></p>
				<div class="clearfix"></div>
			<?php } else { ?>
				<?php if ($auth->get('user_level') == 2) { ?>
					<label class="left-result"><?php echo safe_output($language->get('Name')); ?></label>
					<p class="right-result"><a href="<?php echo $config->get('address'); ?>/users/view/<?php echo (int) $ticket['user_id']; ?>/"><?php echo safe_output(ucwords($ticket['owner_name'])); ?></a></p>
					<div class="clearfix"></div>
				<?php } else { ?>
					<label class="left-result"><?php echo safe_output($language->get('Name')); ?></label>
					<p class="right-result"><?php echo safe_output(ucwords($ticket['owner_name'])); ?></p>
					<div class="clearfix"></div>
				<?php } ?>
				
				<label class="left-result"><?php echo safe_output($language->get('Email')); ?></label>
				<p class="right-result"><a href="mailto:<?php echo safe_output($ticket['owner_email']); ?>"><?php echo safe_output($ticket['owner_email']); ?></a></p>
				<div class="clearfix"></div>
			
				<?php if (!empty($ticket['owner_phone'])) { ?>
					<label class="left-result"><?php echo safe_output($language->get('Phone')); ?></label>
					<p class="right-result"><?php echo safe_output($ticket['owner_phone']); ?></p>
					<div class="clearfix"></div>
				<?php } ?>
			<?php } ?>
			
			<?php $plugins->run('view_ticket_user_details_finish'); ?>

		</div>		
				
		<?php $files = $tickets->get_files(array('id' => $ticket['id'])); ?>
		<?php if (count($files) > 0) { ?>
			<div class="well well-sm">
				<h4><?php echo safe_output($language->get('Files')); ?></h4>
				<ul>
					<?php foreach ($files as $file) { ?>
					<li>
						<a href="<?php echo $config->get('address'); ?>/files/download/<?php echo (int) $file['id']; ?>/?ticket_id=<?php echo (int) $ticket['id']; ?>"><?php echo safe_output($file['name']); ?></a>
						- <small><?php echo safe_output(time_ago_in_words($file['date_added'])); ?> <?php echo safe_output($language->get('ago')); ?></small>
					</li>
					<?php } ?>
				</ul>
			
			</div>
		<?php } ?>
		
		<?php $plugins->run('view_ticket_sidebar_finish', $ticket); ?>

	</div>

	<div class="col-md-9">
	
		<?php if ((int) $ticket['merge_ticket_id'] != 0) { ?>
			<div class="alert alert-warning">
				<strong><?php echo html_output($language->get('This ticket was merged into another ticket.')); ?></strong>
				<div class="pull-right">
					<p><a href="<?php echo safe_output($config->get('address')); ?>/tickets/view/<?php echo (int) $ticket['merge_ticket_id']; ?>/" class="btn btn-info"><?php echo safe_output($language->get('View Ticket')); ?></a></p>
				</div>
				<div class="clearfix"></div>
			</div>		
		<?php } ?>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h1 class="panel-title"><?php echo safe_output($ticket['subject']); ?></h1>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<?php if ($config->get('gravatar_enabled')) { ?>
					<div class="pull-right">
						<?php $gravatar->setEmail($ticket['owner_email']); ?>
						<img src="<?php echo $gravatar->getUrl(); ?>" alt="Gravatar" />
					</div>
				<?php } ?>
				<?php if ($ticket['html'] == 1) { ?>
					<?php echo html_output($ticket['description']); ?>
				<?php } else { ?>
					<p><?php echo nl2br(safe_output($ticket['description'])); ?></p>
				<?php } ?>
			
				<div class="clearfix"></div>
			
				<?php $site->view_custom_field_values(array('ticket' => $ticket)); ?>		
			</div>
		</div>
		
		<?php if (!empty($notes_array)) { ?>
			<div class="page-header">
				<h4><?php echo safe_output($language->get('Replies')); ?></h4>
			</div>
			<?php $i = 0; foreach($notes_array as $note) { ?>
				<div class="panel <?php if ($i % 2 == 0 ) { echo 'panel-default'; } else { echo 'panel-info'; } ?>">
					<?php if (!empty($note['subject'])) { ?>
						<div class="panel-heading">
							<div class="pull-left">
								<h1 class="panel-title"><?php echo safe_output($note['subject']); ?></h1>
							</div>
							<div class="clearfix"></div>
						</div>
					<?php } ?>
					<div class="panel-body">
						<div class="pull-right">
							<?php if ($config->get('gravatar_enabled')) { ?>
								<?php if ($note['user_id'] == 0) { ?>
									<?php $gravatar->setEmail($note['email']); ?>
								<?php } else { ?>
									<?php $gravatar->setEmail($note['owner_email']); ?>							
								<?php } ?>
								<div class="pull-right">
									<p><img src="<?php echo $gravatar->getUrl(); ?>" alt="Gravatar" /></p>
								</div>
							<?php } ?>
						</div>
						<?php if ($note['html'] == 1) { ?>
							<?php echo html_output($note['description']); ?>
						<?php } else { ?>
							<p><?php echo nl2br(safe_output($note['description'])); ?></p>
						<?php } ?>
						<div class="clearfix"></div>						
					</div>
					<div class="panel-footer">
						
						<div class="pull-left">
							<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>						
								<a class="custom_modal btn btn-default btn-xs" data-href="<?php echo $config->get('address'); ?>/tickets/edit_reply_modal/<?php echo (int) $note['id']; ?>/?ticket_id=<?php echo (int) $ticket['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
								<?php if (!empty($note['cc'])) { ?>
									<?php $cc = unserialize($note['cc']); ?>
									<a href="#" class="popover-item" 
									data-html="true"
									data-content="
									<ul>
									<?php foreach($cc as $cc_item) { ?>
										<li><?php echo safe_output($cc_item); ?></li>
									<?php } ?>
									</ul>
									" data-title="<?php echo safe_output($language->get('Carbon Copied Email Addresses')); ?>">
										<span class="label label-success"><?php echo safe_output($language->get('Carbon Copied')); ?></span>
									</a>
								<?php } ?>	

								<?php } ?>								
								<?php if ($note['private'] == 1) { ?>
									<span class="label label-default"><?php echo safe_output($language->get('Private Reply')); ?></span>
							<?php } ?>	
						</div>
					
						<div class="pull-right">
							<small>
								<?php if ($note['user_id'] == 0) { ?>	
									<?php echo safe_output(ucwords($note['name']) . ' <' . $note['email'] . '>'); ?> - <abbr title="<?php echo safe_output(nice_datetime($note['date_added'])); ?>"><?php echo safe_output(time_ago_in_words($note['date_added'])); ?> <?php echo safe_output($language->get('ago')); ?></abbr>								
								<?php } else { ?>
									<?php echo safe_output(ucwords($note['owner_name'])); ?> - <abbr title="<?php echo safe_output(nice_datetime($note['date_added'])); ?>"><?php echo safe_output(time_ago_in_words($note['date_added'])); ?> <?php echo safe_output($language->get('ago')); ?></abbr>
								<?php } ?>
							</small>
							
						</div>
						<div class="clearfix"></div>		
					</div>
				</div>
			<?php $i++; } ?>		
		<?php } ?>
		<div class="no_print">
			<a name="addnote"></a>
			
			<?php if ($auth->get('user_level') != 1) { ?>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#" id="ticket_public_reply"><?php echo safe_output($language->get('Public Reply')); ?></a></li>
					<li><a href="#" id="ticket_private_reply"><?php echo safe_output($language->get('Private Reply')); ?></a></li>
				</ul>
				<div class="clearfix"></div>
				<br />
			<?php } else { ?>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#"><?php echo safe_output($language->get('Reply')); ?></a></li>
				</ul>
				<div class="clearfix"></div>
				<br />		
			<?php } ?>

			<form method="post" role="form" enctype="multipart/form-data" action="<?php echo $config->get('address'); ?>/tickets/addnote/<?php echo (int) $ticket['id']; ?>/">
									
				<div class="col-md-7">
		
					<p><textarea class="wysiwyg_enabled" id="ticket_reply_description" name="description" cols="70" rows="12"></textarea></p>
					
					<div class="clearfix"></div>
				
					<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 3 || $auth->get('user_level') == 4 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>
						<?php
							$canned_responses_array = $canned_responses->get(array('order_by' => 'name'));
							
							if (!empty($canned_responses_array)) {
								?>
								<div class="btn-group">
									<a class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" href="#">
										<?php echo safe_output($language->get('Insert Canned Response')); ?>
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<?php foreach($canned_responses_array as $response) { ?>
											<li><a href="#" class="insert_canned_response" data-canned_response="<?php echo safe_output($response['description']); ?>"><?php echo safe_output($response['name']); ?></a></li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
					<?php } ?>
		
					<div class="pull-right">
						<p>
							<input type="hidden" name="id" value="<?php echo (int) $ticket['id']; ?>" />
							<input type="hidden" name="private" value="0" />
							<button name="add" type="submit" class="btn btn-primary"><?php echo safe_output($language->get('Add Reply')); ?></button>
						</p>
					</div>
					<div class="clearfix"></div>
					<?php if ($auth->get('user_level') != 1 && !empty($ticket['owner_email']) && ($ticket['owner_email_notifications'] == 1)) { ?>
						<div id="ticket_email_owner_notice">
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<?php echo html_output($language->get('An email will be sent to')); ?> "<?php echo safe_output($ticket['owner_email']); ?>".
							</div>	
						</div>
					<?php } ?>
				</div>
				
				<div class="col-md-5">

					<div class="well well-sm">
						
						<div id="ticket_attach_file_form">
							<?php if ($config->get('storage_enabled')) { ?>
								<div class="pull-left">
									<h4><?php echo safe_output($language->get('Attach File')); ?></h4>
								</div>
								<div class="pull-right">
									<a href="#" id="add_extra_file" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-plus"></span> <?php echo safe_output($language->get('Attach More')); ?></a>	
								</div>
								<div class="clearfix"></div>

								<div class="form-group">		
									<div class="col-lg-10">								
										<div class="pull-left"><input name="file[]" type="file" /></div>									
										<div id="attach_file_area"></div>
									</div>
								</div>
									
								<div class="clearfix"></div>
							<?php } ?>
						</div>

						<div id="ticket_carbon_copy_form">						
							<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 4 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>
								<h4>
									<?php echo safe_output($language->get('Carbon Copy Reply')); ?>
									<i data-toggle="tooltip" data-placement="right" data-original-title="<?php echo safe_output($language->get('Allows you to Carbon Copy this reply to other users e.g. user@example.com,user2@example.net.')); ?><br /><?php echo safe_output($language->get('Note: If enabled CCed users will be able to view the entire ticket thread via the guest portal (but not via email).')); ?>" class="glyphicon glyphicon-question-sign"></i>	
								</h4>							
								<p><input type="text" name="cc" class="form-control" value="" placeholder="user@example.com,user2@example.com" size="50" /></p>
								
							<?php } ?>
						</div>
						

						<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 3 || $auth->get('user_level') == 4 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>
							<h4><?php echo safe_output($language->get('Change Status')); ?></h4>

							<select name="action_id">
								<option value="">&nbsp;</option>
								<?php foreach($status as $item) { ?>
									<option value="<?php echo (int) $item['id']; ?>"><?php echo safe_output($item['name']); ?></option>
								<?php } ?>
							</select>
						<?php } else { ?>
							<?php if ($ticket['active']) { ?>
								<h4><?php echo safe_output($language->get('Change Status')); ?></h4>

								<label class="checkbox">
									<input type="checkbox" name="action_id" value="2" /> <?php echo safe_output($language->get('Close Ticket')); ?>
								</label>
							<?php } ?>
						<?php } ?>
			
						<div id="ticket_transfer_department_form">								
							<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>
								<script type="text/javascript">
									$(document).ready(function () {
										$('#department_email_alert').hide();
										$('#assigned_user_email_alert').hide();

										$('body').on('change', '#update_department_id2', function (e) {
										
											if ($('#update_department_id2').val() !== '' && ($('#update_department_id2').val() != <?php echo (int) $ticket['department_id']; ?>)) {
												$('#department_email_alert').slideDown();
											}
											else {
												$('#department_email_alert').slideUp();
											}
											$('#assigned_user_email_alert').slideUp();

										});
										
										$('body').on('change', '#assigned_user_id2', function (e) {
											if ($('#assigned_user_id2').val() != <?php echo (int) $ticket['assigned_user_id']; ?>) {
												$('#assigned_user_email_alert').slideDown();
											}
											else {
												$('#assigned_user_email_alert').slideUp();
											}

										});
									});	
								</script>
							
								<?php if (count($departments) > 1) { ?>
									<h4><?php echo safe_output($language->get('Transfer to Department')); ?></h4>
									<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) { ?>
										<select name="department_id2" id="update_department_id2">
											<option value="">&nbsp;</option>
											<?php foreach($departments as $department) { ?>
												<option value="<?php echo (int) $department['id']; ?>"><?php echo safe_output(ucwords($department['name'])); ?></option>
											<?php } ?>
										</select>
									<?php } else if ($auth->get('user_level') == 5) { ?>
										<select name="department_id2" id="update_department_id2">
											<option value="">&nbsp;</option>
											<?php foreach($departments as $department) { ?>
												<?php if ($department['is_user_member'] || $department['public_view']) { ?>
													<option value="<?php echo (int) $department['id']; ?>"><?php echo safe_output(ucwords($department['name'])); ?></option>
												<?php } ?>
											<?php } ?>		
										</select>
									<?php } ?>
									
									<div id="department_email_alert">
										<br />
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert">&times;</a>
											<?php echo html_output($language->get('An email will be sent to this department.')); ?>
										</div>	
									</div>
									
								<?php } ?>	

								<h4><?php echo safe_output($language->get('Assign User')); ?></h4>

								<select name="assigned_user_id2" id="assigned_user_id2">
									<option value=""></option>					
								</select>

								<div id="assigned_user_email_alert">
									<br />
									<div class="alert alert-success">
										<a href="#" class="close" data-dismiss="alert">&times;</a>
										<?php echo html_output($language->get('An email will be sent to this person.')); ?>
									</div>	
								</div>
								
							<?php } ?>
						</div>
						
					</div>
					
				</div>

				<div class="clearfix"></div>

			</form>
		</div>
	</div>
</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>
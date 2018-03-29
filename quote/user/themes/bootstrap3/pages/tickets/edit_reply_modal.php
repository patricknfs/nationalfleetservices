<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;


$id = (int) $url->get_item();
$ticket_id = (int) $_GET['ticket_id'];

if ($id == 0 || $ticket_id == 0) {
	echo 'Error';
	exit;
}

if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {

}
else {
	echo 'Error';
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

$t_array['id']				= $ticket_id;
$t_array['get_other_data'] 	= true;
$t_array['limit']			= 1;

$tickets_array = $tickets->get($t_array);

if (count($tickets_array) == 1) {
	$ticket = $tickets_array[0];
}
else {
	echo 'Error';
	exit;
}

$notes_array = $ticket_notes->get(array('id' => $id, 'ticket_id' => $ticket_id));


if (count($notes_array) == 1) {
	$note = $notes_array[0];
}
else {
	echo 'Error';
	exit;
}


?>
<script>
$(document).ready(function () {

	$('body').on('click', '#save', function (e) {
		
		e.preventDefault();
		
		$.ajax({
			type: "POST",
			url:  sts_base_url + "/tickets/edit_reply_modal_save/" + <?php echo (int) $id; ?>,
			data: "save=true&description="+$('#description').val()+"&ticket_id=<?php echo (int) $ticket_id; ?>",
			success: function(html){
				window.location.replace("<?php echo $config->get('address'); ?>/tickets/view/<?php echo (int) $ticket_id; ?>/");
			}
		 });
		
		
	});
	
	$('#model_ticket_delete').click(function () {
		if (confirm("<?php echo safe_output($language->get('Are you sure you wish to delete this reply?')); ?>")){
			$.ajax({
				type: "POST",
				url:  sts_base_url + "/tickets/delete_reply_modal/" + <?php echo (int) $id; ?>,
				data: "delete=true&ticket_id=<?php echo (int) $ticket_id; ?>",
				success: function(html){
					window.location.replace("<?php echo $config->get('address'); ?>/tickets/view/<?php echo (int) $ticket_id; ?>/");
				}
			 });
			 
			return true;
		}
		else{
			return false;
		}
	});
	
		
	$('.wysiwyg_enabled').redactor({
		focus: false, 
		buttons: [
			'html', '|', 'formatting', '|', 'bold', 'italic', 'deleted', '|',
			'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
			'image', 'table', 'link', '|',
			'fontcolor', 'backcolor', '|',
			'alignleft', 'aligncenter', 'alignright', 'justify', '|',
			'horizontalrule'
		]
	});


});
</script>
<!-- Modal -->
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title"><?php echo safe_output($note['subject']); ?></h4>
		</div>
		<div class="modal-body">
			<p><?php echo safe_output($language->get('Description')); ?><br />
				<textarea class="wysiwyg_enabled form-control" name="description" id="description">
					<?php if ($note['html'] == 1) { ?>
						<?php echo html_output($note['description']); ?>
					<?php } else { ?>
						<?php echo nl2br(safe_output($note['description'])); ?>
					<?php } ?>
				</textarea>
			</p>			
		</div>
		<div class="modal-footer">
			<a href="#" id="model_ticket_delete" class="btn btn-danger" data-dismiss="modal"><?php echo safe_output($language->get('Delete')); ?></a>
			<a href="#" class="btn btn-default" data-dismiss="modal"><?php echo safe_output($language->get('Cancel')); ?></a>
			<a href="#" class="btn btn-primary" id="save" data-dismiss="modal"><?php echo safe_output($language->get('Save')); ?></a>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

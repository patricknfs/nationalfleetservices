<?php
echo $this->Form->create('Survey', array('url'=>'/surveys/preview','class' => 'form-horizontal', "id"=>"previewSurvey", "target"=>"_blank"));
echo $this->Form->input('frmb', array('type'=>'hidden', 'id'=>'frmbData'));
echo $this->Form->end();
?>
<div class="bcContent form">
<table cellpadding="0" cellspacing="0" id="table-customers" class="table table-striped table-bordered table-condensed">
    <thead>
    <tr>
        <th class="header" ><?php echo $this->Paginator->sort('Survey.name', __('Name') );?></th>
        <th class="header" style="width: 60px"><?php echo $this->Paginator->sort('Survey.survey_response_count', __('Responses') );?></th>
        <th class="header" style="text-align: center; width: 120px"><?php echo $this->Paginator->sort('Survey.created', __('Created'));?></th>
        <th class="header" style="width: 60px"><?php echo $this->Paginator->sort('Survey.published', __('Published') );?></th>
        <th class="header" style="text-align: center; width: 230px"><?php echo __('Actions');?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($surveys as $survey):
        echo $this->Form->input('frmb', array('type'=>'hidden', 'id'=>'frmbData'.$survey['Survey']['id'], 'value'=>$survey['Survey']['form_structure'] ));
    ?>
    <tr id='<?php echo $survey['Survey']['id'];?>'>
            <td><?php echo $survey['Survey']['name']; ?></td>
            <td style="text-align: center"><?php echo $this->Html->link($survey['Survey']['survey_response_count'], array('controller'=>'survey_responses', 'action'=>'index', $survey['Survey']['id'])); ?></td>
            <td style="text-align: center"><?php echo date('M, d Y', strtotime($survey['Survey']['created'])); ?></td>
            <td style="text-align: center">
                <span style="cursor: pointer">
                <?php
                    $state = ($survey['Survey']['published'] == 1) ? 1 : 0;
                    echo $this->Html->image('Survey.allow-' . intval($state) . '.png',
                            array('onclick' => 'published.toggle("status-'.$survey['Survey']['id'].'",
                                    "'.$this->Html->url(array('action'=>'toggle', $survey['Survey']['id'], (int)$survey['Survey']['published'], "published")).'");',
                                    'id' => 'status-'.$survey['Survey']['id']
                ));
                ?>
                </span>
            </td>
            <td style="text-align: center">
                    <span class="label link-white"><i class="icon-zoom-in icon-white"></i> <?php echo $this->Html->link(__('View', true), array('controller'=>'surveys','action' => 'response', $survey['Survey']['id']), array('style'=>'color:white', 'target'=>'_blank', 'class'=>'frmbData','ref'=>'frmbData'.$survey['Survey']['id'])); ?></span>
                    <span class="label label-warning link-white"><i class="icon-edit icon-white"></i> <?php echo $this->Html->link(__('Edit', true), array('controller'=>'surveys','action' => 'edit', $survey['Survey']['id']),array('style'=>'color:white')); ?></span>
                    <span class="label label-important link-white"><i class="icon-trash icon-white"></i> <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $survey['Survey']['id']), array('style'=>'color:white'), sprintf(__('Are you sure you want to delete #%s?', true), $survey['Survey']['name']) ); ?></span>
            </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>

</div>
<div class="pagination">
    <p><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></p>
    <ul>
        <?php
        echo $this->Paginator->prev('&larr; ' . __('previous'), array('tag' => 'li','escape'=>false), null, array('tag' => 'li', 'escape'=>false, 'class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => '','tag' => 'li', 'before'=>'', 'after'=>''));
        echo $this->Paginator->next(__('next') . ' &rarr;', array('tag' => 'li','escape'=>false), null, array('tag' => 'li', 'escape'=>false, 'class' => 'next disabled'));
        ?>
    </ul>
</div>
<?php $this->append('script');?>
<script type="text/javascript">
    var published = { toggle : function(id, url){ obj = $('#'+id).closest("span"); $.ajax({ url: url, type: "POST", success: function(response){ obj.html(response); } }); } };
    $(document).ready(function(){
            $('.asc').closest('th').addClass('headerSortDown');
            $('.desc').closest('th').addClass('headerSortUp');
    });
</script>
<?php $this->end();?>
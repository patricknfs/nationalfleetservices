<div class="subnav">
    <div class="btn-toolbar" id="controls-list">
        <div class="btn-group">
            <a href="#" data-toggle="dropdown" class="btn"><i class="icon-list-alt"></i> Export</a>
            <a href="#" data-toggle="dropdown" class="btn dropdown-toggle">&nbsp;<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo $this->Html->url('/survey/survey_responses/export/'.$id.'/csv');?>" title="Export Responses To CSV"><i class="icon-align-justify"></i> CSV</a></li>
                <li><a href="<?php echo $this->Html->url('/survey/survey_responses/export/'.$id.'/excel');?>" title="Export Responses To Excel"><i class="icon-th-large"></i> MS Excel</a></li>
            </ul>
        </div>
        <div class="btn-group">
            <a href="<?php echo $this->Html->url('/survey/survey_responses/view/0/'.$id);?>" class="btn" rel="" data-placement="bottom" title="Browse Response One by One"><i class="icon-zoom-in"></i> Browse Response One by One</a>
        </div>
        <div class="btn-group pull-right">
            <a href="javascript:;;" class="btn" id="collapse_all_responses" rel="tooltip" data-placement="bottom" title="Collapse"><i class="icon-resize-small"></i></a>
            <a href="javascript:;;" class="btn" id="expand_all_responses" rel="tooltip" data-placement="bottom" title="Expand"><i class="icon-resize-full"></i></a>
        </div>
        </div>
</div>
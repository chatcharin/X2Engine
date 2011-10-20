<?php
/*********************************************************************************
 * X2Engine is a contact management program developed by
 * X2Engine, Inc. Copyright (C) 2011 X2Engine Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY X2Engine, X2Engine DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact X2Engine, Inc. at P.O. Box 66752,
 * Scotts Valley, CA 95067, USA. or at email address contact@X2Engine.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * X2Engine" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by X2Engine".
 ********************************************************************************/

$this->menu=array(
		array('label'=>Yii::t('actions','Today\'s Actions'),'url'=>array('index')),
		array('label'=>Yii::t('actions','All My Actions'),'url'=>array('viewAll')),
		array('label'=>Yii::t('actions','Everyone\'s Actions'),'url'=>array('viewGroup')),
		array('label'=>Yii::t('actions','Create Lead'),'url'=>array('quickCreate')),
		array('label'=>Yii::t('actions','Create Action'),'url'=>array('create')), 
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('actions-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

function trimText($text) {
	if(strlen($text)>150)
		return substr($text,0,147).'...';
	else
		return $text;
}

?>

<h2><?php echo Yii::t('actions','Manage Actions'); ?></h2>
<?php echo Yii::t('app','You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?>
<br />
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'actions-grid',
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	
	'template'=> '<div class="title-bar">'
		.CHtml::link(Yii::t('app','Advanced Search'),'#',array('class'=>'search-button')) . ' | '
		.CHtml::link(Yii::t('app','Clear Filters'),array('index','clearFilters'=>1))
		.'{summary}</div>{items}{pager}',
	
	'dataProvider'=>$model->searchAdmin(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'actionDescription',
			'value'=>'CHtml::link(($data->type=="attachment")? MediaChild::attachmentActionText($data->actionDescription) : trimText($data->actionDescription),array("view","id"=>$data->id))',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>'40%'),
		),
		'associationType',
		array(
			'name'=>'dueDate',
			'value'=>'substr($data->dueDate,0,10)',
			'type'=>'raw',
		),
		// array(
			// 'name'=>'dueDate',
			// 'value'=>'date("Y-m-d",$data->dueDate)',
			// 'type'=>'raw',
		// ),
		//'createDate',
		// array(
			// 'name'=>'createDate',
			// 'value'=>'date("Y-m-d",$data->createDate)',
			// 'type'=>'raw',
		// ),
		array(
			'name'=>'assignedTo',
			'value'=>'UserChild::getUserLinks($data->assignedTo)',
			'type'=>'raw',
		),
		'complete',
		//'priority',
		//'type',
		array(
			'class'=>'CButtonColumn'
		)
	)
));
?>



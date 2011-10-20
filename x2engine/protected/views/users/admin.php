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
	array('label'=>Yii::t('users','Manage Users')),
	array('label'=>Yii::t('users','Create User'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php 

    if(isset($_GET['offset'])){
        $offset=$_GET['offset'];
    }else
        $offset=6;
?>
<h2><?php echo Yii::t('users','Manage Users'); ?></h2>
<?php echo Yii::t('app','You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?>
<br />
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview/',
	'template'=> '<div class="title-bar">'
		.CHtml::link(Yii::t('app','Advanced Search'),'#',array('class'=>'search-button')) . ' | '
		.CHtml::link(Yii::t('app','Clear Filters'),array('admin','clearFilters'=>1)). ' | '
		.CHtml::link(Yii::t('app','Records Today'),array('admin','offset'=>0)). ' | '
		.CHtml::link(Yii::t('app','Records This Week'),array('admin','offset'=>6)). ' | '
		.CHtml::link(Yii::t('app','Records This Month'),array('admin','offset'=>29))
		.'{summary}</div>{items}{pager}',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
                    'name'=>'username',
                    'value'=>'CHtml::link($data->username,$data->id)',
                    'type'=>'raw',
                ),
                'firstName',
		'lastName',
		array(
                    'name'=>'login',
                    'header'=>'Last Login',
                    'value'=>'date("Y-m-d",$data->login)',
                    'type'=>'raw',
                ),
                array(
                    'header'=>'<b>Records Updated</b>',
                    'value'=>'count(Changelog::model()->findAllBySql("SELECT * FROM x2_changelog WHERE changedBy=\"$data->username\" AND timestamp > '.mktime('0','0','0',date('m'),date('d')-$offset).'"))',
                    'type'=>'raw',
                ),
		'emailAddress',
		//'cellPhone',
		//'homePhone',
		//'address',
		//'officePhone',
		//'emailAddress',
		//'status',
	),
));
?>
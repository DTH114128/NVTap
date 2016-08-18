<?php
/* @var $this TblSkillController */
/* @var $model TblSkill */

$this->breadcrumbs=array(
	'Tbl Skills'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TblSkill', 'url'=>array('index')),
	array('label'=>'Create TblSkill', 'url'=>array('create')),
	array('label'=>'Update TblSkill', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblSkill', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblSkill', 'url'=>array('admin')),
);
?>

<h1>View TblSkill #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'skillname',
	),
)); ?>

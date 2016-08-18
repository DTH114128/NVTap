<?php
/* @var $this TblSkillController */
/* @var $model TblSkill */

$this->breadcrumbs=array(
	'Tbl Skills'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblSkill', 'url'=>array('index')),
	array('label'=>'Create TblSkill', 'url'=>array('create')),
	array('label'=>'View TblSkill', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblSkill', 'url'=>array('admin')),
);
?>

<h1>Update TblSkill <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
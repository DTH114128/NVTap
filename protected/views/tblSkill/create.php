<?php
/* @var $this TblSkillController */
/* @var $model TblSkill */

$this->breadcrumbs=array(
	'Tbl Skills'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblSkill', 'url'=>array('index')),
	array('label'=>'Manage TblSkill', 'url'=>array('admin')),
);
?>

<h1>Create TblSkill</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
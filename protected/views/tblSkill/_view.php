<?php
/* @var $this TblSkillController */
/* @var $data TblSkill */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skillname')); ?>:</b>
	<?php echo CHtml::encode($data->skillname); ?>
	<br />


</div>
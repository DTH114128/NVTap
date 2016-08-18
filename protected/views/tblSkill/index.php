<?php
/* @var $this TblSkillController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Skills',
);

$this->menu=array(
	array('label'=>'Create TblSkill', 'url'=>array('create')),
	array('label'=>'Manage TblSkill', 'url'=>array('admin')),
);
?>
<div style="margin-left: 200px;">
	<div> 
		<select id="demo" multiple="multiple">

		<?php foreach ($model as $key => $value) {?>
			<option value="<?php echo $value['id']; ?>"><?php echo $value["skillname"]; ?></option>
		<?php }?>
		</select>
	</div>
	<button type="button" class="btn btn-primary" style="margin-top: 10px;" id="submit" disabled="disabled">Submit</button> 
	<div>
		<h3>List Skills Of User:</h3>
		<ul class="list-group" style="width: 200px;margin-top: 10px;">
		<?php foreach ($userSkill as $key => $value) {?>
		  <li class="list-group-item"><?php echo $value["skillname"]; ?></li>
		<?php }?>
		</ul>
	</div>
	<button type="button" class="btn" id="clear">Clear List</button>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$('#demo').multiselect();



	});

	$('#demo').change(function() {
		if ($("#demo :selected").length > 0) {
			$( "#submit" ).prop( "disabled", false );
		}else
			$( "#submit" ).prop( "disabled", true );
    }); 

	$( "#submit" ).click(function() {
		var listSkillCheck = []; 
		$('#demo :selected').each(function(i, selected){ 
		  listSkillCheck[i] = $(selected).val(); 

		});

        $.ajax({
            url: '<?php echo Yii::app()->createUrl('TblSkill/AjaxRequest'); ?>',
            type: 'POST',
            data : {
                    listSkillCheck : listSkillCheck,
                },
            success: function (response) {
               $("#demo option:selected").removeAttr("selected");
               $('.active').remove();
               $('.multiselect-selected-text').text("None selected");
               $("button.multiselect").attr("title", "None selected");
               $( ".list-group" ).append(response);
            }
        });
	});

	$( "#clear" ).click(function() {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('TblSkill/AjaxClear'); ?>',
            success: function (response) {
               location.reload();
            }
        });
	});
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array( 'enctype'	=> 'multipart/form-data' ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_email'); ?>
		<?php echo $form->textField($model,'contact_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_link'); ?>
		<?php echo $form->textField($model,'company_link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company_link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField( $model,'image' ); ?>
		<?php echo $form->error($model,'logo'); ?>
		<p class="hint">Plase note that your logo <b>will be resized, cut, destorted</b> to harmonize <br />with our cool design.</p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->textField($model,'position',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'confidential'); ?>
		<?php echo $form->checkBox($model,'confidential'); ?>
		<?php echo $form->error($model,'confidential'); ?>
		<div class="hint">
			If you select the <b>Confidential</b> checkbox, your company's name and email address <br />will be <b>hidden from the public</b> and candidates will only be able to contact you <br />through our contact form!
		</div>
	</div> */ ?>

	<div class="row">
		<?php echo $form->labelEx($model,'job_type'); ?><div class="clear"><br /></div>
		<?php echo CHtml::activeCheckBoxList($model,'job_type', $model->available_jobtypes ); ?>
		<?php echo $form->error($model,'job_type'); ?>
	</div>

	<hr />

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>

		<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
							"model"=>$model,                # Data-Model
							"attribute"=>'description',         # Attribute in the Data-Model
							"height"=>'400px',
							"width"=>'600px',
							"toolbarSet"=>'Basic',          # EXISTING(!) Toolbar (see: fckeditor.js)
							"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",
# Path to fckeditor.php
							"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",
# Realtive Path to the Editor (from Web-Root)
							"config" => array("EditorAreaCSS"=>Yii::app()->baseUrl.'/css/index.css',),
# Additional Parameter (Can't configure a Toolbar dynamicly)
							) ); ?>
		
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<a href="#">Cancel</a>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

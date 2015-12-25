<script type='text/javascript'>
    $(document).ready(function () {
        $('#file-form').liTranslit({
            elName: '#File_name',
            elAlias: '#File_code'
        });
    })
</script>

<?
$module = Yii::app()->getModule('file');

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
    'id'                        => 'file-form',
    'enableAjaxValidation'      =>false,
    'method'                    => 'post',
    'htmlOptions'               =>array('enctype'=>'multipart/form-data', 'class' => 'well'),
    'enableClientValidation'    => true,
    'type'                      => 'vertical',
)
); ?>
<?php echo $form->errorSummary($model); ?>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->dropDownListGroup(
            $model,
            'category_id',
            array(
                'widgetOptions' => array(
                    'data' => Category::model()->getFormattedList(
                        (int)Yii::app()->getModule('file')->mainCategory
                    ),
                    'htmlOptions' => array(
                        'empty'  => Yii::t($module->aliasModuleT, '--choose--'),
                        'encode' => false
                    ),
                ),
            )
        ); ?>
    </div>
</div>

<div class="row hidden">
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup($model, 'sort'); ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-7">
        <?php echo $form->textFieldGroup($model, 'name'); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup($model, 'code'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
        <?php
        if(!$model->isNewRecord && $model->image):{ ?>
            <img src="<?php echo $model->getImageUrl(); ?>" alt=""/>
            <div class="image-changes">
                <?php
                // Удаление:
                echo CHtml::link(
                    '<i class="fa fa-fw fa-times"></i>',
                    Yii::app()->createAbsoluteUrl(
                        $module->patchBackend.'deleteImage',
                        array(
                            'id' => $model->id
                        )
                    ),
                    array(
                        'class' => 'deleteImages',
                    )
                ); ?>
            </div>
        <?php }endif; ?>
        <?php echo $form->fileFieldGroup(
            $model,
            'image',
            array(
                'widgetOptions' => array(
                    'htmlOptions' => array(
                        'onchange' => 'readURL(this);',
                        'style'    => 'background-color: inherit;'
                    )
                )
            )
        ); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
        <?php if(!$model->isNewRecord && $model->file): ?>
            <a href="<?php echo Yii::app()->uploadManager->getFileUrl($model->file, $module->uploadPath); ?>">
                <i class="fa fa-file-pdf-o"></i> Файл
            </a>
        <?php endif; ?>
        <?php echo $form->fileFieldGroup(
            $model,
            'file',
            array(
                'widgetOptions' => array(
                    'htmlOptions' => array(
                        'style'    => 'background-color: inherit;'
                    )
                )
            )
        ); ?>
    </div>
</div>

<p><?php echo $form->label($model, 'icon'); ?></p>
<?php $this->widget('application.modules.file.widgets.SelectIconWidget.SelectIconWidget', array(
    'nameField' => 'File[icon]'
)); ?>

<?php echo $form->hiddenField($model,'icon'); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'buttonType' => 'submit',
        'context'    => 'primary',
        'label'      => $model->isNewRecord ? 'Создать и продолжить' : 'Сохранить и продолжить',
    )
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'buttonType'  => 'submit',
        'htmlOptions' => array('name' => 'submit-type', 'value' => 'index'),
        'label'       => $model->isNewRecord ? 'Создать и закрыть' : 'Сохранить и закрыть',
    )
); ?>

<?php $this->endWidget(); ?>

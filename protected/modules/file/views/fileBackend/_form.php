<script type='text/javascript'>
    $(document).ready(function () {
        $('#file-form').liTranslit({
            elName: '#File_name',
            elAlias: '#File_slug'
        });
    })
</script>

<?
$module = Yii::app()->getModule('file');

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'id' => 'file-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'htmlOptions' => ['enctype' => 'multipart/form-data', 'class' => 'well'],
        'enableClientValidation' => true,
        'type' => 'vertical',
    ]
); ?>
<?= $form->errorSummary($model); ?>

<div class="row">
    <div class="col-sm-7">
        <?= $form->dropDownListGroup(
            $model,
            'category_id',
            [
                'widgetOptions' => [
                    'data' => Category::model()->getFormattedList(
                        (int)Yii::app()->getModule('file')->mainCategory
                    ),
                    'htmlOptions' => [
                        'empty' => Yii::t($module->aliasModule, '-- Choose --'),
                        'encode' => false
                    ],
                ],
            ]
        ); ?>

        <?= $form->textFieldGroup($model, 'name'); ?>

        <?= $form->textFieldGroup($model, 'slug'); ?>

        <?php if (!$model->isNewRecord && $model->file): ?>
            <a href="<?= Yii::app()->uploadManager->getFileUrl($model->file, $module->uploadPath); ?>">
                <i class="fa fa-file-pdf-o"></i> Файл
            </a>
        <?php endif; ?>
        <?= $form->fileFieldGroup(
            $model,
            'file',
            [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'style' => 'background-color: inherit;'
                    ]
                ]
            ]
        ); ?>
    </div>

    <div class="col-sm-5">
            <?php
            if (!$model->isNewRecord && $model->image): { ?>
                <img class="img-thumbnail"
                     src="<?= $model->getImageUrl(); ?>"
                     alt=""
                     style="max-width: 100%"/>
                <div class="image-changes">
                    <?php
                    // Удаление:
                    echo CHtml::link(
                        '<i class="fa fa-fw fa-times"></i>',
                        Yii::app()->createAbsoluteUrl(
                            $module->patchBackend . 'deleteImage',
                            [
                                'id' => $model->id
                            ]
                        ),
                        [
                            'class' => 'deleteImages',
                        ]
                    ); ?>
                </div>
            <?php }endif; ?>
            <?= $form->fileFieldGroup(
                $model,
                'image',
                [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'onchange' => 'readURL(this);',
                            'style' => 'background-color: inherit;'
                        ]
                    ]
                ]
            ); ?>

        <p><?= $form->label($model, 'icon'); ?></p>
        <?php $this->widget('application.modules.file.widgets.SelectIconWidget.SelectIconWidget', [
            'nameField' => 'File[icon]'
        ]); ?>
        </div>
</div>

<!--<div class="row hidden">-->
<!--    <div class="col-sm-7">-->
<!--        --><?//= $form->textFieldGroup($model, 'sort'); ?>
<!--    </div>-->
<!--</div>-->

<!--<div class="row">-->
<!--    <div class="col-xs-7">-->
<!--        --><?//= $form->textFieldGroup($model, 'name'); ?>
<!--    </div>-->
<!--</div>-->

<!--<div class="row">-->
<!--    <div class="col-sm-7">-->
<!--        --><?//= $form->textFieldGroup($model, 'slug'); ?>
<!--    </div>-->
<!--</div>-->

<!--<div class='row'>-->
<!--    <div class="col-sm-4">-->
<!--        --><?php //if (!$model->isNewRecord && $model->file): ?>
<!--            <a href="--><?//= Yii::app()->uploadManager->getFileUrl($model->file, $module->uploadPath); ?><!--">-->
<!--                <i class="fa fa-file-pdf-o"></i> Файл-->
<!--            </a>-->
<!--        --><?php //endif; ?>
<!--        --><?//= $form->fileFieldGroup(
//            $model,
//            'file',
//            [
//                'widgetOptions' => [
//                    'htmlOptions' => [
//                        'style' => 'background-color: inherit;'
//                    ]
//                ]
//            ]
//        ); ?>
<!--    </div>-->
<!--</div>-->

<!--<p>--><?//= $form->label($model, 'icon'); ?><!--</p>-->
<?php //$this->widget('application.modules.file.widgets.SelectIconWidget.SelectIconWidget', [
//    'nameField' => 'File[icon]'
//]); ?>

<?= $form->hiddenField($model, 'icon'); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? 'Создать и продолжить' : 'Сохранить и продолжить',
    ]
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label' => $model->isNewRecord ? 'Создать и закрыть' : 'Сохранить и закрыть',
    ]
); ?>

<?php $this->endWidget(); ?>

<?php
    $this->breadcrumbs = array(
        Yii::t($this->aliasModuleT, 'Файлы') => array($this->patchBackend.'index'),
        $model->name => array($this->patchBackend.'view', 'id' => $model->id),
        Yii::t($this->aliasModuleT, 'Редактирование'),
    );

    $this->pageTitle = Yii::t($this->aliasModuleT, 'Файлы - редактирование');

    $this->menu = array(
        array('icon' => 'list-alt',
            'label' => Yii::t($this->aliasModuleT, 'Список файлов'),
            'url' => array($this->patchBackend.'index')
        ),
        array('icon' => 'plus-sign',
            'label' => Yii::t($this->aliasModuleT, 'Добавить файл'),
            'url' => array($this->patchBackend.'create')
        ),
        array('label' => Yii::t($this->aliasModuleT, 'Файл') . ' «' . mb_substr($model->name, 0, 32) . '»'),
        array('icon' => 'trash',
            'label' => Yii::t($this->aliasModuleT, 'Удалить файл'),
            'url' => '#', 'linkOptions' => array(
                'submit' => array($this->patchBackend.'delete', 'id' => $model->id),
                'params' => array(Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken),
                'confirm' => Yii::t($this->aliasModuleT, 'Вы действительно хотите удалить файл?'),
                'csrf' => true,
            )
        ),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t($this->aliasModuleT, 'Редактирование файла'); ?><br />
        <small>&laquo;<?php echo $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php
    $this->renderPartial('_form', array(
    'model'=>$model
    ));
<?php
$this->breadcrumbs = array(
    Yii::t($this->aliasModuleT, 'Файлы') => array($this->patchBackend.'index'),
    Yii::t($this->aliasModuleT, 'Добавление'),
);

$this->pageTitle = 'Добавить новый файл';

$this->menu = array(
    array('icon' => 'list-alt',
        'label' => Yii::t($this->aliasModuleT, 'Список файлов'),
        'url' => array($this->patchBackend.'index'),
    ),
);
?>

<div class="page-header">
    <h1>
        <?php echo 'Файлы'; ?>
        <small><?php echo 'добавление'; ?></small>
    </h1>
</div>

<?php
$this->renderPartial('_form', array(
    'model'=>$model
));
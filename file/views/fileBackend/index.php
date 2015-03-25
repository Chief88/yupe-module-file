<?php
$this->breadcrumbs = array(
    Yii::t($this->aliasModuleT, 'Файлы') => array($this->patchBackend.'index'),
    Yii::t($this->aliasModuleT, 'Список'),
);

$this->pageTitle = Yii::t($this->aliasModuleT, 'Список файлов');

$this->menu = array(
    array('icon' => 'list-alt', 
        'label' => Yii::t($this->aliasModuleT, 'Список файлов'),
        'url' => array($this->patchBackend.'index')),
    array('icon' => 'plus-sign', 
        'label' => Yii::t($this->aliasModuleT, 'Добавить файл'),
        'url' => array($this->patchBackend.'create')),
);
?>

<div class="page-header">
    <h1>
        <?php echo 'Файлы'; ?>
        <small><?php echo 'список'; ?></small>
    </h1>
</div>

    <p><?php echo 'На данной странице представлены средства управления файлами.'; ?></p>

<?php $this->widget(
    'yupe\widgets\CustomGridView',
    array(
        'id'           => 'file-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'sort',
        'sortableAction'    => $this->patchBackend.'sortable',
        'dataProvider'      => $model->search(),
        'filter'            => $model,
        'columns'      => array(
            'id',
            array(
                'name'   => 'category_id',
                'value'  => '$data->getCategoryName()',
                'filter' => CHtml::activeDropDownList(
                    $model,
                    'category_id',
                    Category::model()->getFormattedList(Yii::app()->getModule('file')->mainCategory),
                    array('class' => 'form-control', 'encode' => false, 'empty' => '')
                )
            ),
            'name',
            'image',
            'icon',
            array(
                'class' => 'yupe\widgets\CustomButtonColumn',
            ),
        ),
    )
); ?>
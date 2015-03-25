<?php
$this->breadcrumbs = array(
    Yii::t($this->aliasModuleT, 'Content blocks') => array($this->patchBackend.'index'),
    $model->name,
);

$this->pageTitle = Yii::t($this->aliasModuleT, 'Content blocks - view');

$this->menu = array(
    array(
        'icon'  => 'fa fa-fw fa-list-alt',
        'label' => Yii::t($this->aliasModuleT, 'List file'),
        'url'   => array($this->patchBackend.'index')
    ),
    array(
        'icon'  => 'fa fa-fw fa-plus-square',
        'label' => Yii::t($this->aliasModuleT, 'Add file'),
        'url'   => array($this->patchBackend.'create')
    ),
    array(
        'label' => Yii::t($this->aliasModuleT, 'File') . ' «' . mb_substr(
                $model->name,
                0,
                32
            ) . '»'
    ),
    array(
        'icon'  => 'fa fa-fw fa-pencil',
        'label' => Yii::t($this->aliasModuleT, 'Edit file'),
        'url'   => array(
            $this->patchBackend.'update',
            'id' => $model->id
        )
    ),
    array(
        'icon'  => 'fa fa-fw fa-eye',
        'label' => Yii::t($this->aliasModuleT, 'View file'),
        'url'   => array(
            $this->patchBackend.'view',
            'id' => $model->id
        )
    ),
    array(
        'icon'        => 'fa fa-fw fa-trash-o',
        'label'       => Yii::t($this->aliasModuleT, 'Remove file'),
        'url'         => '#',
        'linkOptions' => array(
            'submit'  => array($this->patchBackend.'delete', 'id' => $model->id),
            'params'  => array(Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken),
            'confirm' => Yii::t($this->aliasModuleT, 'Do you really want to delete content block?'),
        )
    ),
);
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t($this->aliasModuleT, 'View content block'); ?><br/>
        <small>&laquo;<?php echo $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget(
    'bootstrap.widgets.TbDetailView',
    array(
        'data'       => $model,
        'attributes' => array(
            'id',
            'name',
            'image',
            'icon',
            array(
                'name'  => 'category_id',
                'value' => $model->getCategoryName()
            ),
        ),
    )
); ?>

<br/>
<div>
    <?php echo Yii::t($this->aliasModuleT, 'Shortcode for using this block in template:'); ?>
    <br/><br/>
    <div class="code">
        asd
    </div>
    <?php echo $example; ?>
</div>
<div>
    <?php echo Yii::t($this->aliasModuleT, 'Shortcode for using this block group in template:'); ?>
    <br /><br />
    <?php echo $exampleCategory; ?>
    <?php echo Yii::t($this->aliasModuleT, 'Parameter Description:<br><ul><li>category - category code. Required paramert;</li><li>limit - how much of the output. Not obligatory paramert;</li><li>rand - determines how to display units, randomly or not. "true" or "false" (default "false").</li></ul>'); ?>
</div>
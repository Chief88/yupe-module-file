<?php
/**
 * @var $model File
 */
$this->breadcrumbs = [
    Yii::t($this->aliasModule, 'Files') => [$this->patchBackend.'index'],
    $model->name,
];

$this->pageTitle = Yii::t($this->aliasModule, 'File - view');

$this->menu = [
    [
        'label' => Yii::t($this->aliasModule, 'Files'),
        'items' => [
            [
                'icon'  => 'fa fa-fw fa-list-alt',
                'label' => Yii::t($this->aliasModule, 'List file'),
                'url'   => [$this->patchBackend.'index']
            ],
            [
                'icon'  => 'fa fa-fw fa-plus-square',
                'label' => Yii::t($this->aliasModule, 'Add file'),
                'url'   => [$this->patchBackend.'create']
            ],
            [
                'label' => Yii::t($this->aliasModule, 'File') . ' «' . mb_substr(
                        $model->name,
                        0,
                        32
                    ) . '»'
            ],
            [
                'icon'  => 'fa fa-fw fa-pencil',
                'label' => Yii::t($this->aliasModule, 'Edit file'),
                'url'   => [
                    $this->patchBackend.'update',
                    'id' => $model->id
                ]
            ],
            [
                'icon'  => 'fa fa-fw fa-eye',
                'label' => Yii::t($this->aliasModule, 'View file'),
                'url'   => [
                    $this->patchBackend.'view',
                    'id' => $model->id
                ]
            ],
            [
                'icon'        => 'fa fa-fw fa-trash-o',
                'label'       => Yii::t($this->aliasModule, 'Remove file'),
                'url'         => '#',
                'linkOptions' => [
                    'submit'  => [$this->patchBackend.'delete', 'id' => $model->id],
                    'params'  => [Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken],
                    'confirm' => Yii::t($this->aliasModule, 'Do you want to delete the file?'),
                ]
            ],
        ]
    ],
];
?>
<div class="page-header">
    <h1>
        <?= Yii::t($this->aliasModule, 'Viewing file'); ?><br/>
        <small>&laquo;<?= $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget(
    'bootstrap.widgets.TbDetailView',
    [
        'data'       => $model,
        'attributes' => [
            'id',
            'name',
            'slug',
            [
                'name'  => 'image',
                'type'   => 'raw',
                'value'  => $model->image ? CHtml::image($model->getImageUrl(false, 50), $model->name, ['class' => 'img-thumbnail']) : "---",
            ],
            [
                'name'  => 'icon',
                'type'   => 'raw',
                'value'  => $model->icon ? CHtml::openTag('i', ['class' => 'fa fa-lg fa-' . $model->icon]) . CHtml::closeTag('i') : "---",
            ],
            [
                'name'  => 'category_id',
                'value' => $model->getCategoryName()
            ],
        ],
    ]
); ?>

<br/>
<div>
    <?= Yii::t($this->aliasModule, 'Code to output this file in the template'); ?>:
    <br/><br/>
    <?= $example; ?>
</div>
<div>
    <?= Yii::t($this->aliasModule, 'Code to output this file with the group in the template'); ?>:
    <br /><br />
    <?= $exampleCategory; ?>
    <?= Yii::t($this->aliasModule, 'Parameter Description:<br><ul><li>category - category code. Required paramert;</li><li>limit - how much of the output. Not obligatory paramert;</li><li>rand - determines how to display units, randomly or not. "true" or "false" (default "false").</li></ul>'); ?>
</div>
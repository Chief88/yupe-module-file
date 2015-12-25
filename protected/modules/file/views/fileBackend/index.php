<?php
$this->breadcrumbs = [
    Yii::t($this->aliasModule, 'Files') => [$this->patchBackend.'index'],
    Yii::t($this->aliasModule, 'List'),
];

$this->pageTitle = Yii::t($this->aliasModule, 'List file');

$this->menu = [
    [
        'label' => Yii::t($this->aliasModule, 'Files'),
        'items' => [
            ['icon' => 'list-alt',
                'label' => Yii::t($this->aliasModule, 'List file'),
                'url' => [$this->patchBackend.'index']
            ],
            ['icon' => 'plus-sign',
                'label' => Yii::t($this->aliasModule, 'Add file'),
                'url' => [$this->patchBackend.'create']
            ],
        ]
    ],
]; ?>

<div class="page-header">
    <h1>
        <?= Yii::t($this->aliasModule, 'Files'); ?>
        <small><?= Yii::t($this->aliasModule, 'management'); ?></small>
    </h1>
</div>

<?php $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'file-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'sort',
        'sortableAction'    => $this->patchBackend.'sortable',
        'dataProvider'      => $model->search(),
        'filter'            => $model,
        'columns'      => [
            'id',
            [
                'name'   => 'category_id',
                'value'  => '$data->getCategoryName()',
                'filter' => CHtml::activeDropDownList(
                    $model,
                    'category_id',
                    Category::model()->getFormattedList(Yii::app()->getModule('file')->mainCategory),
                    ['class' => 'form-control', 'encode' => false, 'empty' => '']
                )
            ],
            'name',
            [
                'name'   => 'image',
                'type'   => 'raw',
                'value'  => '$data->image ? CHtml::image($data->getImageUrl(false, 50), $data->name, ["class" => "img-thumbnail"]) : "---"',
                'filter' => false
            ],
            [
                'name'  => 'icon',
                'type'   => 'raw',
                'value'  => '$data->icon ? CHtml::openTag("i", ["class" => "fa fa-lg fa-" . $data->icon]) . CHtml::closeTag("i") : "---"',
            ],
            ['class' => 'yupe\widgets\CustomButtonColumn',],
        ],
    ]
); ?>
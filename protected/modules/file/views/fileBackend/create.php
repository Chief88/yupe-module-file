<?php
$this->breadcrumbs = [
    Yii::t($this->aliasModule, 'Files') => [$this->patchBackend.'index'],
    Yii::t($this->aliasModule, 'Add'),
];

$this->pageTitle = 'Add new file';

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
        <small><?= Yii::t($this->aliasModule, 'add'); ?></small>
    </h1>
</div>

<?php
$this->renderPartial('_form', [
    'model'=>$model
]);
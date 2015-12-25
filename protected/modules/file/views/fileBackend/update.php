<?php
$this->breadcrumbs = [
    Yii::t($this->aliasModule, 'Files') => [$this->patchBackend.'index'],
    $model->name => [$this->patchBackend.'view', 'id' => $model->id],
    Yii::t($this->aliasModule, 'Editing'),
];

$this->pageTitle = Yii::t($this->aliasModule, 'Editing file') . ': ' . $model->name;

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
            ['label' => Yii::t($this->aliasModule, 'File') . ' «' . mb_substr($model->name, 0, 32) . '»'],
            ['icon' => 'trash',
                'label' => Yii::t($this->aliasModule, 'Delete file'),
                'url' => '#', 'linkOptions' => [
                    'submit' => [$this->patchBackend.'delete', 'id' => $model->id],
                    'params' => [Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken],
                    'confirm' => Yii::t($this->aliasModule, 'Do you want to delete the file?'),
                    'csrf' => true,
                ]
            ],
        ]
    ],
]; ?>
<div class="page-header">
    <h1>
        <?= Yii::t($this->aliasModule, 'Editing file'); ?><br />
        <small>&laquo;<?= $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php
$this->renderPartial('_form', [
    'model'=>$model
]);
?>
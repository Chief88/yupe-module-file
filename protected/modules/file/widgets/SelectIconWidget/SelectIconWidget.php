<?php
class SelectIconWidget extends CWidget{

    public $nameField;
    public $namesIcons = [
        'file',
        'file-archive-o',
        'file-audio-o',
        'file-code-o',
        'file-excel-o',
        'file-image-o',
        'file-movie-o',
        'file-o',
        'file-pdf-o',
        'file-photo-o',
        'file-picture-o',
        'file-powerpoint-o',
        'file-sound-o',
        'file-text',
        'file-text-o',
        'file-video-o',
        'file-word-o',
        'file-zip-o',
        
    ];

    public function init(){
        // этот метод будет вызван внутри CBaseController::beginWidget()
    }

    public function run(){

        Yii::app()->clientScript->registerCoreScript('jquery');

        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->assetManager->publish(
                Yii::getPathOfAlias('application.modules.file.widgets.SelectIconWidget.assets.js').'/selectIconWidget.js'
            ),
            CClientScript::POS_HEAD
        );

        Yii::app()->clientScript->registerCssFile(
            Yii::app()->assetManager->publish(
                Yii::getPathOfAlias('application.modules.file.widgets.SelectIconWidget.assets.css').'/selectIconWidget.css'
            )
        );

        $this->render('//selectIconWidget', [
            'nameField' => $this->nameField,
            'namesIcons' => $this->namesIcons,
        ]);

    }
}
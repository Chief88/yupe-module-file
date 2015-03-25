<?php

use yupe\components\WebModule;

class FileModule extends WebModule
{
    const VERSION = '0.9';

    public $uploadPath        = 'files';
    public $allowedExtensionsFile = 'pdf,xls,xlsx';
    public $allowedExtensions = 'jpg,jpeg,png,gif';
    public $minSize           = 0;
    public $maxSize           = 5368709120;
    public $maxFiles          = 1;

    public  $aliasModuleT = 'FileModule.file';
    public  $patchBackend = '/file/fileBackend/';

    public function getUploadPath()
    {
        return Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath;
    }

    public function getInstall()
    {
        if (parent::getInstall()) {
            @mkdir(Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath, 0755);
        }

        return false;
    }

    public function checkSelf()
    {
        $messages = array();

        $uploadPath = Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath;

        if (!is_writable($uploadPath))
            $messages[WebModule::CHECK_ERROR][] =  array(
                'type'    => WebModule::CHECK_ERROR,
                'message' => Yii::t($this->aliasModuleT, 'Directory "{dir}" is not accessible for write! {link}', array(
                    '{dir}'  => $uploadPath,
                    '{link}' => CHtml::link(Yii::t($this->aliasModuleT, 'Change settings'), array(
                        '/yupe/backend/modulesettings/',
                        'module' => 'File',
                    )),
                )),
            );

        return (isset($messages[WebModule::CHECK_ERROR])) ? $messages : true;
    }

    public function getParamsLabels()
    {
        return array(
            'mainCategory'      => Yii::t($this->aliasModuleT, 'Main social group category'),
            'adminMenuOrder'    => Yii::t($this->aliasModuleT, 'Menu items order'),
            'editor'            => Yii::t($this->aliasModuleT, 'Visual Editor'),
            'uploadPath'        => Yii::t($this->aliasModuleT, 'Uploading files catalog (relatively {path})', array('{path}' => Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . Yii::app()->getModule("yupe")->uploadPath)),
            'allowedExtensions' => Yii::t($this->aliasModuleT, 'Accepted extensions (separated by comma)'),
            'minSize'           => Yii::t($this->aliasModuleT, 'Minimum size (in bytes)'),
            'maxSize'           => Yii::t($this->aliasModuleT, 'Maximum size (in bytes)'),
        );
    }

    public function getEditableParams()
    {
        return array(
            'adminMenuOrder',
            'editor'       => Yii::app()->getModule('yupe')->getEditors(),
            'mainCategory' => CHtml::listData($this->getCategoryList(),'id','name'),
            'uploadPath',
            'allowedExtensions',
            'minSize',
            'maxSize',
        );
    }

    public function getEditableParamsGroups()
    {
        return array(
            'main' => array(
                'label' => Yii::t($this->aliasModuleT, 'General module settings'),
                'items' => array(
                    'adminMenuOrder',
                    'editor',
                    'mainCategory'
                )
            ),
            'images' => array(
                'label' => Yii::t($this->aliasModuleT, 'Images settings'),
                'items' => array(
                    'uploadPath',
                    'allowedExtensions',
                    'minSize',
                    'maxSize'
                )
            ),
            'list' => array(
                'label' => Yii::t($this->aliasModuleT, 'File group lists'),
            ),
        );
    }

    public function getVersion()
    {
        return self::VERSION;
    }

    public function getIsInstallDefault()
    {
        return true;
    }

    public function getCategory()
    {
        return 'Контент';
    }

    public function getName()
    {
        return 'Файлы';
    }

    public function getDescription()
    {
        return 'Модуль для файлов';
    }

    public function getAuthor()
    {
        return Yii::t($this->aliasModuleT, 'adelfo development');
    }

    public function getAuthorEmail()
    {
        return Yii::t($this->aliasModuleT, 'serg.latyshkov@gmail.com');
    }

    public function getUrl()
    {
        return Yii::t($this->aliasModuleT, 'http://adelfo-studio.ru/');
    }

    public function getIcon()
    {
        return "fa fa-file-pdf-o";
    }

    public function getAdminPageLink()
    {
        return $this->patchBackend.'index';
    }

    public function getNavigation()
    {
        return array(
            array('icon' => 'fa fa-fw fa-list-alt',
                'label' => 'Файлы список',
                'url' => array($this->patchBackend.'index')
            ),
            array('icon' => 'fa fa-fw fa-plus-square',
                'label' => 'Файлы добавить',
                'url' => array($this->patchBackend.'create')
            ),
        );
    }

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'file.models.*'
        ));
    }
}
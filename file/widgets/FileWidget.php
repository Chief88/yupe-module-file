<?php
Yii::import('application.modules.file.models.File');
Yii::import('application.modules.file.FileModule');

class FileWidget extends yupe\widgets\YWidget
{
    public $code;
    public $view = 'file';
    public $params = [];

    public function init()
    {
        if (empty($this->code)) {
            throw new CException(
                Yii::t(
                    'FileModule.file',
                    'Insert content block title for FileWidget!'
                )
            );
        }

    }

    public function run()
    {

        $file = File::model()->find('code = :code', array(':code' => $this->code));

        if ( !empty($file) ) {
            $this->render($this->view, array(
                'file' => $file,
                'params' => $this->params,
                )
            );
        }

    }
}

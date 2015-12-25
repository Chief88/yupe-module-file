<?php
Yii::import('application.modules.file.models.File');
Yii::import('application.modules.file.FileModule');

class FileWidget extends yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $view = 'file';

    /**
     * @var array
     */
    public $params = [];

    /**
     * @throws CException
     */
    public function init()
    {
        if (empty($this->slug)) {
            throw new CException(
                Yii::t(
                    'FileModule.file',
                    'Insert content block title for FileWidget!'
                )
            );
        }

    }

    /**
     * @throws CException
     */
    public function run()
    {
        $file = File::model()->find('slug = :slug', [':slug' => $this->slug]);

        if (!empty($file)) {
            $this->render($this->view, [
                    'file' => $file,
                    'params' => $this->params,
                ]
            );
        }

    }
}

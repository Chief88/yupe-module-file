<?php

Yii::import('application.modules.file.models.File');
Yii::import('application.modules.file.FileModule');

class FileGroupWidget extends yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $category;

    /**
     * @var integer
     */
    public $limit;

    /**
     * @var bool
     */
    public $rand = false;

    /**
     * @var string
     */
    public $view = 'filegroup';

    /**
     * @throws CException
     */
    public function init()
    {
        if (!empty($this->category)) {
            $category = Category::model()->find('slug = :category', [':category' => $this->category]);

            if (null === $category) {
                throw new CException(Yii::t(
                    'FileModule.file',
                    'Category "{category}" does not exist, please enter the unsettled category',
                    [
                        '{category}' => $this->category
                    ]
                ));
            }
        }
        $this->rand = (int)$this->rand;
    }

    /**
     * @throws CException
     */
    public function run()
    {
        $criteria = new CDbCriteria;
        if (!empty($this->category)) {
            $category = Category::model()->find('slug = :category', [':category' => $this->category]);
            $criteria->addCondition('category_id = :category_id');
            $criteria->params[':category_id'] = $category->id;
        }

        if ($this->rand) {
            $criteria->order = 'RAND()';
        }

        if ($this->limit) {
            $criteria->limit = (int)$this->limit;
        }

        $files = File::model()->findAll($criteria);

        if (!empty($files)) {
            $this->render($this->view, ['files' => $files]);
        }
    }
}

<?php

Yii::import('application.modules.file.models.File');
Yii::import('application.modules.file.FileModule');

class FileGroupWidget extends yupe\widgets\YWidget
{
    public $category;
    public $limit;
    public $rand      = false;
    public $view      = 'filegroup';

    public function init()
    {
        if (!empty($this->category)) {

            $category = Category::model()->find('alias = :category', array(':category' => $this->category));

            if (null === $category) {
                throw new CException(Yii::t(
                    'FileModule.file',
                    'Category "{category}" does not exist, please enter the unsettled category',
                    array(
                        '{category}' => $this->category
                    )
                ));
            }

        }
        $this->rand      = (int)$this->rand;
    }

    public function run(){

        $criteria = new CDbCriteria;
        if(!empty($this->category)){
            $category = Category::model()->find('alias = :category', array(':category' => $this->category));
            $criteria->addCondition('category_id = :category_id');
            $criteria->params[':category_id'] = $category->id;
        }

        if ( $this->rand ) {
            $criteria->order = 'RAND()';
        }

        if ( $this->limit ) {
            $criteria->limit  = (int)$this->limit;
        }

        $files = File::model()->findAll($criteria);

        if (!empty($files)) {
            $this->render($this->view, array('files' => $files));
        }

    }
}

<?php

class File extends yupe\models\YModel{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{file_file}}';
    }

    /**
     * Returns the static model of the specified AR class.
     *
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'name'          => 'Подпись к файлу',
            'file'          => 'Загрузить файл',
            'image'         => 'Загрузить иконку',
            'icon'          => 'Выбрать иконку',
            'category_id'   => 'Категория',
            'sort'          => 'Сортировка',
            'code'          => 'Code',
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('file, name', 'required'),
            array('name, code', 'filter', 'filter' => 'trim'),
            array('name, code', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
            array('name', 'length', 'max'=>50),
            array('sort, category_id', 'numerical', 'integerOnly' => true),
            array('category_id', 'default', 'setOnEmpty' => true, 'value' => null),
            array('icon', 'length', 'max'=>255),
            array('code', 'length', 'max' => 100),
            array(
                'code',
                'yupe\components\validators\YSLugValidator',
                'message' => Yii::t(
                    'FileModule.file',
                    'Unknown field format "{attribute}" only alphas, digits and _, from 2 to 50 characters'
                )
            ),
            array('code', 'unique'),
            array('code, sort, category_id, file, image, name, icon', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria();

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('category_id', $this->category_id, true);
        $criteria->compare('t.sort', $this->sort);
        $criteria->with = array('category');

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'sort'     => array('defaultOrder' => 't.sort')
        ));
    }

    public function afterDelete()
    {
        @unlink(Yii::app()->getModule('file')->getUploadPath() . '/' . $this->image);
        @unlink(Yii::app()->getModule('file')->getUploadPath() . '/' . $this->file);

        return parent::afterDelete();
    }

    public function deleteImage($imageName)
    {
        return unlink(Yii::app()->getModule('file')->getUploadPath() . '/' . $imageName);

    }

    public function getAllPagesList($selfId = false)
    {
        $criteria = new CDbCriteria;
        $criteria->order = "{$this->tableAlias}.name DESC";
        if ($selfId) {
            $otherCriteria = new CDbCriteria;
            $otherCriteria->addNotInCondition('id', (array)$selfId);
            $otherCriteria->group = "{$this->tableAlias}.slug, {$this->tableAlias}.id";
            $criteria->mergeWith($otherCriteria);
        }
        return CHtml::listData($this->findAll($criteria), 'id', 'name');
    }

    public function behaviors()
    {
        $module = Yii::app()->getModule('file');

        return array(
            'imageUpload' => array(
                'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
                'scenarios'     => array('insert', 'update'),
                'attributeName' => 'image',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'uploadPath'    => $module->uploadPath,
            ),
            'fileUpload' => array(
                'class'         => 'yupe\components\behaviors\FileUploadBehavior',
                'scenarios'     => array('insert', 'update'),
                'attributeName' => 'file',
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensionsFile,
                'uploadPath'    => $module->uploadPath,
            ),
        );
    }

    public function sort(array $items){

        $transaction = Yii::app()->db->beginTransaction();

        try {

            foreach ($items as $id => $priority) {

                $model = $this->findByPk($id);

                if (null === $model) {
                    continue;
                }

                $model->sort = (int)$priority;

                if (!$model->update('sort')) {
                    throw new CDbException('Error sort menu items!');
                }
            }

            $transaction->commit();

            return true;
        } catch (Exception $e) {
            $transaction->rollback();

            return false;
        }
    }

    public function getCategoryName(){
        return ($this->category === null) ? '---' : $this->category->name;
    }

    public function getCategoryAlias(){
        return empty($this->category) ? '<code_category>' : $this->category->alias;
    }

    public function getUrlFile()
    {
        return Yii::app()->uploadManager->getFileUrl($this->file, Yii::app()->getModule('file')->uploadPath);
    }

} 
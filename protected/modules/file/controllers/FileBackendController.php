<?php

Yii::import('application.modules.menu.models.*');

class FileBackendController extends yupe\components\controllers\BackController{
    
    private $_model;

    public  $aliasModule = 'FileModule.file';
    public  $patchBackend = '/file/fileBackend/';

	public function actionIndex(){
        $model = new File('search');

        $model->unsetAttributes();

        $model->setAttributes(
            Yii::app()->getRequest()->getParam(
                'File', array()
            )
        );

        $this->render(
            'index', array(
                'model' => $model,
                'pages' => File::model()->getAllPagesList(),
            )
        );
	}

    public function actionCreate(){
        $model = new File();

        if(isset($_POST['File'])){
            $model->attributes = $_POST['File'];
            if($model->validate()){
                $model->save();
                $this->redirect(array('index'));
            }
        }

        $criteria = new CDbCriteria();

        $criteria->select = new CDbExpression('MAX(sort) as sort');
        $max = $model->find($criteria);
        $model->sort = $max->sort + 1; // Set sort in Adding Form as ma x+ 1

        $this->render(
            'create', array(
                'model' => $model,
            )
        );
	}

    public function actionView($id){
        $model = $this->loadModel($id);

        $code = "<?php \$this->widget(\n\t\"application.modules.file.widgets.FileWidget\",\n\tarray(\"code\" => \"{$model->slug}\"));\n?>";
        $codeCategory          = "<?php \$this->widget(\n\t\"application.modules.file.widgets.FileGroupWidget\",\n\tarray(\"category\" => \"{$model->getCategoryAlias()}\"));\n?>";

        $highlighter = new CTextHighlighter();
        $highlighter->language = 'PHP';
        $example = $highlighter->highlight($code);
        $exampleCategory = $highlighter->highlight($codeCategory);

        $this->render(
            'view',
            array(
                'model'   => $model,
                'example' => $example,
                'exampleCategory' => $exampleCategory
            )
        );
    }

    public function actionSortable()
    {
        $sortOrder = Yii::app()->request->getPost('sortOrder');

        if (empty($sortOrder)) {
            throw new CHttpException(404);
        }

        if (File::model()->sort($sortOrder)) {
            Yii::app()->ajax->success();
        }

        Yii::app()->ajax->failure();
    }

    public function actionUpdate($id){

        // Указан ID страницы, редактируем только ее
        $model = $this->loadModel($id);

        $oldTitle     = $model->name;
        $menuId       = null;
        $menuParentId = 0;

        if (($data = Yii::app()->getRequest()->getPost('File')) !== null) {

            $model->attributes = $data;

            if ($model->save()) {

                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t($this->aliasModule, 'Файл обновлен!')
                );

                $this->redirect(
                    (array) Yii::app()->getRequest()->getPost(
                        'submit-type', array('update', 'id' => $model->id)
                    )
                );
            }
        }

        if (Yii::app()->hasModule('menu')) {

            $menuItem = MenuItem::model()->findByAttributes(
                array(
                    "title"=>$oldTitle
                )
            );

            if ($menuItem !== null) {
                $menuId       = (int)$menuItem->menu_id;
                $menuParentId = (int)$menuItem->parent_id;
            }
        }

        $this->render(
            'update', array(
                'model'        => $model,
                'menuId'       =>$menuId,
                'menuParentId' =>$menuParentId
            )
        );

    }

    public function actionDelete($id = null){
        if (Yii::app()->getRequest()->getIsPostRequest()) {

            $model = $this->loadModel($id);

            // we only allow deletion via POST request
            $model->delete();

            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t($this->aliasModule, 'Файл успешно удален!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            Yii::app()->getRequest()->getParam('ajax') !== null || $this->redirect(
                (array) Yii::app()->getRequest()->getPost('returnUrl', 'index')
            );
        } else {
            throw new CHttpException(
                404,
                Yii::t($this->aliasModule, 'Bad request. Please don\'t repeat similar requests anymore!')
            );
        }
    }

    public function actionDeleteImage($id)
    {
        $file = new File();
        if (($file = File::model()->findByPk($id)) === null) {
            throw new CHttpException(
                404,
                Yii::t($this->aliasModule, 'Page was not found!')
            );
        }

        if ( $file->deleteImage($file->image) ){
            $file->image = '';
            $file->save();
            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t($this->aliasModule, 'Файл удален!')
            );
            echo \CJSON::encode(array(
                'result'=>true,
            ));
        }else{
            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                Yii::t($this->aliasModule, 'Ошибка при удалении файла!')
            );
            echo \CJSON::encode(array(
                'result'=>false,
            ));
        }

        $this->redirect(
            Yii::app()->createAbsoluteUrl(
                $this->patchBackend.'update',
                array(
                    'id' => $id
                )
            )
        );
    }

    public function loadModel($id)
    {
        if ($this->_model === null || $this->_model->id !== $id) {

            if (($this->_model = File::model()->findByPk($id)) === null) {
                throw new CHttpException(
                    404,
                    Yii::t($this->aliasModule, 'Page was not found')
                );
            }
        }

        return $this->_model;
    }

}
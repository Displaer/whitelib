<?php

class AuthorsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','rest'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TblAuthors;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblAuthors']))
		{
			$model->attributes=$_POST['TblAuthors'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblAuthors']))
		{
			$model->attributes=$_POST['TblAuthors'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TblAuthors');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TblAuthors('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblAuthors']))
			$model->attributes=$_GET['TblAuthors'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TblAuthors the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TblAuthors::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    public function actionRest(){
        /*{product:"ba0",settings:"programm",action:list,}*/
        if(Yii::app()->request->isPostRequest)
        {
            if(isset($_POST['product'])) {
                switch ($_POST['product']) {
                    case "reader":{
                        $action = trim($_POST['action']);
                        switch ($action) {
                            case "list":{

                                $model = TblAuthors::model()->findAll("deleted='no'");


                                if($model){
                                    $fields = ['id', 'author_key', 'borndate', 'fullname', 'books'];

                                    $head = [];
                                    foreach ($fields as $fld){
                                        if (
                                            $fld!='id'
                                        ){

                                            if($fld=='books'){
                                                $head[$fld] = 'Книги';
                                            } else {
                                                $head[$fld] = ($model[0]->attributeLabels())[$fld];
                                            }
                                        }
                                    }

                                    $data = [];
                                    foreach ($model as $item) {
                                        $row = [];
                                        foreach ($fields as $fld){
                                            if($fld=='books')
                                                $row[$fld] = $item->getBooks();
                                            else
                                                $row[$fld] = $item->$fld;
                                        }
                                        $data[] = $row;
                                    }


                                    $table = ['data'=>$data, 'head'=>$head];
                                    print(json_encode(['error'=>false,'table'=>$table], JSON_OBJECT_AS_ARRAY));
                                } else {
                                    print(json_encode(['error'=>true,'message'=>'Empty data']));
                                }


                            }
                                break;
                        }


                    }
                        break;
                }
            } else {
                throw new CHttpException(400, Yii::t('error','incorrect_parameters'));
            }
        }
        else
        {
            throw new CHttpException(400, Yii::t('error','invalid_request_do_not_repeat'));
        }


        Yii::app()->end();
    }



    /**
	 * Performs the AJAX validation.
	 * @param TblAuthors $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-authors-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

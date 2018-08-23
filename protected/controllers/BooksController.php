<?php

class BooksController extends Controller
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
		$model=new TblBooks;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblBooks']))
		{
			$model->attributes=$_POST['TblBooks'];
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

		if(isset($_POST['TblBooks']))
		{
			$model->attributes=$_POST['TblBooks'];
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
		$dataProvider=new CActiveDataProvider('TblBooks');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TblBooks('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblBooks']))
			$model->attributes=$_GET['TblBooks'];

		$this->render('admin',array(
			'model'=>$model,
		));
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
                            case "form":{


                                $template = '<table class="table table-borderless table-hover" ><tbody ><tr ><td ><input activate="word" class="activeWordSearch activate" type="checkbox"/ ></td ><td ><input class="form-control queryWord word" type="text" placeholder="Слово"/ ></td ><td ><label style="white-space: nowrap;" ><input class="inBookName word" type="checkbox" checked/> В назвнии книгах </label ><label style="white-space: nowrap;" ><input class="inAuthorName word" type="checkbox" checked/> В ФИО авторах </label ></td ></tr ><tr ><td ><input activate="year" class="activeYearSearch activate" type="checkbox"/ ></td ><td ><input class="form-control queryYear year" type="number" placeholder="Год издания/написания"/ ></td ><td ><label style="white-space: nowrap;" ><input class="nonYear year" type="checkbox"/> Не указанно </label ></td ></tr ><tr ><td ><input activate="count" class="activeAuthorCountSearch activate" type="checkbox"/ ></td ><td ><input class="form-control queryCount count" type="number" placeholder="Количество Авторов"/ ></td ><td ><label style="white-space: nowrap;" ><input class="nonCount count" type="checkbox"/> Не указанно </label ></td ></tr ><tr ><td colspan="3" ><div class=" btn-group" ><button class="btn btn-primary btn-search">Поиск</button ><button class="btn btn-danger btn-reset">Сброс</button ></div ></td ></tr ></tbody></table>';

                                print  $template;
                            }
                                break;
                            case "list":{

                                if (isset($_POST['filter'])) {
                                    $model = $this->applyFilter($_POST['filter']);
                                } else {
                                    $model = TblBooks::model()->findAll("deleted='no'");
                                }

                                if($model){
                                    $fields = ['id', 'name', 'longname', 'published_year', 'authors', 'page_count'];

                                    $head = [];
                                    foreach ($fields as $fld){
                                        if (
                                            $fld!='id'
                                        ){

                                            if($fld=='authors'){
                                                $head[$fld] = 'Авторы';
                                            } else {
                                                $head[$fld] = ($model[0]->attributeLabels())[$fld];
                                            }
                                        }
                                    }

                                    $data = [];
                                    foreach ($model as $item) {
                                        $row = [];
                                        foreach ($fields as $fld){
                                            if($fld=='authors')
                                                $row[$fld] = $item->getAuthors();
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
                            case "add":{}
                                break;
                            case "remove":{}
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TblBooks the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TblBooks::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TblBooks $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-books-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected function applyFilter($filter) {
        $word = isset($filter['word']) ? $filter['word'] : null;
        $year = isset($filter['year']) ? $filter['year'] : null;
        $count = isset($filter['count']) ? $filter['count'] : null;


        $criteria = new CDbCriteria();

        if ($word['active']) {
            if($word['inBookName'] == 'true' and !empty($word['query'])) {
                $criteria->addSearchCondition('name',$word['query'],true,'OR');
                $criteria->addSearchCondition('longname',$word['query'],true,'OR');
                $criteria->addSearchCondition('annotation',$word['query'],true,'OR');
            }

            if($word['inAuthorName']  == 'true' and !empty($word['query'])) {

                $authorCriteria = new CDbCriteria();
                $authorCriteria->addSearchCondition('fullname', $word['query']);
                $authors = TblAuthors::model()->findAll($authorCriteria);

                $authorArrID = [];
                if($authors) {
                    foreach ($authors as $author) {
                        $authorArrID[] = $author->id;
                    }

                    $linkCriteria = new CDbCriteria();
                    $linkCriteria->addInCondition('author_id', $authorArrID);
                    $linkModel = LnkBookAuthor::model()->findAll($linkCriteria);
                    $bookArrID = [];
                    if($linkModel){
                        foreach ($linkModel as $link) {
                            $bookArrID[] = $link->book_id;
                        }

                        $criteria->addInCondition('id', $bookArrID,'OR');
                    }
                }

            }
        }

        if ($year['active']) {
            if($year['none'] == 'true'){
                $criteria->addCondition('published_year IS NULL');
            } else {
                if(!empty($year['query'])){
                    $criteria->addCondition('`published_year` = :year', 'OR');
                    $criteria->params = [':year'=>intval($year['query'])];
                }
            }
        }


        $model = TblBooks::model()->findAll($criteria);

        if($model) {
            if ($count['active']) {
                if($count['none'] == 'true'){

                    $newModel=[];
                    foreach ($model as $submodel){
                        $authors = $submodel->getAuthors();
                        if(empty($authors)) {
                            $newModel[] = $submodel;
                        }
                    }

                    $model = $newModel;

                } else {
                    if(!empty($count['query'])){
                        $countAuthor = intval($count['query']);
                        $newModel=[];
                        foreach ($model as $submodel){
                            $authors = $submodel->getAuthors('arr');
                            if(count($authors) == $countAuthor) {
                                $newModel[] = $submodel;
                            }
                        }

                        $model = $newModel;
                    }
                }
            }
        }

        return $model;
    } // end func

}

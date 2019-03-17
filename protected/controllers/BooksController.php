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
        $model = TblBooks::model();
		$this->render('index',array(
            'model'=>$model,
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
                                $template = '';

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
                                    $table = ['data'=>[], 'head'=>['По Вашему запросу ничего не найдено']];
                                    print(json_encode(['error'=>false,'table'=>$table], JSON_OBJECT_AS_ARRAY));
                                    //print(json_encode(['error'=>true,'message'=>'Empty data']));
                                }


                            }
                                break;
                            case "one":{
                                if(isset($_POST['id'])){

                                    $model = $this->loadModel($_POST['id']);

                                    if($model) {


                                        $this->renderPartial('one',array(
                                            'model'=>$model,
                                        ));

                                        /*die
                                        $row = [];
                                        $col = [];

                                        $col[] = sprintf('<td colspan="2" align="right"><button class="btn btn-danger btn-close right">%s</button></td>', 'x');
                                        $row[] = sprintf('<tr>%s</tr>', implode('',$col));
                                        $col = [];

                                        $col[] = sprintf('<th colspan="2"><h2>%s</h2></th>', $model->name);
                                        $row[] = sprintf('<tr>%s</tr>', implode('',$col));
                                        $col = [];

                                        $col[] = sprintf('<td rowspan="2"><img src="%s" width="180"></td>', (($model->cover_erl) ? $model->cover_erl:Yii::app()->request->baseUrl . '/images/nocover.jpeg'));
                                        $col[] = sprintf('<td>%s</td>', $model->longname);

                                        $row[] = sprintf('<tr>%s</tr>', implode('',$col));
                                        $col = [];
                                        $col[] = sprintf('<td>Автор(ы):<br>%s</td>', $model->getAuthors());
                                        $row[] = sprintf('<tr>%s</tr>', implode('',$col));
                                        $col = [];

                                        $col[] = sprintf('<td colspan="2"><p>Аннотация</p><p>%s</p></td>', $model->annotation);


                                        $row[] = sprintf('<tr> %s</tr>', implode('',$col));
                                        $col = [];

                                        $col[] = sprintf('<td>Год:%s</td>', $model->published_year);
                                        $col[] = sprintf('<td>Страниц:%s</td>', $model->page_count);

                                        $row[] = sprintf('<tr>%s</tr>', implode('',$col));



                                        printf('<table class="table table-hover">%s</table>', implode('', $row));*/


                                    } else {
                                        echo 'Wrong request';
                                    }
                                } else {
                                    echo 'Wrong request';
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
                $criteria->addCondition('published_year IS NULL', 'OR');
            } else {
                if(!empty($year['query'])){
                    $criteria->addCondition(sprintf('published_year = %d',$year['query']), 'OR');
                    //$criteria->params = [':year'=>intval($year['query'])];
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

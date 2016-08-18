<?php

class TblSkillController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),

			array('deny',  // deny all users
				'users'=>array('guest'),
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
		$model=new TblSkill;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblSkill']))
		{
			$model->attributes=$_POST['TblSkill'];
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

		if(isset($_POST['TblSkill']))
		{
			$model->attributes=$_POST['TblSkill'];
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
		$userID = Yii::app()->user->id;
		$model = TblSkill::model()->getSkillNotOfUser();
		$userSkill = TblUserSkill::model()->getSkillOfUser($userID);
		$this->render('index',array(
			'model'=>$model,
			'userSkill' => $userSkill,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TblSkill('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblSkill']))
			$model->attributes=$_GET['TblSkill'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAjaxRequest()
	{	
		$content = '';
		if (isset($_POST['listSkillCheck'])) {
			$listIDSkill = $_POST['listSkillCheck'];
		}
		if (isset($listIDSkill)) {
			foreach ($listIDSkill as $key => $value) {
				$TblUserSkill = new TblUserSkill;
				$TblUserSkill->skill_id=$value;
				$TblUserSkill->user_id=Yii::app()->user->id;
				$TblUserSkill->save();
				if ($TblUserSkill->save()) {
					$infoSkill = TblSkill::model()->findByPk($value);
					if (isset($infoSkill)) {
						$content .= '<li class="list-group-item">'.$infoSkill["skillname"].'</li>';
					}
					
				}
			}
			die($content);
		}
		die("error");
	}

	public function actionAjaxClear()
	{	
		$TblUserSkill = new TblUserSkill;
		TblUserSkill::model()->deleteAll("user_id ='" . Yii::app()->user->id . "'");
		die();
	}


	public function loadModelSkillOfUser($id)
	{
		$model=TblUserSkill::model()->findByAttributes($id);
		return $model;
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TblSkill the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TblSkill::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TblSkill $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-skill-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

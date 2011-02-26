<?php

class JobController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
        );
    }

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('index','view', 'create', 'captcha'),
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
		$model=new Job;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Job']))
		{
			$model->attributes=$_POST['Job'];
            // $scenario = Yii::app()->user->isGuest ? 'anonymous' : null;

			if( $model->validate() )
			{
				$model->image 	= CUploadedFile::getInstance( $model, 'image' );
				if( isset( $model->image ) )
				{
					$file_name = MUtility::strToPretty( $model->image->name ) . time() . '.' . $model->image->extensionName;
					// $file	= dirname(Yii::app()->request->scriptFile) . DIRECTORY_SEPARATOR . 'uploads/logos' . DIRECTORY_SEPARATOR . $model->image->name;
					$file	= dirname(Yii::app()->request->scriptFile) . '/images/uploads/logos/' . $file_name;
					$model->image->saveAs( $file );
					$model->logo = $file_name;
				}

				if($model->save( false ))
				{
					$this->redirect(array('view','id'=>$model->id));
				}
			}
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

		if(isset($_POST['Job']))
		{
			$model->attributes=$_POST['Job'];

			if( $model->validate() )
            {
				$model->image 	= CUploadedFile::getInstance( $model, 'image' );
				if( isset( $model->image ) )
				{
					$file_name = MUtility::strToPretty( $model->image->name ) . time() . '.' . $model->image->extensionName;
					// $file	= dirname(Yii::app()->request->scriptFile) . DIRECTORY_SEPARATOR . 'uploads/logos' . DIRECTORY_SEPARATOR . $model->image->name;
					$file	= dirname(Yii::app()->request->scriptFile) . '/images/uploads/logos/' . $file_name;
					$model->image->saveAs( $file );
					$model->logo = $file_name;
				}

			    if($model->save( false ))
                {
				    $this->redirect(array('view','id'=>$model->id));
                }
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if( !isset( $_SESSION ) )
		{
			session_start();
		}

		if( isset( $_GET['addfilter'] ) || isset( $_GET['removefilter'] ) )
		{
			if( isset( $_GET['addfilter'] ) )
			{
				$_SESSION['filter'][] = $_GET['addfilter'];
			}
			else
			{
				$key = array_search( $_GET['removefilter'], $_SESSION['filter'] );
				if( $key !== false )
				{
					unset( $_SESSION['filter'][$key] );
				}
			}

			sort( $_SESSION['filter'] );
			$jobs = Job::model()->jobtype( $_SESSION['filter']  )->active()->findAll();
		}
		else
		{
			// if we came without any of these parameters, just flush the session
			unset( $_SESSION['filter'] );
		}

		if( ! isset( $jobs ) )
		{
			$jobs = Job::model()->active()->findAll();
		}

		$this->render('index',array(
			'jobs'=>$jobs,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Job('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Job']))
			$model->attributes=$_GET['Job'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Job::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='job-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

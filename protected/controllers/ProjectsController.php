<?php

class ProjectsController extends Controller {

    public function init() {
        parent::init();
        //Yii::import('ext.PHPExcel.YPHPExcel');
        //Yii::import('application.modules.gerenciar.models.*');
        //Yii::import('ext.zip.Zip');
        //Yii::import('ext.helpers.EDownloadHelper');
        // Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/plugins/maskmoney/jquery.maskmoney.js", CClientScript::POS_BEGIN);
        //  Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/importacoes.js", CClientScript::POS_BEGIN);
        //  Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/plugins/jquery-form/jquery.form.js", CClientScript::POS_END);
        //  Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/plugins/mask/jquery.mask.js", CClientScript::POS_END);
    }

    //public $layout = '//layouts/main';

    public function actionIndex() {
        $model = new Project();
        $model->unsetAttributes();

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionNew() {
        $model = new Project();
        $model->unsetAttributes();

        if (isset($_POST['Project'])) {

//            echo "<pre>";
//            print_r($_POST['Project']);
//            exit;
            $model->attributes = $_POST['Project'];
            $model->proj_stat_id = 1; // started
            $model->proj_user_id = 1;
//            echo "<pre>";
//            print_r($model->attributes);
//            exit;


            if ($model->save()) {
                Yii::app()->user->setFlash('success', "Registration created!");
                //$this->redirect(array('visualizar', 'id' => $model->cai_id));
                $this->redirect(array('index', array()));
            } else {
                Yii::app()->user->setFlash('error', "Failed to create registration!");
            }
        }

        $this->render('index', array(
        ));
    }

}

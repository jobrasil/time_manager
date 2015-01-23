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

        $listStatus = CHtml::listData(Status::model()->findAll(), 'stat_id', 'stat_description');

        if (isset($_POST['Project'])) {
            
            print_r($_POST['Project']);
            exit;

            $model->attributes = $_POST['Project'];

            if ($model->save()) {
                Yii::app()->user->setFlash('success', "Registro criado com sucesso!");
                $this->redirect(array('visualizar', 'id' => $model->cai_id));
            } else {
                Yii::app()->user->setFlash('error', "Falha ao criar registro!");
            }
        }

        $this->render('index', array(
            'listStatus' => $listStatus,
        ));
    }

}

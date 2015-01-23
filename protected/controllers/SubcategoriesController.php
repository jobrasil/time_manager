<?php

class SubcategoriesController extends Controller {

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
    
        
        $this->render('index', array(
        ));
    }

}

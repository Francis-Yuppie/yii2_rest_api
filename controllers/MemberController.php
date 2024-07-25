<?php

namespace app\controllers;
use app\models\Member;

class MemberController extends \yii\rest\ActiveController
{

	public $modelClass = 'app\models\Member';
	
    public function actionIndex()
    {
        return $this->render('index');
    }

}

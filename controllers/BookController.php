<?php

namespace app\controllers;

use app\models\Book;

class BookController extends \yii\rest\ActiveController
{
	public $modelClass = 'app\models\Book';

    public function actionIndex()
    {
        return $this->render('index');
    }

}

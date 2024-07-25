<?php

namespace app\controllers;

use Yii;
use app\models\Loan;
use app\models\Book;
use app\models\Member;



class LoanController extends \yii\web\Controller
{
	public $enableCsrfValidation = false;

    public function actionIndex()
    {
    	Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    	$loan = Loan::find()->all();
    	return [
    		'data' => $loan
    	];
        // return $this->render('index');
    }

    private function errorResponse($message)
    {
    	Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	Yii::$app->response->statusCode = 400;

    	return [
    		'error' => $message
    	];
    }

    public function actionBorrow()
    {
    	Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	$request = Yii::$app->request;

    	$bookId = $request->post('book_id');
    	$borrowerId = $request->post('member_id');

    	if(empty($bookId) || empty($borrowerId)){
    		return [
    			'error' => 'Book id and member id is required'
    		];
    	}

    	$book = Book::findOne($bookId);
    	 
    	if(is_null($book)) {
    		return $this->errorResponse('Could not find book with this' . $bookId . 'ID');
    	}
    	if(!$book->is_available_for_loan) {
    		return $this->errorResponse('this book is not available, its already borrowed');
    	}

    	if(is_null(Member::findOne($borrowerId))) {
    		return $this->errorResponse('could not find member with the provided ID');
    	}

    	$loan = new Loan();
    	$returnDate = strtotime('+ 1 month');
    	$loan->attributes = [
    		'book_id' => $bookId,
    		'borrower_id' => $borrowerId,
    		'borrowed_on' => date('Y-m-d H:i:s'),
    		'to_be_returned_on' => date('Y-m-d H:i:s', $returnDate)
    	];

    	$book->markAsBorrowed();
    	$loan->save();

    	return [
    		'status' => true,
    		'message' => 'you have succesfully borrowed the book',
    		'data' => $loan
    	];


    }

}

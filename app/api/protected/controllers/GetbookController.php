<?php

class GetbookController extends Controller {

    public function actionIndex() {

        $request = explode("?", $_SERVER['REQUEST_URI']);
        $bookid_request = $request[1];
        $bookid = explode("=", $_SERVER['REQUEST_URI'])[1];
        $model = Order::model()->findByPk($bookid);
        if ($model->status == 1) {
            $bookurl = Yii::app()->basePath . "/images/pdf/My_Account.pdf";
            $model->status = 2;
            $model->save(false);
//            $file = 'pdf/My_Account.pdf';
            $filename = 'filename.pdf';
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($bookurl);
        }
    }

    public function actionRead() {
        
    }

    public function actionCreate() {
        
    }

    public function actionUpdate() {
        
    }

    public function actionDelete() {
        
    }

}

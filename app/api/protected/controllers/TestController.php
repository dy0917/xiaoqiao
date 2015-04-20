<?php

class TestController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        error_log("asdfasdfasdfa");
        echo "index";
    }

    public function actionRead() {
        echo "readddddd";
    }

    public function actionCreate() {
        echo "this is create";
    }

    public function actionWriteImage() {
        $temp_request = $this->getClientPost();
        $request = $temp_request;
        $imageSrc = $this->getInputData($request['type'], $request['src']);
        $foldername = realpath(Yii::app()->basePath . '/../images');

        if (!file_exists($foldername)) {
            mkdir($foldername, 0777);
        }
        $extention = $this->getInputType($request['type']);
        file_put_contents($foldername . DIRECTORY_SEPARATOR . $request['imagename'] . $extention, $imageSrc);
        $ImageUrl = "http://" . $_SERVER['SERVER_NAME'] . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . $request['imagename'] . $extention;

        echo $ImageUrl;
    }

    private function getInputData($inputDataType, $inputData) {
        $tempInput = "";
        if ($inputDataType == "image/jpeg") {
            $tempInput = str_replace('data:image/jpeg;base64,', '', $inputData);
        } elseif ($inputDataType == "application/pdf") {
            $tempInput = str_replace('data:application/pdf;base64,', '', $inputData);
        } elseif ($inputDataType == "image/png") {
            $tempInput = str_replace('data:image/png;base64,', '', $inputData);
        } elseif ($inputDataType == "image/gif") {
            $tempInput = str_replace('data:image/gif;base64,', '', $inputData);
        }
        $data = base64_decode($tempInput);
        return $data;
    }

    private function getInputType($inputDataType) {
        $tempInput = "";
        if ($inputDataType == "image/jpeg") {
            $tempInput = ".jpg";
        } elseif ($inputDataType == "application/pdf") {
            $tempInput = ".pdf";
        } elseif ($inputDataType == "image/png") {
            $tempInput = ".png";
        } elseif ($inputDataType == "image/gif") {
            $tempInput = ".gif";
        }
        return $tempInput;
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        
    }

}

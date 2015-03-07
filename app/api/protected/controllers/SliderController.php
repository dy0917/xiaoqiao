<?php

class SliderController extends Controller {

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


        $models = Yii::app()->db->createCommand()
                ->select('*')
                ->from('slider')
                ->queryAll();
        $tempArray = array();
        foreach ($models as $model) {
            array_push($tempArray, $model);
        }


        if ($tempArray) {
            $json = json_encode($tempArray);
            echo $json;
        }
    }

    public function actionRead() {
        echo "readddddd";
    }

    public function actionCreate() {

        $request = $this->getClientPost();
        $model = new Slider;
        $model->setAttributes($request);
        $model->createtime = new CDbExpression(' UTC_TIMESTAMP()');
        $model->lastupdatetime = new CDbExpression('UTC_TIMESTAMP()');

        if ($model->validate()) {
            $model->save(false);
            $model->createtime = date("Y-m-d H:i:s");
            $arrjson = $model->attributes;
            $json = json_encode($arrjson);
            echo $json;
        } else {

            $this->sendResponse(500);
        }
    }

    public function actionUpdate() {
        $request = $this->getClientPost();
        $model = Slider::model()->findByPk($request["sliderId"]);

        $model->setAttributes($request);

        $model->lastupdatetime = new CDbExpression('UTC_TIMESTAMP()');
        if ($model->validate()) {
            $model->save(false);
            echo "updateSeccessful";
        } else {
            $this->sendResponse(500);
        }
    }

    public function actionDelete() {
        $request = $this->getClientPost();
        $model = Slider::model()->findByPk($request["sliderId"]);
        if ($model->validate()) {
            $model->delete();
            echo "updateSeccessful";
        } else {

            $this->sendResponse(500);
        }
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

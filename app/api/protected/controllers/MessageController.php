<?php

class MessageController extends Controller {

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
                ->from('message')
                ->queryAll();
        $tempArray = array();
        foreach ($models as $model) {
            array_push($tempArray, $model);
        }
        $json = json_encode($tempArray);

        $this->sendResponse(200, $json);
    }

    public function actionRead() {
        echo "readddddd";
    }

    public function actionCreate() {

        $request = $this->getClientPost();
        $model = new Message;
        $model->setAttributes($request);
        $model->createtime = new CDbExpression(' UTC_TIMESTAMP()');

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

    public function actionGetmessagebyid() {

        $request = $this->getClientPost();


        $models = Yii::app()->db->createCommand()
                ->select('*')
                ->from('message')
                ->where('Blogid=:id', array(':id' => $request['id']))
                ->queryAll();
        $tempArray = array();
        foreach ($models as $model) {
            array_push($tempArray, $model);
        }
        $json = json_encode($tempArray);

        $this->sendResponse(200, $json);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        
    }

}

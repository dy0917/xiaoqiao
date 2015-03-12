<?php

class SubscribeController extends Controller {

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
        $request = $this->getClientPost();
        $model = new SubscribeEmail;
        $model->setAttributes($request);
        $model->enable = 1;
        $model->createtime = new CDbExpression(' UTC_TIMESTAMP()');
        $model->lastupdatetime = new CDbExpression('UTC_TIMESTAMP()');

        if ($model->validate()) {
            $model->save(false);
            $model->createtime = date("Y-m-d H:i:s");
            $arrjson = $model->attributes;
            $arrjson['BlogStatus'] = $request['BlogStatus'];
            $json = json_encode($arrjson);
            echo $json;
        } else {

            $this->sendResponse(500);
        }
    }

    public function actionUnsubscribe() {

        $request = $this->getClientPost();
        $model = SubscribeEmail::model()->findByAttributes(array(
            'email' => $request['email']
        ));

        if ($model) {
            $model->enable = 0;
            $model->save(false);
            $this->sendResponse(200, json_encode($model));
        } else {
            $this->sendResponse(200, "email not found");
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        
    }

}

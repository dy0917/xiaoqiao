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

        $models = Yii::app()->db->createCommand()
                ->select('*')
                ->from('subscribeEmail')
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


        $model = SubscribeEmail::model()->findByAttributes(array(
            'email' => $request['email']
        ));


        if ($model) {
            $model->enable = 1;
            $model->save(false);
            $this->sendResponse(200, "registered");
            $message = " wrote the following:" . "\n\n" . '<a href="www.xiaoqiao.com/#/unsubcript">unsubscribe</a>';
            $this->sendEmail('xiaoqiaonz@gmail.com', $request['email'], "Subscribe", $message);
        } else {
            $model = new SubscribeEmail;
            $model->setAttributes($request);
            $model->enable = 1;
            $model->createtime = new CDbExpression(' UTC_TIMESTAMP()');
            $model->lastupdatetime = new CDbExpression('UTC_TIMESTAMP()');
            if ($model->validate()) {
                $message = " wrote the following:" . "\n\n" . '<a href="www.xiaoqiao.com/#/unsubcript">unsubscribe</a>';
                $this->sendEmail('xiaoqiaonz@gmail.com', $request['email'], "Subscribe", $message);
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
    }

    public function actionUnsubscribe() {
        $request = $this->getClientPost();
        $model = SubscribeEmail::model()->findByAttributes(array(
            'email' => $request['email']
        ));

        if ($model) {

            $message = "Thank you for following us";
            $this->sendEmail('xiaoqiaonz@gmail.com', $request['email'], "Unsubscribe", $message);
            $model->enable = 0;
            $model->save(false);
            $this->sendResponse(200, json_encode($model));
        } else {
            $this->sendResponse(200, "email not found");
        }
    }

}

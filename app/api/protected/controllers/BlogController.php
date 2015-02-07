<?php

class BlogController extends Controller {

    const JSON_RESPONSE_ROOT_SINGLE = 'blog';
    const JSON_RESPONSE_ROOT_PLURAL = 'blogs';

    public function actionIndex() {
        $models = Blog::model()->findAll();
//        var_dump($models);
//        $json = json_encode($models->attributes);
        $json = $this->arrtoJson(null, $models);
        $this->sendResponse(200, $json);
    }

    public function actionRead() {
        $model = Blog::model()->findByPk(8);
        $json = $this->objtoJson(self::JSON_RESPONSE_ROOT_SINGLE, $model);
        $this->sendResponse(200, $json);
    }

    public function actionCreate() {

        $request = $this->getClientPost();
        $model = new Blog;
        $model->setAttributes($request);
        $model->CreatebyUser = 3;

        $model->createTime = new CDbExpression(' UTC_TIMESTAMP()');
        $model->LastUpdateTime = new CDbExpression('UTC_TIMESTAMP()');

        if ($model->validate()) {
            $model->save(false);
            $this->sendResponse(200, "saveSeccessful");
        } else {

            $this->sendResponse(500);
        }
    }

    public function actionUpdate() {
        $request = $this->getClientPost();
        $model = Blog::model()->findByPk($request["Blogid"]);
//        var_dump($request);
        $model->setAttributes($request);
        $model->LastUpdateTime = new CDbExpression('UTC_TIMESTAMP()');
        if ($model->validate()) {
            $model->save(false);
            $this->sendResponse(200, "updateSeccessful");
        } else {

            $this->sendResponse(500);
        }
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}

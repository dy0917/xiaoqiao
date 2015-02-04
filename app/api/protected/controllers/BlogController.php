<?php

class BlogController extends Controller {
    const JSON_RESPONSE_ROOT_SINGLE = 'blog';
    const JSON_RESPONSE_ROOT_PLURAL = 'blogs';
    public function actionIndex() {
        echo "index";
    }

    public function actionRead() {
        $model = Blog::model()->findByPk(3);
        $json = $this->objtoJson(self::JSON_RESPONSE_ROOT_SINGLE, $model);

        $this->sendResponse(200, $json);
    }

    public function actionCreate() {

        $request = $this->getClientPost();
        $model = new Blog;
        $model->setAttributes($request);
        $model->CreatebyUser = 3;
//         $date = new DateTime();

        if ($model->validate()) {
            $model->save(false);
            $this->sendResponse(204);
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

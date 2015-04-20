<?php

class BlogupdateController extends Controller {



    public function actionBlogupdate() {
        $request = $this->getClientPost();
        $model = Blog::model()->findByPk($request["Blogid"]);
        $model->setAttributes($request);
        $model->LastUpdateTime = new CDbExpression('UTC_TIMESTAMP()');
        if ($model->validate()) {
            $model->save(false);
            $this->sendResponse(200, "updateSeccessful");
        } else {

            $this->sendResponse(500);
        }
    }

   
}

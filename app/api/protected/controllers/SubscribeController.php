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
            $message = " wrote the following:" . "\n\n" . '<a href="' . $_SERVER['HTTP_HOST'] . '"/#/unsubscript?email=' . $request['email'] . '">unsubscribe</a>';
//            $this->sendEmail('xiaoqiaonz@gmail.com', $request['email'], "Subscribe", $message);
            $this->setandsendemail("Subscribe: " . $request['email'], "Subscribe" . $message, $request['email']);
            $this->sendResponse(200, "registered");
        } else {
            $model = new SubscribeEmail;
            $model->setAttributes($request);
            $model->enable = 1;
            $model->createtime = new CDbExpression(' UTC_TIMESTAMP()');
            $model->lastupdatetime = new CDbExpression('UTC_TIMESTAMP()');
            if ($model->validate()) {
                $message = " wrote the following:" . "\n\n" . '<a href="' . $_SERVER['HTTP_HOST'] . '"/#/unsubscript?email=' . $request['email'] . '">unsubscribe</a>';
//                $this->sendEmail('xiaoqiaonz@gmail.com', $request['email'], "Subscribe", $message);
                $this->setandsendemail("Subscribe: " . $request['email'], "Subscribe" . $message, $request['email']);
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
            $this->sendResponse(200, "Email_Not_Found");
        }
    }

    public function setandsendemail($title, $content, $email) {



        $hosturl = "http://www.xiaoqiaonz.com/";
        $isgmail = false;
        if (strpos($email, 'gmail') !== false) {
            $isgmail = true;
        }
//        $foldername = realpath(Yii::app()->basePath . '/../images/email/');
        $logo = '/logo2.png';
        $shadowtopleft = "/shadow-top-left.png";
        $shadowtopcenter = "/shadow-top-center.png";
        $shadowtopright = "/shadow-top-right.png";
        $shadowlefttop = "/shadow-left-top.png";
        $header = "/header.jpg";
        $aboutJo = "/aboutJo.jpg";
        $jo_jb = "/jo_jb.png";
        $book = "/book.jpg";
        $qrcode = "/qr-code.jpg";
        $shadowrighttop = "/shadow-right-top.png";
        $shadowleftcenter = "/shadow-left-center.png";
        $shadowrightcenter = "/shadow-right-center.png";
        $shadowleftbottom = "/shadow-left-bottom.png";
        $shadowrightbottom = "/shadow-right-bottom.png";
        $shadowbottomcornerleft = "/shadow-bottom-corner-left.png";
        $shadowbottomleft = "/shadow-bottom-left.png";
        $shadowbottomcenter = "/shadow-bottom-center.png";
        $shadowbottomright = "/shadow-bottom-right.png";
        $shadowbottomcornerright = "/shadow-bottom-corner-right.png";


//' . $hosturl . 'shadow-bottom-right.png


        $body = '
        <!doctype html>
        <html>
        <head>
        <meta charset = "utf-8">
        <title></title>
        </head>
        <body style = "font-family:Gotham, \'Helvetica Neue\', Helvetica, Arial, sans-serif; background-color:#f3f3f3; margin:0; padding:0; color:#333333;">

        <table width = "100%" bgcolor = "#f3f3f3" cellpadding = "0" cellspacing = "0" border = "0">
        <tbody>
        <tr>
        <td style = "padding:40px 0;">
        <!--begin main block -->
        <table cellpadding = "0" cellspacing = "0" width = "608" border = "0" align = "center">
        <tbody>
        <tr>
        <td>
        <a href = "' . $hosturl . '" style = "display:block; width:407px; height:100px; margin:0 auto 30px;">
        <img src = "' . $this->getbase64imagestring($logo,$isgmail) . '" width = "186" alt = "Pixelbuddha" style = "display:block; border:0; margin:auto;">
        </a>
        <p style = "margin:0 0 36px; text-align:center; font-size:14px; line-height:20px; text-transform:uppercase; color:#626658;">
        身在异乡，买房投资置业 不是一件简单容易的事。不过我们的专业一定可以帮到您！
        </p>
        <!--begin wrapper -->
        <table cellpadding = "0" cellspacing = "0" border = "0" width = "100%">
        <tbody>
        <tr>
        <td width = "8" height = "4" colspan = "2" style = "background:url(' . $this->getbase64imagestring($shadowtopleft,$isgmail) . ') no-repeat 100% 100%;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td height = "4" style = "background:url(' . $this->getbase64imagestring($shadowtopcenter,$isgmail) . ') repeat-x 0 100%;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td width = "8" height = "4" colspan = "2" style = "background:url(' . $this->getbase64imagestring($shadowtopright,$isgmail) . ') no-repeat 0 100%;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        </tr>

        <tr>
        <td width = "4" height = "4" style = "background:url(' . $this->getbase64imagestring($shadowlefttop,$isgmail) . ') no-repeat 100% 0;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td colspan = "3" rowspan = "3" bgcolor = "#FFFFFF" style = "padding:0 0 30px;">
        <!--begin content -->
        <img src = "' . $this->getbase64imagestring($header,$isgmail) . '" width = "600" height = "400" alt = "summer‘s coming trimm your sheeps" style = "display:block; border:0; margin:0 0 44px; background:#eeeeee;">

        <!--=============== = 如果是发email的话=============== = -->

        <p style = "font-size:18px; line-height:22px; font-weight:bold; color:#333333; margin:0 30px 10px;">邮件标题</p>

        <p style = "margin:0 30px 35px; font-size:12px; line-height:18px; color:#333333;">' . $title . '</p>




        <p style = "margin:0; border-top:2px solid #e5e5e5; font-size:8px; line-height:5px; margin:0 30px 29px;">' . $content . '</p>




        <!--=============== = 如果是发email的话=============== = -->



        <p style = "margin:0 30px 33px;; text-align:center; text-transform:uppercase; font-size:24px; line-height:30px; font-weight:bold; color:#484a42;">
        专为华人购房投资的贷款服务
        </p>
        <!--begin articles -->
        <table cellpadding = "0" cellspacing = "0" border = "0" width = "100%">
        <tbody>
        <tr valign = "top">
        <td width = "30"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td>
        <a style = "display:block; margin:0 0 14px;" href = "http://pixelbuddha.net/"><img src = "' . $this->getbase64imagestring($aboutJo,$isgmail) . '" width = "255" height = "150" alt = "More" style = "display:block; margin:0; border:0; background:#eeeeee;"></a>
        <p style = "font-size:14px; line-height:22px; font-weight:bold; color:#333333; margin:0 0 5px;"><a href = "http://pixelbuddha.net/" style = "color:#F06421; text-decoration:none;">关于小乔</a></p>
        <p style = "margin:0 0 35px; font-size:12px; line-height:18px; color:#333333;">川妹子的13年，留学创业在新西兰 </p>
        </td>
        <td width = "30"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td>
        <a style = "display:block; margin:0 0 14px;" href = "http://pixelbuddha.net/"><img src = "' . $this->getbase64imagestring($jo_jb,$isgmail) . '" width = "255" height = "150" alt = "More" style = "display:block; margin:0; border:0; background:#eeeeee;"></a>
        <p style = "font-size:14px; line-height:22px; font-weight:bold; color:#333333; margin:0 0 5px;"><a href = "http://pixelbuddha.net/" style = "color:#F06421; text-decoration:none;">关于金松鼠</a></p>
        <p style = "margin:0 0 35px; font-size:12px; line-height:18px; color:#333333;">2007年经济危机开始，John Bolton认定这时正是买房人最需要一个站在他们立场并可以依靠的人。</p>
        </td>
        <td width = "30"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        </tr>
        <tr valign = "top">
        <td width = "30"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td colspan = "3">
        <a style = "display:block; margin:0 0 14px;" href = "http://pixelbuddha.net/"><img src = "' . $this->getbase64imagestring($book,$isgmail) . '" width = "540" height = "220" alt = "More" style = "display:block; margin:0; border:0; background:#eeeeee;"></a>
        <p style = "font-size:14px; line-height:22px; font-weight:bold; color:#333333; margin:0 0 5px;"><a href = "http://pixelbuddha.net/" style = "color:#F06421; text-decoration:none;">精算师小乔新西兰手册</a></p>
        <p style = "margin:0 0 35px; font-size:12px; line-height:18px; color:#333333;">关于这本书</p>
        </td>
        <td width = "30"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        </tr>
        </tbody>
        </table>
        <!--/end articles -->
        <p style = "margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 29px;">&nbsp;
        </p>
        <table cellpadding = "0" cellspacing = "0" border = "0" width = "100%">
        <tbody>
        <tr valign = "top">
        <td width = "30"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td>
        <p style = "margin:0 0 4px; font-weight:bold; color:#333333; font-size:14px; line-height:22px;">小乔工作室</p>
        <p style = "margin:0; color:#333333; font-size:11px; line-height:18px;">
        38 College Hill, Freemans Bay, Auckland, New Zealand 1010.<br>
        电话：+64 21 106 1961（可加微信）<br>
        网站: <a href = "http://pixelbuddha.net/" style = "color:#F06421; text-decoration:none; font-weight:bold;">www.xiaoqiaonz.com</a>
        </p>
        </td>
        <td width = "30"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td width = "120">$qrcode
        <img src = "' . $this->getbase64imagestring($qrcode,$isgmail) . '" width = "100" height = "100" alt = "More" style = "display:block; margin:0; border:0; background:#eeeeee;">

        </td>
        <td width = "30"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        </tr>
        </tbody>
        </table>
        <!--end content -->
        </td>
        <td width = "4" height = "4" style = "background:url(' . $this->getbase64imagestring($shadowrighttop,$isgmail) . ') no-repeat 0 0;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        </tr>


        <tr>
        <td width = "4" style = "background:url(' . $this->getbase64imagestring($shadowleftcenter,$isgmail) . ') repeat-y 100% 0;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td width = "4" style = "background:url(' . $this->getbase64imagestring($shadowrightcenter,$isgmail) . ') repeat-y 0 0;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        </tr>

        <tr>
        <td width = "4" height = "4" style = "background:url(' . $this->getbase64imagestring($shadowleftbottom,$isgmail) . ') repeat-y 100% 100%;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td width = "4" height = "4" style = "background:url(' . $this->getbase64imagestring($shadowrightbottom,$isgmail) . ') repeat-y 0 100%;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        </tr>

        <tr>
        <td width = "4" height = "4" style = "background:url(' . $this->getbase64imagestring($shadowbottomcornerleft,$isgmail) . ') no-repeat 100% 0;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td width = "4" height = "4" style = "background:url(' . $this->getbase64imagestring($shadowbottomleft,$isgmail) . ') no-repeat 100% 0;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td height = "4" style = "background:url(' . $this->getbase64imagestring($shadowbottomcenter,$isgmail) . ') repeat-x 0 0;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td width = "4" height = "4" style = "background:url(' . $this->getbase64imagestring($shadowbottomright,$isgmail) . ') no-repeat 0 0;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        <td width = "4" height = "4" style = "background:url(' . $this->getbase64imagestring($shadowbottomcornerright,$isgmail) . ') no-repeat 0 0;"><p style = "margin:0; font-size:1px; line-height:1px;">&nbsp;
        </p></td>
        </tr>
        </tbody>
        </table>
        <!--end wrapper-->
        <p style = "margin:0; padding:34px 0 0; text-align:center; font-size:11px; line-height:13px; color:#333333;">
        不想再收到此邮件？您可以点<a href = "' . $hosturl . '#/unsubscript" style = "color:#F06421; text-decoration:underline;">这里</a>取消关注。
        </p>
        <p style = "margin:0; padding:34px 0 0; text-align:center; font-size:11px; line-height:13px; color:#333333;">如果该链接不工作，你可以复制以下链接</p>
        <p style = "margin:0; padding:34px 0 0; text-align:center; font-size:11px; line-height:13px; ">www.xiaoqiaonz.com//#/unsubscript</p>
        </td>
        </tr>
        </tbody>
        </table>
        <!--end main block -->
        </td>
        </tr>
        </tbody>
        </table>
        </body>
        </html>
        ';

        $to = "xiaoqiaonz@gmail.com"; // this is your Email address
        $from = $email; // this is the sender's Email address

        $this->sendEmail($to, $from, $title, $body);
        $this->sendEmail($from, $to, $title, $body);
 

    }

    function getbase64imagestring($path, $isgmail) {

        if (!$isgmail) {
            $foldername = realpath(Yii::app()->basePath . '/../images/email/');

            $type = pathinfo($foldername . $path, PATHINFO_EXTENSION);
            $data = file_get_contents($foldername . $path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            return $base64;
        } else {
            $hosturl = $_SERVER['HTTP_HOST'] . '/images/email';
            return $hosturl . $path;
        }
    }

}

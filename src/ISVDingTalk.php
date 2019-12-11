<?php


namespace GuoGq\DingApiIsvYii2;


use GuoGq\DingApiIsvYii2\api\Auth;
use GuoGq\DingApiIsvYii2\api\ISVClass;
use GuoGq\DingApiIsvYii2\api\Message;
use GuoGq\DingApiIsvYii2\api\User;

/**
 * 钉钉ISV调用类
 * Class ISVDingTalk
 * @package GuoGq\DingApiIsvYii2
 */
class ISVDingTalk
{
    /**
     * 获取个人授权信息
     * @return api\个人授权信息
     */
    public function getPerson()
    {
        $code = $_GET['code'];
        $corpId = $_GET['corpid'];
        $corpInfo = ISVClass::getCorpInfo($corpId);
        $accessToken = $corpInfo['corpAccessToken'];
        $res = Auth::getPerson($accessToken, $code);
        return $res;
    }

    /**
     * 发送消息
     */
    public function sendMsg()
    {
        $event = $_POST["event"];
        switch ($event) {
            case '':
                return json_encode(array("error_code" => "4000"));
                break;
            case 'send_to_conversation':
                $sender = $_POST['sender'];
                $cid = $_POST['cid'];
                $content = $_POST['content'];
                $corpId = $_POST['corpId'];
                $corpInfo = ISVClass::getCorpInfo($corpId);
                $accessToken = $corpInfo['corpAccessToken'];
                $option = array(
                    "sender" => $sender,
                    "cid" => $cid,
                    "msgtype" => "text",
                    "text" => array("content" => $content)
                );
                $response = Message::sendToConversation($accessToken, $option);
                return json_encode($response);
                break;

            case 'get_userinfo':
                $corpId = $_POST['corpId'];
                $corpInfo = ISVClass::getCorpInfo($corpId);
                $accessToken = $corpInfo['corpAccessToken'];
                $code = $_POST["code"];
                $userInfo = User::getUserInfo($accessToken, $code);
                return json_encode($userInfo);
                break;
        }
    }

    /**
     * 回调接收消息
     */
    public function receive()
    {

    }

    /**
     * 获取企业凭证
     * @param $corpId
     */
    public function getCorpToken()
    {
        $corpId = $_GET['corpid'];
    }
}
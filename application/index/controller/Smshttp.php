<?php

namespace app\index\controller;


class Smshttp
{
    public $smsHost;
    public $sendSMSUrl;
    public $getCreditUrl;
    public $batchID;
    public $credit;
    public $processMsg;

    public function __construct(){
        $this->smsHost = "api.every8d.com";
        $this->sendSMSUrl = "http://".$this->smsHost."/API21/HTTP/sendSMS.ashx";
        $this->getCreditUrl = "http://".$this->smsHost."/API21/HTTP/getCredit.ashx";
        $this->batchID = "";
        $this->credit = 0.0;
        $this->processMsg = "";
    }

    /// <summary>
    /// 取得帳号余额
    /// </summary>
    /// <param name="userID">帳号</param>
    /// <param name="password">密码</param>
    /// <returns>true:取得成功；false:取得失败</returns>
    public function getCredit($userID, $password){
        $success = false;
        $postDataString = "UID=" . $userID . "&PWD=" . $password;
        $resultString = $this->httpPost($this->getCreditUrl, $postDataString);
        if(substr($resultString,0,1) == "-"){
            $this->processMsg = $resultString;
        } else {
            $success = true;
            $this->credit = $resultString;
        }
        return $success;
    }

    /// <summary>
    /// 傳送简讯
    /// </summary>
    /// <param name="userID">帳号</param>
    /// <param name="password">密码</param>
    /// <param name="subject">简讯主旨，主旨不會隨著简讯內容发送出去。用以註記本次发送之用途。可傳入空字串。</param>
    /// <param name="content">简讯发送內容</param>
    /// <param name="mobile">接收人之手机号码。格式为: +886912345678或09123456789。多筆接收人時，请以半形逗點隔开( , )，如0912345678,0922333444。</param>
    /// <param name="sendTime">简讯預定发送时间。-立即发送：请傳入空字串。-預約发送：请傳入預計发送时间，若傳送时间小於系统接單时间，將不予傳送。格式为YYYYMMDDhhmnss；例如:預約2009/01/31 15:30:00发送，則傳入20090131153000。若傳遞时间已逾現在之时间，將立即发送。</param>
    /// <returns>true:傳送成功；false:傳送失败</returns>
    public function sendSMS($userID, $password, $subject, $content, $mobile, $sendTime){
        $success = false;
        $postDataString = "UID=" . $userID;
        $postDataString .= "&PWD=" . $password;
        $postDataString .= "&SB=" . $subject;
        $postDataString .= "&MSG=" . $content;
        $postDataString .= "&DEST=" . $mobile;
        $postDataString .= "&ST=" . $sendTime;
        $resultString = $this->httpPost($this->sendSMSUrl, $postDataString);
        if(substr($resultString,0,1) == "-"){
            $this->processMsg = $resultString;
        } else {
            $success = true;
            $strArray = explode(",", $resultString);
            $this->credit = $strArray[0];
            $this->batchID = $strArray[4];
        }
        return $success;
    }

    public function httpPost($url, $postData){
        $result = "";
        $length = strlen($postData);
        $fp = fsockopen($this->smsHost, 80, $errno, $errstr);
        $header = "POST " . $url . " HTTP/1.0\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded; charset=utf-8\r\n";
        $header .= "Content-Length: " . $length . "\r\n\r\n";
        $header .= $postData . "\r\n";

        fputs($fp, $header, strlen($header));
        $res='';
        while (!feof($fp)) {
            $res .= fgets($fp, 1024);
        }
        fclose($fp);
        $strArray = explode("\r\n\r\n", $res);
        $result = $strArray[1];
        return $result;
    }

}

?>
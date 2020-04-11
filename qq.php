<?php

$key = $_GET["key"];
$n = $_GET["n"];
//判断是否GET传入
if($key==""|$n=="")
{
    $key = $_POST["key"];
    $n = $_POST["n"];
   //判断是否POST传入
    if($key==""|$n=="")
    {
      echo "失败请检查参数";
    }

}
//封装好的POST提交json的函数，不要动
function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
 
    return array($httpCode, $response);
}
//执行函数提交数据，不返回数据
//key的值就是你记录的key而n是QQ机器人要发送的消息
$url = "https://app.qun.qq.com/cgi-bin/api/hookrobot_send?key="ebfc00b9b8bb71cfceb6d44a8f9f7cbb7f2a6c2e".$key;
$jsonStr = "{\"content\": [ {\"type\":0,\"data\":\"".$n."\"}]}";
$daatfh = http_post_json($url, $jsonStr);
?>

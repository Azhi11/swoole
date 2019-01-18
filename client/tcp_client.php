<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/11
 * Time: 11:46
 */
//连接 swoole 服务
$client = new swoole_client(SWOOLE_SOCK_TCP);
if(!$client->connect('127.0.0.1', 9501)) {
    echo '连接失败';
    exit;
}
//php cli常量 STDOUT 输出    STDIN  输入
fwrite(STDOUT, "请输入消息：");
$msg = trim(fgets(STDIN));

//发送消息给 tcp server 服务器
$client->send($msg);

//接收消息
$result =  $client->recv();
echo $result;
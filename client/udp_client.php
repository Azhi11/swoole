<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/14
 * Time: 18:00
 */

/**
 * UDP服务器与TCP服务器不同，UDP没有连接的概念。启动Server后，客户端无需Connect，
 * 直接可以向Server监听的9502端口发送数据包。对应的事件为onPacket
 */
$client = new swoole_client(SWOOLE_SOCK_UDP);

fwrite(STDOUT, "请输入消息：");
$msg = trim(fgets(STDIN));

$client->sendto('127.0.0.1', 9502, $msg);

$result =  $client->recv();
echo $result;

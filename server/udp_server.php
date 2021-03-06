<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/7
 * Time: 16:25
 */
//创建Server对象，监听 127.0.0.1:9502端口，类型为SWOOLE_SOCK_UDP
$serv = new swoole_server("127.0.0.1", 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

$serv->set([
    'worker_num' => 3,  //worker进程数  cpu核数的 1-4
    'max_request' => 10000,
]);

//监听数据接收事件
$serv->on('Packet', function ($serv, $data, $clientInfo) {
    $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
    var_dump($clientInfo);
});

//启动服务器
$serv->start();
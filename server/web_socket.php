<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/7
 * Time: 12:14
 */
//创建websocket服务器对象，监听0.0.0.0:9502端口
$server = new swoole_websocket_server("0.0.0.0", 9801);

//监听WebSocket连接打开事件
$server->on('open', function ($server, $request) {
//    var_dump($request->fd, $request->get, $request->server);
    echo $request->fd;
    $server->push($request->fd, "hello, welcome\n");
});

//监听WebSocket消息事件
$server->on('message', function ($server, $frame) {
    echo "Message: {$frame->data}\n";
//    $server->push($frame->fd, "server: {$frame->data}");
});

//监听WebSocket连接关闭事件
$server->on('close', function ($server, $fd) {
    echo "client-{$fd} is closed\n";
});

$server->on('request', function ($request, $response) {
    global $server;  //调用方法体外部server

    //$server->connections 遍历所有websocket连接用户的fd，给所有用户推送
    $fds = '';
    foreach ($server->connections as $fd) {
        $server->push($fd, $request->get['message'].$fd);
        $fds .= '&'.$fd;
    }
    $response->end($fds.' ********** '. json_encode($request->get));
});

$server->start();
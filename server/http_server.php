<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/7
 * Time: 17:32
 */
$http = new swoole_http_server("0.0.0.0", 9501);

$http->set(
    [
        'enable_static_handler' => true,
        'document_root' => '/mnt/hgfs/tmypro/swoole/html',
    ]
);

$http->on('request', function ($request, $response) {
//    var_dump($request->get);
    $response->header("Content-Type", "text/html; charset=utf-8");
    $response->cookie('wa', 'dsdsds', time()+20);
    $response->end(' '. json_encode($request->get));
//    $response->end("<h1>Hello Swoole11. #".rand(1000, 9999)."</h1>");
});

$http->start();
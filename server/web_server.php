<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/7
 * Time: 17:32
 */
$http = new swoole_http_server("0.0.0.0", 9501);

$http->on('request', function ($request, $response) {
    var_dump($request->get);
    $response->header("Content-Type", "text/html; charset=utf-8");
    $response->end("<h1>Hello Swoole11. #".rand(1000, 9999)."</h1>");
});

$http->start();
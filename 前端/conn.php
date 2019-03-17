<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/2/27
 * Time: 9:03
 */



 //此文件用于连接数据库

$db = new mysqli('localhost', 'root', '', 'vote_system' );
mysqli_set_charset($db,"utf8");
if (!$db) {
    die("连接数据库失败:".mysqli_connect_error());
}
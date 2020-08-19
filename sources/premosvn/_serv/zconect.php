<?php
session_start();

	require_once ('MySQL.php');
	$db = new MysqliDb (Array (
                'host' => '127.0.0.1',
                'username' => 'root', 
//                'password' => 'root',
                'password' => '',
                'db'=> 'premo',
                'port' => 3306,
                'prefix' => '',
                'charset' => 'utf8'));
        $defurl='http://127.0.0.1/premo';
        $defpath='/var/www/premo';
        $sysenv='test';

?>

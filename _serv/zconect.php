<?php

//session_destroy (); //DMI2020
session_start();

	require_once ('MySQL.php');
	$db = new MysqliDb (Array (
                'host' => '127.0.0.1',
                'username' => 'root', 
//                'password' => 'root',
                'password' => 'Aslk1209',
                'db'=> 'premo',
                'port' => 3306,
                'prefix' => '',
                'charset' => 'utf8'));
        $defurl='http://localhost:8080/premo';
        // $defpath='/var/www/premo';
        $defpath='/Users/danielmiranda/www/premo';
        $sysenv='test';

?>

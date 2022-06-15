<?php
session_start();
//add autoload note:do check your file paths in autoload.php
require "./vendor/autoload.php";
require "./vendor/TwitterUtil/autoload.php";
use TwitterUtil\TwitterUtil;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

define('CONSUMER_KEY' , $_ENV['CONSUMER_KEY']);
define('CONSUMER_SECRET' , $_ENV['CONSUMER_SECRET']);
$twitterUtil = new TwitterUtil(CONSUMER_KEY ,CONSUMER_SECRET , "http://ubuntu:81/");
$twitterUtil->Tweet();

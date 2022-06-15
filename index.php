<?php
session_start();
//add autoload note:do check your file paths in autoload.php
require "./vendor/autoload.php";
require "./vendor/TwitterUtil/autoload.php";
use TwitterUtil\TwitterOAuthorize;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

define('CONSUMER_KEY' , $_ENV['CONSUMER_KEY']);
define('CONSUMER_SECRET' , $_ENV['CONSUMER_SECRET']);
$twitterUtil = new TwitterOAuthorize(CONSUMER_KEY ,CONSUMER_SECRET , "http://ubuntu:81/");



//this code will run when returned from twiter after authentication
if (isset($_SESSION['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {
    $twitterUtil->StoreToken();

} else {

    $twitterUtil->Authorize();

}



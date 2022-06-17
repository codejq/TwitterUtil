<?php
session_start();
//add autoload note:do check your file paths in autoload.php
require "./vendor/autoload.php";
require "./vendor/TwitterUtil/autoload.php";

use TwitterUtil\TwitterOAuthorize;
use TwitterUtil\TwitterUtil;

/*
$tt = new \TwitterUtil\SocialMediaEntity\TwitterEntry("This is tweet number " . rand(1000, 100000), "www.303030.info", "/var/image/1.jpg");
for ($i = 0; $i < 10; $i++) {
    if (!file_exists('./tweets')) {
        mkdir('./tweets');
    }
    echo file_put_contents("./tweets/." . md5(rand(1000, 100000)).'.tweet', serialize($tt));echo $i;
}
*/
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

define('CONSUMER_KEY', $_ENV['CONSUMER_KEY']);
define('CONSUMER_SECRET', $_ENV['CONSUMER_SECRET']);
$listProvider = new \TwitterUtil\TweetListFileBasedProvider('/var/www/twitter/tweets/', 'tweet');
$accountProvider = new \TwitterUtil\AccountListFileBasedProvider('/var/www/twitter/','twitter');
(new TwitterUtil(CONSUMER_KEY, CONSUMER_SECRET))->ProcessTweets($listProvider ,$accountProvider );
exit();
$twitterUtil = new TwitterOAuthorize(CONSUMER_KEY, CONSUMER_SECRET, "http://ubuntu:81/");


//this code will run when returned from twiter after authentication
if (isset($_SESSION['oauth_token']) && $_SESSION['token'] !== $_REQUEST['oauth_token']) {
    $twitterUtil->StoreToken('./');
} else {
    $twitterUtil->Authorize();
}


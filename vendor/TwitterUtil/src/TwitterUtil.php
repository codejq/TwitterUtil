<?php

namespace TwitterUtil;

use TwitterUtil\SocialMediaEntity\TwitterEntry;

class TwitterUtil extends \Abraham\TwitterOAuth\TwitterOAuth
{
    /** @var string */
    public $key;
    /** @var string */
    public $secret;
    /** @var string|null */
    public $callbackUrl;


    /**
     * @param string|null $key
     * @param string|null $secret
     * @param string|null $callbackUrl
     */

    public function __CONSTRUCT(string  $consumerKey = null,
                                string  $consumerSecret = null,
                                ?string $callbackUrl = null)
    {
        $this->key = $consumerKey;
        $this->secret = $consumerSecret;
        $this->callbackUrl = $callbackUrl;
        $this->init($consumerKey, $consumerSecret);
    }

    public function init($consumerKey, $consumerSecret, ?string $oauthToken = null, ?string $oauthTokenSecret = null,) {
        parent::__construct($consumerKey, $consumerSecret, $oauthToken, $oauthTokenSecret);

    }


    /**
     * @return void
     * @throws \Abraham\TwitterOAuth\TwitterOAuthException
     */
    public function ProcessTweets(ITweetListProvider $tweetList, IAccountListProvider $accountList): void
    {
        $tweets = $tweetList->TweetList();
        $accounts = $accountList->AccountList();
        foreach ($tweets as $fileName => $tweet) {
            $result=false;
            foreach ($accounts as $access_token) {
                $this->init($this->key, $this->secret,
                    $access_token['oauth_token'], $access_token['oauth_token_secret']);
                if(!$result) {
                    $result = $this->Tweet($access_token, $tweet->getText() . $tweet->getLink());
                }
            }
            if($result){
                $tweetList->RemoveFromQuee($fileName);
            }

        }

    }


    /**
     * @return bool
     * @throws \Abraham\TwitterOAuth\TwitterOAuthException
     */
    private function Tweet(array $access_token, string $tweetText): bool
    {
        $this->init($this->key, $this->secret,
            $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $this->setApiVersion('2');
        $response = $this->post('tweets', ['text' => $tweetText . 'Hello2525' . rand(10000, 100000)], true);
        return is_numeric($response->data->id??'');
    }


}


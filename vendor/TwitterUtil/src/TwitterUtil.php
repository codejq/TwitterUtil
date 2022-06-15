<?php

namespace TwitterUtil;

class TwitterUtil extends \Abraham\TwitterOAuth\TwitterOAuth
{
    /** @var string  */
    public $key;
    /** @var string  */
    public $secret;
    /** @var string|null  */
    public $callbackUrl;


    /**
     * @param string|null $key
     * @param string|null $secret
     * @param string|null $callbackUrl
     */

    public function __CONSTRUCT(string $consumerKey = null,
                                string $consumerSecret = null,
                                ?string $callbackUrl= null) {
        $this->key = $consumerKey;
        $this->secret = $consumerSecret;
        $this->callbackUrl = $callbackUrl;
        $this->init($consumerKey, $consumerSecret);
    }
    public function init($consumerKey, $consumerSecret, ?string $oauthToken = null,?string $oauthTokenSecret = null,) {
        parent::__construct($consumerKey, $consumerSecret, $oauthToken,$oauthTokenSecret);

    }




    /**
     * @return void
     * @throws \Abraham\TwitterOAuth\TwitterOAuthException
     */
    public function Tweet(): void
    {

        $access_token = unserialize(file_get_contents('.faceprintlab.twitter'));
        $this->init($this->key , $this->secret,
            $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $this->setApiVersion('2');
        $response = $this->post('tweets', ['text' => 'Hello Twitter2 https://www.sabanew.net/story/ar/86981'], true);
        echo "______________________________________";
        print_r($this);
        echo "x______________________________________";

    }


}


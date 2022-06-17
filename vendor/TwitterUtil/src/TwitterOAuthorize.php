<?php

namespace TwitterUtil;

class TwitterOAuthorize extends \Abraham\TwitterOAuth\TwitterOAuth
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
    public function Authorize(): void
    {
        // main startup code
        //this code will return your valid url which u can use in iframe src to popup or can directly view the page as its happening in this example
        //$connection = new TwitterOAuthorize($this->key , $this->secret );
        $this->setApiVersion('2');
        $temporary_credentials = $this->oauth('oauth/request_token', array("oauth_callback" => $this->callbackUrl));
        $_SESSION['oauth_token'] = $temporary_credentials['oauth_token'];
        $_SESSION['oauth_token_secret'] = $temporary_credentials['oauth_token_secret'];
        $url = $this->url("oauth/authorize", array("oauth_token" => $temporary_credentials['oauth_token']));
        // REDIRECTING TO THE URL
        header('Location: ' . $url);

    }

    /**
     * @return void
     * @throws \Abraham\TwitterOAuth\TwitterOAuthException
     */
    public function StoreToken(string $outputDir): void
    {
        $oauth_token = $_SESSION['oauth_token'];
        unset($_SESSION['oauth_token']);
        // everything looks good, request access token
        //successful response returns oauth_token, oauth_token_secret, user_id, and screen_name

        //$connection = new TwitterOAuth($this->key , $this->secret );
        $this->setApiVersion('2');
        //necessary to get access token other wise u will not have permision to get user info
        $params = array("oauth_verifier" => $_GET['oauth_verifier'], "oauth_token" => $_GET['oauth_token']);
        $access_token = $this->oauth("oauth/access_token", $params);
        //now again create new instance using updated return oauth_token and oauth_token_secret because old one expired if u dont u this u will also get token expired error
        file_put_contents($outputDir . '.' . $access_token['screen_name'] . '.twitter', (string)serialize($access_token));
        /*$this->init($this->key , $this->secret,
            $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $this->setApiVersion('2');
        //$content = $connection->get("account/verify_credentials");

        $response = $this->post('tweets', ['text' => 'Hello Twitter2 https://www.sabanew.net/story/ar/86981'], true);


        echo "______________________________________";
        print_r($this);
        echo "x______________________________________";*/

    }


    /**
     * @return void
     * @throws \Abraham\TwitterOAuth\TwitterOAuthException
     */
    public function Tweet(): void
    {
        $oauth_token = $_SESSION['oauth_token'];
        unset($_SESSION['oauth_token']);
        // everything looks good, request access token
        //successful response returns oauth_token, oauth_token_secret, user_id, and screen_name

        //$connection = new TwitterOAuth($this->key , $this->secret );
        $this->setApiVersion('2');
        //necessary to get access token other wise u will not have permision to get user info
        $params = array("oauth_verifier" => $_GET['oauth_verifier'], "oauth_token" => $_GET['oauth_token']);
        $access_token = $this->oauth("oauth/access_token", $params);
        //now again create new instance using updated return oauth_token and oauth_token_secret because old one expired if u dont u this u will also get token expired error
        file_put_contents('./.' . $access_token['screen_name'] . '.twitter', (string)serialize($access_token));
        $this->init($this->key, $this->secret,
            $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $this->setApiVersion('2');
        //$content = $connection->get("account/verify_credentials");

        $response = $this->post('tweets', ['text' => 'Hello Twitter2 https://www.sabanew.net/story/ar/86981'], true);


        echo "______________________________________";
        print_r($this);
        echo "x______________________________________";

    }


}

//use the magic method __serilizable to slove the object problem hopfully it will work
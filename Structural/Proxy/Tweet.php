<?php
class Tweet {
    protected $data;
    public function __construct(array $data) {
        $this->data = $data;
    }
    public function getText() {
        return $this->data['text'];
    }
}

class TweetProxy extends Tweet {
    protected $api;
    protected $id;
    public function __construct(TwitterApi $api, $id) {
        $this->api = $api;
        $this->id  = $id;
    }
    public function getText() {
        return $this->api->getTweetText($this->id);
    }
}

$tweet = new Tweet(array('text' => 'Proxies in PHP!'));
var_dump($tweet->getText()); // Proxies in PHP!

$api = new TwitterApi(/* yadda */);

$remoteTweet = new TweetProxy($api, 280643708968386560);
var_dump($remoteTweet->getText()); // Tweet text!

$remoteTweet = new TweetProxy($api, 280643708968386561);
var_dump($remoteTweet->getText()); // Another text!

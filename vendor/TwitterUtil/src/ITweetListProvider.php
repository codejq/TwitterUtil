<?php

namespace TwitterUtil;

interface ITweetListProvider
{
    /**
     * @return TwitterEntry\TwitterUtil\TwitterEntry[]
     */
    public function TweetList():iterable;
    public function RemoveFromQuee($uniqId):void;

}
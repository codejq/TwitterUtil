<?php

namespace TwitterUtil;

use TwitterUtil\SocialMediaEntity\TwitterEntry;

class TweetListFileBasedProvider implements ITweetListProvider
{
    private string $filesPath;
    private string $extention;

    public function __construct($filesPath, $extention)
    {
        $this->filesPath = $filesPath;
        $this->extention = $extention;

    }

    /**
     * @return TwitterEntry[]
     */
    public function TweetList(): iterable
    {
        $files = glob("{$this->filesPath}{,.}*.{$this->extention}", GLOB_BRACE);
        $list = array();
        foreach ($files as $filename) {
            $list[$filename] = @unserialize(file_get_contents($filename));
        }
        return $list;
    }


    /**
     * @return void
     */
    public function RemoveFromQuee($fileName): void
    {
        unlink($fileName);
    }


}
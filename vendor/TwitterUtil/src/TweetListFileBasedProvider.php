<?php

namespace TwitterUtil;

class TweetListFileBasedProvider implements ITweetListProvider
{
    private string $filesPath;
    private string $extention;

    public function __construct($filesPath, $extention)
    {
        $this->$filesPath = $filesPath;
        $this->$extention = $extention;

    }

    public function TweetList(): array
    {
        $files = glob("{$this->$filesPath}*.{$this->$extention}}");
        $list = array();
        foreach ($files as $filename) {
            $list[] = @unserialize(file_get_contents($filename));
        }
        return $list;
    }
}
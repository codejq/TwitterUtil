<?php

namespace TwitterUtil;

class AccountListFileBasedProvider implements IAccountListProvider
{
    private string $filesPath;
    private string $extention;

    public function __construct($filesPath, $extention)
    {
        $this->filesPath = $filesPath;
        $this->extention = $extention;
    }

    public function AccountList(): array
    {
        $files = glob("{$this->filesPath}{,.}*.{$this->extention}",GLOB_BRACE);
        $list = array();
        foreach ($files as $filename) {
            $list[] = @unserialize(file_get_contents($filename));
        }
        return $list;
    }

}
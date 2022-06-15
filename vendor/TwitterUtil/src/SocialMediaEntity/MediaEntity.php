<?php
declare(strict_types=1);
namespace TwitterUtil\SocialMediaEntity;
abstract class MediaEntity
{
    protected $text, $link, $attachedImagePath;


    public function __construct($text, $link, $attachedImagePath = null)
    {
        $this->text = $text;
        $this->link = $link;
        $this->attachedImagePath = $attachedImagePath;

    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setLink($Link)
    {
        $this->Link = $Link;
    }

    public function setAttachedImagePath($attachedImagePath)
    {
        $this->attachedImagePath = $attachedImagePath;
    }

    public function getText($text)
    {
        return $this->text;
    }

    public function getLink($Link)
    {
        return $this->Link;
    }

    public function getAttachedImagePath($attachedImagePath)
    {
        return $this->attachedImagePath;
    }


/*
 * // using the built in serizer is enough for the sitiwation
    public function __serialize()
    {
        return [
            'text' => $this->text,
            'link' => $this->link,
            'attachedImagePath' => $this->attachedImagePath,
        ];

    }

    public function __unserialize(array $data): void
    {
        $this->text = $data['text'];
        $this->link = $data['link'];
        $this->attachedImagePath = $data['attachedImagePath'];
    }
*/
}
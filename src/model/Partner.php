<?php


namespace Project\Model;


class Partner
{
public $image= null;
public $resume=null;
public $name=null;

    /**
     * @return null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return null
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }
}
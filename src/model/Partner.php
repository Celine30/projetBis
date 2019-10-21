<?php


namespace Project\Model;


class Partner
{
public $image= null;
public $resume=null;
public $name=null;

    function Get_All(){
        $partner =[
            'imagePartner'=> $this->image,
            'namePartner'=>$this->name,
            'resumePartner'=>$this->resume
        ];
        return $partner;
    }
}



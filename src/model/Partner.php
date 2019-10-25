<?php


namespace Project\Model;


class Partner
{
public $id_name= null;
public $image= null;
public $resume=null;
public $name=null;
public $lien=null;

    function Get_All(){
        $partner =[
            'idPartner'=>$this->id_name,
            'imagePartner'=> $this->image,
            'namePartner'=>$this->name,
            'resumePartner'=>$this->resume,
            'lien'=>$this->lien
        ];
        return $partner;
    }
}



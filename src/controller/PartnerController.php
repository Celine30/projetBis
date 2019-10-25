<?php


namespace Project\Controller;

use Tracy\Debugger;
Debugger::enable();
use Project\Model;

class PartnerController extends Controller
{

    public function partner_cde()
    {
        $partner = new Model\PartnerCde();
        $this->partner('partner_cde',$partner );
    }

        public function partner_cde_com()
    {
        $partner = new Model\PartnerCde();
        $this->view_add_com($partner );
    }

    public function partner_dsa()
    {
        $partner = new Model\PartnerDsa();
        $this->partner('partner_dsa',$partner );
    }

    public function partner_dsa_com()
    {
        $partner = new Model\PartnerDsa();
        $this->view_add_com($partner );
    }

    public function partner_co()
    {
        $partner = new Model\PartnerCo();
        $this->partner('partner_co',$partner );

    }

    public function partner_co_com()
    {
        $partner = new Model\PartnerCo();
        $this->view_add_com($partner );

    }

    public function partner_pro()
    {
        $partner = new Model\PartnerPro();
        $this->partner('partner_pro',$partner );
    }

        public function partner_pro_com()
    {
        $partner = new Model\PartnerPro();
        $this->view_add_com($partner );
    }

}
<?php


namespace Project\Controller;

use Tracy\Debugger;
Debugger::enable();
use Project\Model;

class PartnerController extends Controller
{

    public function partner_cde($message="")
    {
        $partner = new Model\PartnerCde();
        $this->partner('partner_cde',$partner ,$message);
    }

        public function partner_cde_com()
    {
        $partner = new Model\PartnerCde();
        $this->view_add_com($partner);
    }

     public function partner_cde_good()
    {
        $this->User_avis('partner_cde' , $_SESSION['username'], 'good');
    }

    public function partner_cde_bad()
    {
        $this->User_avis('partner_cde' , $_SESSION['username'], 'bad');
    }

    public function partner_dsa($message="")
    {
        $partner = new Model\PartnerDsa();
        $this->partner('partner_dsa',$partner ,$message);
    }

    public function partner_dsa_com()
    {
        $partner = new Model\PartnerDsa();
        $this->view_add_com($partner );
    }

     public function partner_dsa_good()
    {
        $this->User_avis('partner_dsa' , $_SESSION['username'], 'good');
    }

    public function partner_dsa_bad()
    {
        $this->User_avis('partner_dsa' , $_SESSION['username'], 'bad');
    }

    public function partner_co($message="")
    {
        $partner = new Model\PartnerCo();
        $this->partner('partner_co',$partner ,$message);

    }

    public function partner_co_com()
    {
        $partner = new Model\PartnerCo();
        $this->view_add_com($partner );

    }

     public function partner_co_good()
    {
        $this->User_avis('partner_co' , $_SESSION['username'], 'good');
    }

    public function partner_co_bad()
    {
        $this->User_avis('partner_co' , $_SESSION['username'], 'bad');
    }

    public function partner_pro($message="")
    {
        $partner = new Model\PartnerPro();
        $this->partner('partner_pro',$partner ,$message);
    }

        public function partner_pro_com()
    {
        $partner = new Model\PartnerPro();
        $this->view_add_com($partner );
    }

     public function partner_pro_good()
    {
        $this->User_avis('partner_pro' , $_SESSION['username'], 'good');
    }

    public function partner_pro_bad()
    {
        $this->User_avis('partner_pro' , $_SESSION['username'], 'bad');
    }




}
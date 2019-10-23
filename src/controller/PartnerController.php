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
        $partner = $partner->Get_All();

        $com_partner = new Model\BackManager();
        $data = $com_partner->list_com('partner_cde');

        return $this->twig->render('partner.twig', array(
            'partner' => $partner,
            'data'=> $data
        ));
    }

        public function partner_cde_com()
    {
        $partner = new Model\PartnerCde();
        $partner = $partner->Get_All();
        return $this->twig->render('partner.twig', array(
            'partner' => $partner,
            'comment' => 'comment'
        ));
    }


    public function partner_dsa()
    {
        $partner = new Model\PartnerDsa();
        $partner = $partner->Get_All();
        return $this->twig->render('partner.twig', array(
            'partner' => $partner
        ));
    }

    public function partner_dsa_com()
    {
        $partner = new Model\PartnerDsa();
        $partner = $partner->Get_All();
        return $this->twig->render('partner.twig', array(
            'partner' => $partner,
            'comment' => 'comment'
        ));
    }


    public function partner_co()
    {
        $partner = new Model\PartnerCo();
        $partner = $partner->Get_All();
        return $this->twig->render('partner.twig', array(
            'partner' => $partner
        ));

    }

    public function partner_co_com()
    {
        $partner = new Model\PartnerCo();
        $partner = $partner->Get_All();
        return $this->twig->render('partner.twig', array(
            'partner' => $partner,
            'comment' => 'comment'
        ));

    }

    public function partner_pro()
    {
        $partner = new Model\PartnerPro();
        $partner = $partner->Get_All();
        return $this->twig->render('partner.twig', array(
            'partner' => $partner
        ));
    }

        public function partner_pro_com()
    {
        $partner = new Model\PartnerPro();
        $partner = $partner->Get_All();
        return $this->twig->render('partner.twig', array(
            'partner' => $partner,
            'comment' => 'comment'
        ));
    }

}
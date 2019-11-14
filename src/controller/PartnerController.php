<?php


namespace Project\Controller;

class PartnerController extends Controller
{
     public function actor($message="")
    {
        $_GET['partner'];
        $this->partner( $_GET['partner'],$message);
    }

    public function good()
    {
        $this->User_avis($_GET['partner'] , $_SESSION['id_user'], 'good');
    }

    public function bad()
    {
        $this->User_avis($_GET['partner'] , $_SESSION['id_user'], 'bad');
    }

    public function view_comment()
    {
        $this->view_add_com($_GET['partner']);
    }

}
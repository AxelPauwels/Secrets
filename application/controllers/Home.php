<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = '';
        $data['subtitle'] = '';
        $data['nobox'] = true;      // geen extra rand rond hoofdmenu
        $data['footer'] = '';

        $partials = array('header' => 'main_header', 'content' => 'home');
        $this->template->load('main_master', $partials, $data);
    }

}

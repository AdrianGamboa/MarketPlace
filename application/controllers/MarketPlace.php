<?php
class MarketPlace extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MarketPlace_model');
    }
    function index()
    {
        $data['_view'] = 'marketPlace/index';
        $this->load->view('layouts/main', $data);
    }
}

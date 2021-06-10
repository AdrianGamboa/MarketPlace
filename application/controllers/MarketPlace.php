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
        // $data['tweets'] = $this->Twitter_model->get_all_tweets();
        // $data['_view'] = 'twitter/index';
        // $this->load->view('layouts/main', $data);
    }
}

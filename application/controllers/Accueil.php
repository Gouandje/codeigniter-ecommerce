<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Accueil extends CI_Controller
{
	
	public function index(){
		// $data = array();
        $data['all_featured_products'] = $this->HomeModel->get_all_featured_product();
        $data['all_new_products'] = $this->HomeModel->get_all_new_product();
		$this->load->view('entete/header');
		$this->load->view('entete/css');
		$this->load->view('entete/navbar');
		$this->load->view('home/accueil', $data);
		$this->load->view('entete/footer');
		$this->load->view('entete/htmlclose');
		

		
	}

	public function apropos()
	{
		$this->load->view('entete/header');
		$this->load->view('css/extracss');
		$this->load->view('entete/css');
		$this->load->view('entete/navbar');
		$this->load->view('apropos');
		$this->load->view('entete/footer');
		$this->load->view('js/extrajs');
		$this->load->view('entete/htmlclose');
	}

	public function login(){
		$this->load->view('entete/header');
		$this->load->view('css/extracss');
		$this->load->view('entete/css');
		$this->load->view('entete/navbar');
		$this->load->view('login/index');
		$this->load->view('entete/footer');
		$this->load->view('js/extrajs');
		$this->load->view('entete/htmlclose');

	}

	public function search() {

        $search = $this->input->get('search');
        
        if(!empty($search)){
            $data = array();
            $data['get_all_product'] = $this->HomeModel->get_all_search_product($search);
            $data['search'] = $search;

            if ($data['get_all_product']) {
            	$this->load->view('entete/header');
				$this->load->view('css/extracss');
				$this->load->view('entete/css');
				$this->load->view('entete/navbar');
				$this->load->view('home/search', $data);
				$this->load->view('entete/footer');
				$this->load->view('js/extrajs');
				$this->load->view('entete/htmlclose');
            } else {
                redirect('error');
            }
        }
        else {
                redirect('error');
            }
    }
}
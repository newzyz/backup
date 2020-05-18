<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	function __construct()
    {
		parent::__construct();
		$this->load->model('categories_model');
		$this->load->model('product_model');
		$this->load->model('contact_model');
		$this->load->model('cart_model');
    }  
	public function index()
	{
		$data['cart'] = $this->cart_model->findAll();
		$data['categories'] = $this->categories_model->findAll();
		$datacon['contact'] = $this->categories_model->findAll();
		// $condition = array(
		// 	'categories_id' => intval($categoriesId)
		// );
		// $data['products'] = $this->product_model->findAll($condition);
		// print_r($data['products']);
		// exit();
		$this->load->view('layout/head');
		$this->load->view('layout/header', $data);
		$this->load->view('layout/menu');
		// $this->load->view('layout/home');
		$this->load->view('contact/content',$datacon);
		$this->load->view('layout/footer');
	
	}

	public function save()
    {
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
       
        $data_contact = array(
            "firstName" => $firstName,
			"lastName" => $lastName,
            "subject" => $subject,
			"message" => $message
        );
        //  print_r($data_contact);
		// exit();
		
		
        $id = $this->contact_model->insert($data_contact);
        if(!empty($id)){
            $this->session->set_flashdata('success-msg', 'contact Added');
            redirect('contact');
        }else{
            echo "error";
        }
    }
}

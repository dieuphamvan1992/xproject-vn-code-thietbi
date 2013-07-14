<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Muser');
        $this->load->library('form_validation');
    }
    
    public function index(){
        if (!$this->session->userdata('user')){
            $this->load->helper(array('form'));
            $this->load->view('user/login');
        }else{
            redirect('thietbi', 'refresh');
        }
    }
    
    public function verifylogin(){
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
        
        if ($this->form_validation->run() == FALSE){
            $this->load->view('user/login');
        }else{
            redirect('thietbi', 'refresh');
        }
    }
    
    public function check_database($password){
        $username = $this->input->post('username');
        
        $result = $this->Muser->login($username, $password);
        if ($result){
            $this->session->set_userdata('user', $result);
            return TRUE;
        }else if ($username){
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return FALSE;
        }else{
            $this->form_validation->set_message('check_database', "");
            return FALSE;
        }
    }
    
    public function logout(){
        $this->session->unset_userdata('user');
        redirect('thietbi', 'refresh');
    }
}
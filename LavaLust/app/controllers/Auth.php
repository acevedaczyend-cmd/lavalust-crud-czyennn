<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->library('session');
    }
    
    public function login() {
        // Redirect to products dashboard if already logged in
        if ($this->session->userdata('logged_in')) {
            redirect('products');
        }
        $this->call->view('auth/login');
    }

    // Process Login Request
    public function authenticate() {
        $username = $this->io->post('username');
        $password = $this->io->post('password');

        // Czyen's Admin Credentials
        if ($username === 'czyen' && $password === 'czyen123') {
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('username', $username);
            redirect('products');
        } else {
            $this->session->set_flashdata('error', '🌸 Invalid pink credentials! Please try again.');
            redirect('login');
        }
    }

    // Logout Session
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
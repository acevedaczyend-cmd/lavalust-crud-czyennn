<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller { // naghahandle ng login, authentication, at logout ng user, at logout ng user

    public function __construct() { // nagrrun matic pag ginamit si auth controller
        parent::__construct();
        $this->call->library('session'); // nilload ng constructor yung session library para matrack kung nakalogin or hindi
    }
    
    public function login() {
        // Redirect to products dashboard if already logged in
        if ($this->session->userdata('logged_in')) { // pang check kung nakalogin na yung user or di -> punta sa prod page
            redirect('products');
        }
        $this->call->view('auth/login'); // pag di pa nakalogin
    }

    // Process Login Request
    public function authenticate() {
        $username = $this->io->post('username');
        $password = $this->io->post('password');

        // Admin Credentials
        if ($username === 'czyen' && $password === 'czyen123') {
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('username', $username);
            redirect('products');
        } else {
            $this->session->set_flashdata('error', '🌸 Invalid credentials! Please try again.');
            redirect('login');
        }
    }

    // Logout Session
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
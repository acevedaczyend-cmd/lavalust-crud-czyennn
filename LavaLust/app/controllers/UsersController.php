<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller
{
    public function index()
    {
        $this->call->model('UsersModel');
        $data['users'] = $this->UsersModel->all();
        $data['page_title'] = 'Users List';
        $this->call->view('users/index', $data);
    }
}
?>
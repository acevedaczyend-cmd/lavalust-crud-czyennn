<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Products extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->library('session');
        
        // Auth Guard Check
        if (! $this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->call->model('Product_model');
    }

    /* --- DASHBOARD VIEW --- */
    public function index() {
        $viewData = [
            'pageTitle' => 'Czyen Pink Inventory Suite',
            'items'     => $this->Product_model->get_all_products()
        ];
        $this->call->view('products/inventory_dashboard', $viewData);
    }

    /* --- ADD ITEM VIEW --- */
    public function add_item() {
        $viewData = ['pageTitle' => 'Add New Item - Czyen Suite'];
        $this->call->view('products/add_item_form', $viewData);
    }

    /* --- SAVE NEW ITEM --- */
    public function save_item() {
        $payload = [
            'product_name' => $this->io->post('product_name') ?? $this->io->post('name') ?? '',
            'description'  => $this->io->post('description') ?? '',
            'price'        => $this->io->post('price') ?? 0,
            'quantity'     => $this->io->post('quantity') ?? 0
        ];

        $this->Product_model->insert_product($payload);
        redirect('products');
    }

    /* --- MODIFY ITEM VIEW --- */
    public function modify_item($id) {
        $itemData = $this->Product_model->get_product_by_id($id);
        
        $viewData = [
            'pageTitle' => 'Modify Item Record',
            'item'      => is_array($itemData) && isset($itemData[0]) ? $itemData[0] : $itemData
        ];

        $this->call->view('products/modify_item_form', $viewData);
    }

    /* --- UPDATE ITEM --- */
    public function update_item($id) {
        $payload = [
            'product_name' => $this->io->post('product_name') ?? $this->io->post('name') ?? '',
            'description'  => $this->io->post('description') ?? '',
            'price'        => $this->io->post('price') ?? 0,
            'quantity'     => $this->io->post('quantity') ?? 0
        ];

        $this->Product_model->update_product($id, $payload);
        redirect('products');
    }

    /* --- REMOVE ITEM --- */
    public function remove_item($id) {
        $this->Product_model->delete_product($id);
        redirect('products');
    }
}
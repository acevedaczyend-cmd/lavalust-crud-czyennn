<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Products extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->library('session');
        
        if (! $this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->call->model('Product_model');
    }

    public function inventory() {
        $viewData = [
            'pageTitle' => 'Czyen Pink Inventory Suite',
            'items'     => $this->Product_model->get_all_products()
        ];
        
        if (file_exists(APP_DIR . '/views/products/inventory_dashboard.php')) {
            $this->call->view('products/inventory_dashboard', $viewData);
        } else {
            $this->call->view('products/index', $viewData);
        }
    }

    public function add_item() {
        $viewData = ['pageTitle' => 'Add New Item - Czyen Suite'];
        
        if (file_exists(APP_DIR . '/views/products/add_item_form.php')) {
            $this->call->view('products/add_item_form', $viewData);
        } else {
            $this->call->view('products/create', $viewData);
        }
    }

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

    public function modify_item($id = NULL) {
    $id = $id ?? $this->io->get('id');
    if (!$id) redirect('products');
    
    $itemData = $this->Product_model->get_product_by_id($id);
    $singleItem = is_array($itemData) && isset($itemData[0]) ? $itemData[0] : $itemData;
    
    $viewData = [
        'pageTitle' => 'Modify Item Record',
        'product'   => $singleItem,
        'item'      => $singleItem
    ];

    if (file_exists(APP_DIR . '/views/products/modify_item_form.php')) {
        $this->call->view('products/modify_item_form', $viewData);
    } else {
        $this->call->view('products/edit', $viewData);
    }
}

    public function update_item($id = NULL) {
    $id = $id ?? $this->io->get('id');
    if (!$id) redirect('products');

    $payload = [
        'product_name' => $this->io->post('product_name') ?? $this->io->post('name') ?? '',
        'description'  => $this->io->post('description') ?? '',
        'price'        => $this->io->post('price') ?? 0,
        'quantity'     => $this->io->post('quantity') ?? 0
    ];

    $this->Product_model->update_product($id, $payload);
    redirect('products');
}

    public function remove_item($id = NULL) {
    $id = $id ?? $this->io->get('id');
    if ($id) {
        $this->Product_model->delete_product($id);
    }
    redirect('products');
}
}
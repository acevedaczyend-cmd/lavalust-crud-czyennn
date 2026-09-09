<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Products extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->model('Product_model');
    }

    // Display Pink UI Products Table
    public function index() {
        $data['products'] = $this->Product_model->get_all_products();
        $this->call->view('products/index', $data);
    }

    // Show Create Form (Pink Theme)
    public function create() {
        $this->call->view('products/create');
    }

    // Store Product to Aiven DB
    public function store() {
        $data = array(
            'product_name' => $_POST['product_name'] ?? $_POST['name'] ?? '',
            'description'  => $_POST['description'] ?? '',
            'price'        => $_POST['price'] ?? 0,
            'quantity'     => $_POST['quantity'] ?? 0
        );

        $this->Product_model->insert_product($data);
        redirect('products');
    }

    // Show Edit Form (Pink Theme)
    public function edit($id) {
        $product = $this->Product_model->get_product_by_id($id);

        if (is_array($product) && isset($product[0])) {
            $data['product'] = $product[0];
        } else {
            $data['product'] = $product;
        }

        $this->call->view('products/edit', $data);
    }

    // Update Product Info
    public function update($id) {
        $data = array(
            'product_name' => $_POST['product_name'] ?? $_POST['name'] ?? '',
            'description'  => $_POST['description'] ?? '',
            'price'        => $_POST['price'] ?? 0,
            'quantity'     => $_POST['quantity'] ?? 0
        );

        $this->Product_model->update_product($id, $data);
        redirect('products');
    }

    // Delete Product
    public function delete($id) {
        $this->Product_model->delete_product($id);
        redirect('products');
    }
}
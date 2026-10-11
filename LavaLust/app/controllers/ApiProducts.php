
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiProducts extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('Product_model');
    }

    private function authorize($permission = 'read')
    {
        $payload = $this->api->require_jwt();

        if (!$payload) {
            return false;
        }

        $role = $payload['role'] ?? 'user';

        $permissions = [
            'admin'  => ['read', 'write', 'delete'],
            'editor' => ['read', 'write'],
            'user'   => ['read']
        ];

        if (!in_array(
            $permission,
            $permissions[$role] ?? ['read'],
            true
        )) {
            $this->api->respond_error('Permission denied.', 403);
            return false;
        }

        return true;
    }

    // GET /api/products
    public function index()
    {
        if (!$this->authorize('read')) {
            return;
        }

        $products = $this->Product_model->get_all_products();

        $this->api->respond([
            'products' => $products ?: []
        ]);
    }

    // POST /api/products
    public function store()
    {
        if (!$this->authorize('write')) {
            return;
        }

        $data = $this->api->body();

        $name = trim($data['product_name'] ?? '');
        $description = trim($data['description'] ?? '');
        $price = $data['price'] ?? null;
        $quantity = $data['quantity'] ?? null;

        if (
            $name === '' ||
            !is_numeric($price) ||
            !is_numeric($quantity) ||
            (float) $price < 0 ||
            (int) $quantity < 0 ||
            (string) $quantity !== (string) (int) $quantity
        ) {
            $this->api->respond_error(
                'Provide a product name, a valid non-negative price, and a non-negative whole-number quantity.',
                400
            );
            return;
        }

        $this->Product_model->insert_product([
            'product_name' => $name,
            'description' => $description,
            'price' => $price,
            'quantity' => (int) $quantity
        ]);

        $this->api->respond([
            'message' => 'Product added successfully.'
        ], 201);
    }

    // PUT /api/products/{id}
    public function update($id)
    {
        if (!$this->authorize('write')) {
            return;
        }

        if (!ctype_digit((string) $id) || (int) $id < 1) {
            $this->api->respond_error('Invalid product ID.', 400);
            return;
        }

        $existing = $this->Product_model->get_product_by_id((int) $id);

        if (!$existing) {
            $this->api->respond_error('Product not found.', 404);
            return;
        }

        $data = $this->api->body();

        $name = trim($data['product_name'] ?? '');
        $description = trim($data['description'] ?? '');
        $price = $data['price'] ?? null;
        $quantity = $data['quantity'] ?? null;

        if (
            $name === '' ||
            !is_numeric($price) ||
            !is_numeric($quantity) ||
            (float) $price < 0 ||
            (int) $quantity < 0 ||
            (string) $quantity !== (string) (int) $quantity
        ) {
            $this->api->respond_error(
                'Provide a product name, a valid non-negative price, and a non-negative whole-number quantity.',
                400
            );
            return;
        }

        $this->Product_model->update_product((int) $id, [
            'product_name' => $name,
            'description' => $description,
            'price' => $price,
            'quantity' => (int) $quantity
        ]);

        $this->api->respond([
            'message' => 'Product updated successfully.'
        ]);
    }

    // DELETE /api/products/{id}
    public function delete($id)
    {
        if (!$this->authorize('delete')) {
            return;
        }

        if (!ctype_digit((string) $id) || (int) $id < 1) {
            $this->api->respond_error('Invalid product ID.', 400);
            return;
        }

        $existing = $this->Product_model->get_product_by_id((int) $id);

        if (!$existing) {
            $this->api->respond_error('Product not found.', 404);
            return;
        }

        $this->Product_model->delete_product((int) $id);

        $this->api->respond([
            'message' => 'Product deleted successfully.'
        ]);
    }
}

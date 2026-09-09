<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product_model extends Model {

    // Fetch all products for Czyen's dashboard
    public function get_all_products() {
        return $this->db->table('products')->get_all();
    }

    // Fetch single product details by ID
    public function get_product_by_id($id) {
        return $this->db->table('products')->where('id', $id)->get();
    }

    // Insert new product into Aiven MySQL database
    public function insert_product($data) {
        return $this->db->table('products')->insert($data);
    }

    // Update product info in database
    public function update_product($id, $data) {
        return $this->db->table('products')->where('id', $id)->update($data);
    }

    // Remove product entry
    public function delete_product($id) {
        return $this->db->table('products')->where('id', $id)->delete();
    }
}
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Account_model extends Model
{
    public function get_account_by_username($username)
    {
        return $this->db->table('accounts')
            ->where('username', $username)
            ->get();
    }

    public function update_password($id, $hashedPassword)
    {
        return $this->db->table('accounts')
            ->where('id', $id)
            ->update([
                'password' => $hashedPassword
            ]);
    }
}

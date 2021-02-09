<?php

class Api_model extends CI_Model{

    public function fetch_single($id){
        return $this->db->get_where('users', ['id'=> $id])->result_array();
    }

    public function fetch_all(){
        return $this->db->get('users')->result();
    }
    
    public function insert($input){
        
        $this->db->insert('users',$input);
    }

    public function update($id, $input){
        // $this->db->update('users', $input, ['id' => $id]);
        $this->db->where('id', $id);
        $this->db->update('users', $input);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('users');
    }

    // user registration
    public function user_insert($input){
        
        $insert = $this->db->insert('users_cred',$input);
        return $insert ? true : false;
    }

    public function user_check($input){
        
        $insert = $this->db->get_where('users_cred', $input)->result_array();
        return $insert ? true : false;
    }





}
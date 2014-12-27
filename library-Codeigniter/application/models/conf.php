<?php
class Conf extends CI_Model{
    protected $table = 'config';
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    function update($name, $setting){
        $data = array(
                       'setting'  => $setting
                    );
        $this->db->where('name', $name);
        $this->db->update($this->table, $data);
    }
    function GetAllConfig(){
        $this->db->select('setting');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    function ConfigDefault($name){
        $data = array(
                       'setting'  => '`default`'
                    );
        $this->db->where('name', $name);
        $this->db->update($this->table, $data,null,null,false);
    }
}
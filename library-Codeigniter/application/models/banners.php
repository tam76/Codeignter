<?php
class Banners extends CI_Model{
    protected $table = 'banner';
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    function BannerList($order,$by){
        $this->db->select('id, title, group, time_create, username, banner.status')
                    ->join('user', 'userid = user_create','left')
                    ->order_by($order, $by); 
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
    function BannerAdd($title, $link, $group, $time_create, $user_create, $status){
        $data = array(
           'title'      => $title ,
           'link'       => $link ,
           'group'      => $group,
           'time_create'=> $time_create ,
           'user_create'=> $user_create ,
           'status'     => $status
        );
        $this->db->insert($this->table, $data); 
    }
    
    function InfoBanner($id){
        $this->db->select('id, title, link, group, banner.status')
                ->where('id',$id);
        $query = $this->db->get($this->table);
        if($this->db->count_all_results() == 0){
            return false;
        } else{
            return $query->row_array();
        }
    }
    
    function GetInfo($id, $select){
        $this->db->select($select)
                ->where('id',$id);
        $query = $this->db->get($this->table);
        if($this->db->count_all_results() == 0){
            return false;
        } else{
            return $query->row_array();
        }
    }
    
    function Edit($id,$data){
        $this->db->where('id', $id);
        $this->db->update($this->table, $data); 
    }
    
    function DelBanner($id){
        $this->db->delete($this->table, array('id' => $id)); 
    }
    
    function GetBanner(){
        $this->db->select('group')
                 ->distinct();
        $query = $this->db->get($this->table);
        $group = $query->result_array();
        foreach($group as $val){
            $this->db->select('id, title, link')
                        ->where('status',1)
                        ->where('group',$val['group'])
                        ->order_by('id', 'DESC'); 
            $query = $this->db->get($this->table);
            $banner[$val['group']] = $query->result_array();
        }
        return $banner;
    }
}
<?php
class Category extends CI_Model{
    protected $table = 'category';
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    function CountCate(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function CateList($number, $offset,$order,$by){
        $this->db->select('cateid, cate_title, tag')
                    ->order_by($order, $by); 
        $query = $this->db->get($this->table,$number,$offset);
        return $query->result_array();
    }
    function SelectCate(){
        $this->db->select('cateid, cate_title');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    function SelectKey($id){
        $this->db->select('tag')->where('cateid',$id);;
        $query = $this->db->get($this->table);
        return $query->row_array();
    }
    function SelectTitle($id){
        $this->db->select('cate_title')->where('cateid',$id);
        $query = $this->db->get($this->table);
        $title = $query->row_array();
        if(empty($title)){
            return false;
        }else {
            return $title['cate_title'];
        }
    }
    function InfoCate($id){
        $this->db->where('cateid',$id);
        $query = $this->db->get($this->table);
        if($this->db->count_all_results() == 0){
            return false;
        }else{
            return $query->row_array();
        }
    }
    function AddCate($cate_title, $tag){
        $data = array(
           'cate_title' => $cate_title ,
           'tag' => $tag
        );
        
        $this->db->insert($this->table, $data); 
    }
    function EditCate($id, $cate_title, $tag) {
        $data = array(
                       'cate_title' => $cate_title,
                       'tag' => $tag,
                    );
        
        $this->db->where('cateid', $id);
        $this->db->update($this->table, $data); 
    }
    function DelCate($id) {
        $this->db->delete($this->table, array('cateid' => $id)); 
    }
}

?>
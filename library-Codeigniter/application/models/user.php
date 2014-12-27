<?php
class User extends CI_Model{
    protected $table = 'user';
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('security');
    }
    
    function CountUser(){
        $this->db->from('user');
        return $this->db->count_all_results();
    }
    
    function UserList($number, $offset,$order,$by){
        $this->db->select('userid, username, email, level, visited_date, property, status')
                    ->order_by($order, $by); 
        $query = $this->db->get('user',$number,$offset);
        return $query->result_array();
    }
    
    function Checklogin($user,$pass){
        $this->db->from('user');
        $this->db->where(array('username'=>$user,'password'=>do_hash($pass,'md5'),'status'=>1));
        $query = $this->db->get();
        if($query->num_rows() == 0){
            return false;
        }else{
            $query = $query->result_array();
            $user = array(
                        'userid'    => $query[0]['userid'],
                        'username'  => $query[0]['username'],
                        'level'     => $query[0]['level'],
                        'avata'     => $query[0]['avata'],
                        'bookcase'  => $query[0]['bookcase'],
                        'property'  => $query[0]['property']
                    );
            $this->session->set_userdata($user);
            $this->_visit($query[0]['userid']);
            return true;
        }
    }
    
    function _visit($id){
        $this->load->helper('date');
        $timestamp = time();
        $timezone = 'UP5';
        $time = gmt_to_local($timestamp, $timezone, TRUE);
        $datestring = "%d-%m-%Y %H:%i";
        $time = mdate($datestring, $time);
        $data = array(
                       'visited_date'  => $time,
                       'visited_ip'   => $this->input->ip_address()
                    );
        
        $this->db->where('userid', $id);
        $this->db->update('user', $data); 
        return true;
    }
    
    function CheckChange($change){
        if($change == 'active'){
            return '1';
        }elseif($change == 'inactive'){
            return '2';
        }else{
            return false;
        }
    }
    
    function GetInfo($id){
        $this->db->where('userid',$id);
        $this->db->select('info');
        $query = $this->db->get('user');
        return $query->row_array();
    }
    
    function ChangeInfo($id, $avata, $info){
        $data = array(
                       'avata'  => $avata,
                       'info'   => $info
                    );
        
        $this->db->where('userid', $id);
        $this->db->update('user', $data); 
        return true;
    }
    
    function ChangeStt($change, $id){
        if($this->CheckChange($change) == false){
            return false;
        }else{
            $data = array(
                           'status' => $this->CheckChange($change),
                           'active_code' => ''
                        );
            
            $this->db->where('userid', $id);
            $this->db->update('user', $data); 
            return true;
        }
    }
    
    function InfoUser($id){
        $this->db->where('userid',$id);
        $query = $this->db->get('user');
        if($this->db->count_all_results() == 0){
            return false;
        }else{
            return $query->row_array();
        }
    }
    
    function AddUser($data){
        if($this->db->insert('user', $data)){
            return true;    
        }else{
            return false;
        }
    }
    
    function EditUser($id, $password, $email, $avata = 'default.jpg', $level, $info){
        $data = array(
                       'password' => $password,
                       'email' => $email,
                       'avata' => $avata,
                       'level' => $level,
                       'info' => $info
                    );
        
        $this->db->where('userid', $id);
        $this->db->update('user', $data); 
    }
    
    function GetImg($id){
        $this->db->where('userid',$id);
        $this->db->select('avata, level');
        $query = $this->db->get('user');
        return $query->row_array();
    }
    
    function DelUser($id){
        $this->db->delete('user', array('userid' => $id)); 
    }
    
    function BuyBook($id, $bookcase, $propery){
        $data = array(
                       'bookcase' => $bookcase,
                       'property' => $propery
                    );
        
        $this->db->where('userid', $id);
        $this->db->update('user', $data); 
        return true;
    }
    
    function Recharge($id, $propery, $history){
        $data = array(
                       'property' => $propery,
                       'history'  => $history
                    );
        
        $this->db->where('userid', $id);
        $this->db->update('user', $data); 
        return true;
    }
    
    function CheckBookCase($id, $bookcase){
        $data = array(
                       'bookcase' => $bookcase
                    );
        
        $this->db->where('userid', $id);
        $this->db->update('user', $data); 
        return true;
    }
    
    function GetPass($id){
        $this->db->where('userid',$id);
        $this->db->select('password');
        $query = $this->db->get('user');
        $result = $query->row_array();
        return $result['password'];
    }
    
    function GetHistory($id){
        $this->db->where('userid',$id);
        $this->db->select('history');
        $query = $this->db->get('user');
        $result = $query->row_array();
        return $result['history'];
    }
    
    function ChangePass($id, $pass){
        $data = array(
                       'password' => do_hash($pass, 'md5')
                    );
        
        $this->db->where('userid', $id);
        $this->db->update('user', $data);
    }
    
    function getInfoByEmail($email){
        $this->db->where("email",$email);
        $query = $this->db->get('user');

        if($query)
            return $query->row_array();
        else
            return FALSE;
    }
    
    function UpDate($data,$id){
        $this->db->where("userid",$id);
        if($this->db->update($this->table,$data))
            return TRUE;
        else
            return FALSE;
    }

    function checkActive($userid,$key){
         if($userid!="" && $key!=""){
            
            $this->db->where("userid",$userid);
            $this->db->where("active_code",$key);
            $query = $this->db->get('user');
            if($query->num_rows()!=0){
                
                return $query->row_array();
                
            }else{
                return FALSE;
            }
            
        }else{
            return FALSE;
        }
    }
}
?>
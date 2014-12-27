<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Define{
    protected $data = '';
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user');
    }
    
    /**
     * HÀM KIỂM TRA QUYỀN HẠN NGƯỜI DÙNG
     */
    function _permission($action,$id, $level){
        $tam = $this->session->userdata('userid');
        switch($action){
			case 'edit':
				if($tam != 2 && ($id == 2 || ($level == 1 && $tam != $id)) || ($this->session->userdata('level') == 2 && $tam != $id)){
				    return false;
				}else{
				    return true;
				}
				break;
			case 'del':
				if(($id == 2) || ($id == 1) || ($tam != 2 && $level == 1)) {
                    return false;
                } else {
                    return true;
                }
				break;
		}
    }
    
    /**
     * TRANG QUẢN LÝ NGƯỜI DÙNG
     */
    function index($order = 'userid', $by = 'DESC', $offset = 0){
        $data['menu'] = array('user_add');
        $not_order = array('userid','username','level','property','email', 'visit_date','status');
        $this->load->library('pagination'); 
        $data['site'] = 'user/list';
        if(!in_array($order , $not_order)){
            $order = 'userid';
        }
        if($by != 'DESC' && $by!= 'ASC'){
            $by = 'DESC';
        }
        $config['base_url'] = base_url('index.php/admin/users/index/'.$order.'/'.$by); // xác d?nh trang phân trang 
        $config['total_rows'] = $this->user->CountUser(); // xác d?nh t?ng s? record 
        $config['per_page'] = USER_LIMIT; // xác d?nh s? record ? m?i trang 
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 6; // xác d?nh segment ch?a page number 
        $config['first_link'] = 'Ð?u';
        $config['cur_tag_open'] = '<span class="current_page">';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config); 
        if($offset > 0){
            $offset = ($offset * $config['per_page']) - $config['per_page'];
        }
        $data['data'] = $this->user->UserList($config['per_page'],$offset,$order,$by); 
        $this->load->view('template',$data);
    }

    /**
     * TRANG KÍCH HOẠT NGƯỜI DÙNG
     */
    function active($change, $id){
        $change =  $this->security->xss_clean($change);
        $id = $this->security->xss_clean($id);
        $this->user->ChangeStt($change,$id);
        redirect('admin/users');
    }
    
    /**
     * TRANG THÔNG TIN NGƯỜI DÙNG
     */
    function info ($id){
        $id = $this->security->xss_clean($id);
        $data['data'] = $this->user->InfoUser($id);
        if(is_numeric($id) && $data['data'] != false){
            $data['menu'] = array('user_list','user_add');
            $data['site'] = 'user/info';
            $data['info'] = json_decode($data['data']['info']);
            $this->load->view('template',$data);
        }else{
            redirect('admin/users');
        }
    }
    
    /**
     * HÀM TẠO THUMB ẢNH AVATA
     */
    function _thumb($name){
        $config['image_library']    = THUMB_IMG_LIBRARY;
        $config['source_image']	    = './'.AVATA_UPOAD_PATH.$name;
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = FALSE;
        $config['thumb_marker']     = '';
        $config['new_image']	    = './'.THUMB_NEW_IMAGE;
        $config['width']	        = THUMB_WIDTH;
        $config['height']	        = THUMB_HEIGHT;
        
        $this->load->library('image_lib', $config); 
        $this->image_lib->resize();
        $this->image_lib->clear();
        
        
        $config = array();
        $config['image_library']    = AVATA_IMG_LIBRARY;
        $config['source_image']	    = './'.AVATA_UPOAD_PATH.$name;
        $config['maintain_ratio']   = FALSE;
        $config['thumb_marker']     = '';
        $config['quality']          = AVATA_QUALITY;
        $config['width']	        = AVATA_WIDTH;
        $config['height']	        = AVATA_HEIGHT;
        
        $this->image_lib->initialize($config); 
        $this->image_lib->resize();
    }
    
    /**
     * HÀM KIỂM TRA MẬT KHẨU TRÙNG KHỚP
     */
    function _CheckPass($pass, $rePass){
        if($pass != $rePass){
            return false;
        }else{
            return true;
        }
    }
    
    /**
     * HÀM UPLOAD ẢNH NGƯỜI DÙNG
     */
    function _upload($name){
        $config['file_name'] = 'default.jpg';
        if(!empty($_FILES['userfile']['name'])){
            $config['upload_path']    = './'.AVATA_UPOAD_PATH;
    		$config['allowed_types']  = AVATA_ALLOWED_TYPES;
    		$config['file_name']      = $name.'.jpg';
    		$config['overwrite']      = TRUE;
    		$config['max_size']	      = AVATA_MAX_SIZE;
    		$config['max_width']      = AVATA_MAX_WIDTH;
    		$config['max_height']     = AVATA_MAX_HEIGHT;
            $this->load->library('upload', $config);
    		if ( ! $this->upload->do_upload()){
                return false;
    		}else{
                $this->_thumb($config['file_name']);
                return $config['file_name'];
    		}
        }else{
            return $config['file_name'];
        }
    }
    
    
    /**
     * TRANG THÊM NGƯỜI DÙNG
     */
    function add() {
        $this->data['menu'] = array('user_list');
        $this->data['site'] = 'user/add';
        $this->load->library('form_validation');
        if($this->input->post('btnUserAdd')){
            $this->form_validation->set_rules('txtUser', 'Username', 'required|min_length[5]|max_length[20]|alpha_dash|is_unique[user.username]');
            $this->form_validation->set_rules('txtPass', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('txtRepass', 'Confirm password', 'required|min_length[5]');
            $this->form_validation->set_rules('txtEmail', 'Email', 'required|min_length[5]|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('rdoLevel', 'Level', 'required|numeric');
            $this->form_validation->set_rules('txtNumber', 'Số điện thoại', 'numeric');
            $this->form_validation->set_rules('txtPhone', 'Di dộng', 'numeric');
            $this->form_validation->set_rules('txtID', 'Số cmnd', 'numeric');
            if ($this->form_validation->run() == FALSE){
                $this->data['error'] = validation_errors();
    			$this->load->view('template',$this->data);
    		}elseif($this->_CheckPass($this->input->post('txtPass'),$this->input->post('txtRepass')) == FALSE){
                $this->data['error'] = '<p>Mật khẩu không trùng khớp</p>';
    			$this->load->view('template',$this->data);
    		}else{
                if($this->_upload($this->input->post('txtUser')) == false){
                    $this->data['error'] = $this->upload->display_errors();
                    $this->load->view('template',$this->data);
                }else{
                    $avata = $this->_upload($this->input->post('txtUser'));
                    $this->load->helper('date');
                    $time       = gmt_to_local(time(), TIME_ZONE, TRUE);
                    $time       = mdate(STYLE_TIME, $time);
                    
                    $info['name']       = $this->input->post('txtName');
                    $info['gt']         = $this->input->post('sltGT');
                    $info['birthday']   = $this->input->post('txtNS');
                    $info['address']    = $this->input->post('txtAddress');
                    $info['number']     = $this->input->post('txtNumber');
                    $info['phone']      = $this->input->post('txtPhone');
                    $info['id']         = $this->input->post('txtID');
                    $info = json_encode($info,JSON_UNESCAPED_UNICODE);
                    
                    $data = array(
                       'username'       => $this->input->post('txtUser') ,
                       'password'       => md5($this->input->post('txtPass')) ,
                       'email'          => $this->input->post('txtEmail'),
                       'avata'          => $avata ,
                       'level'          => $this->input->post('rdoLevel') ,
                       'info'           => $info,
                       'register_date'  => $time,
                       'register_ip'    => $this->input->ip_address() ,
                       'active_code'    => md5(time()),
                       'status'         => '1'
                    );
                    
                    if($this->user->AddUser($data)){
                    
                        /*$userid     = mysql_insert_id();
                        $link_active = site_url()."/public/main/active/?userid=".$userid."&key=".md5(time());
                        $message    = "Please follow this link to active your acount <br/>";
                        $message   .= "Link : <a href=".$link_active.">".$link_active."</a><br/>";
                        $message   .= "username : ".$this->input->post('txtUser')."<br/>";
                        $message   .= "password : ".$this->input->post('txtPass');
                        
                        $mail = array(
                                "to_receiver"   => $this->input->post('txtEmail'), 
                                "message"       => $message,
                            );
                            
                        $this->load->library("my_email");
                        $this->my_email->config($mail);
                        $this->my_email->sendmail();*/
                    }
                    redirect('admin/users');
                }
                
    		}
        }else {
            $this->load->view('template',$this->data);
        }
    }
    
    /**
     * TRANG SỬA NGƯỜI DÙNG
     */
    function edit($id){
        $id = $this->security->xss_clean($id);
        $this->data['data'] = $this->user->InfoUser($id);
        if(is_numeric($id) && $this->data['data'] != false){
            $this->data['menu'] = array('user_list');
            $this->data['site'] = 'user/edit';
            $this->data['info'] = json_decode($this->data['data']['info']);
            if(!$this->_permission('edit',$id,$this->data['data']['level'])){
                redirect('admin/main');
            }
            $this->load->library('form_validation');
            if($this->input->post('btnUserEdit')){
                $this->form_validation->set_rules('txtPass', 'Password', 'min_length[5]');
                $this->form_validation->set_rules('txtRepass', 'Confirm password', 'min_length[5]');
                $this->form_validation->set_rules('txtEmail', 'Email', 'required|min_length[5]|valid_email');
                $this->form_validation->set_rules('rdoLevel', 'Level', 'required|numeric');
                $this->form_validation->set_rules('txtNumber', 'Số điện thoại', 'numeric');
                $this->form_validation->set_rules('txtPhone', 'Di dộng', 'numeric');
                $this->form_validation->set_rules('txtID', 'Số cmnd', 'numeric');
                if ($this->form_validation->run() == FALSE){
                    $this->data['error'] = validation_errors();
        			$this->load->view('template',$this->data);
        		}elseif($this->_CheckPass($this->input->post('txtPass'),$this->input->post('txtRepass')) == FALSE){
                    $this->data['error'] = '<p>Mật khẩu không trùng khớp</p>';
        			$this->load->view('template',$this->data);
        		}else{
                    if($this->_upload($this->data['data']['username']) == false){
                        $this->data['error'] = $this->upload->display_errors();
                        $this->load->view('template',$this->data);
                    }else{
                        if($this->input->post('txtPass') == ''){
                            $pass = $this->data['data']['password'];
                        }else{
                            $pass = md5($this->input->post('txtPass'));
                        }
                        if(!isset($_FILES['userfile']['name'])){
                            $avata = $this->data['data']['avata'];
                        }else{
                            $avata = $this->_upload($this->data['data']['username']);
                        }
                        $info['name']       = $this->input->post('txtName');
                        $info['gt']         = $this->input->post('sltGT');
                        $info['birthday']   = $this->input->post('txtNS');
                        $info['address']    = $this->input->post('txtAddress');
                        $info['number']     = $this->input->post('txtNumber');
                        $info['phone']      = $this->input->post('txtPhone');
                        $info['id']         = $this->input->post('txtID');
                        $info = json_encode($info,JSON_UNESCAPED_UNICODE);
                        $this->user->EditUser($id,$pass,$this->input->post('txtEmail'),$avata,$this->input->post('rdoLevel'),$info);
                        redirect('admin/users');
                    }
                    
        		}
            }else {
                $this->load->view('template',$this->data);
            }
        }else{
            redirect('admin/users');
        }
    }
    
    /**
     * TRANG XÓA NGƯỜI DÙNG
     */
    function del($id){
        $id = $this->security->xss_clean($id);
        $avata = $this->user->GetImg($id);
        if(!$this->_permission('edit',$id,$avata['level'])){
            redirect('admin/users');
        }
        if($avata['avata'] != 'default.jpg'){
            unlink(AVATA_UPOAD_PATH.$avata['avata']);
            unlink(THUMB_NEW_IMAGE.$avata['avata']);
        }
        $this->user->DelUser($id);
        redirect('admin/users');
    }
}
?>
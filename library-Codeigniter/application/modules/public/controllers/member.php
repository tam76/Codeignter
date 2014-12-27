<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Member extends Define{
    protected $data;
    function __construct(){
        parent::__construct();
        $this->load->helper(array('url','seourl'));
        $this->load->library('xml');
        $this->load->model(array('user','category'));
        $this->data['cate_menu'] = $this->category->SelectCate();
    }
    
    /**
     * HÀM LÀM THUMB CHO AVATA
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
     * HÀM UPLOAD CHO AVATA
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
     * TRANG THÔNG TIN THÀNH VIÊN
     */
    function Info(){
        $this->data['title'] = 'Thông tin thành viên';
        $this->data['site'] = 'member/info';
        $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => 'Thông tin thành viên')
                                    );
        $data = $this->user->GetInfo($this->session->userdata('userid'));
        $this->data['info'] = json_decode($data['info']);
        if($this->input->post('btnUserEdit')){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('txtNumber', 'Số điện thoại', 'numeric');
            $this->form_validation->set_rules('txtPhone', 'Di dộng', 'numeric');
            $this->form_validation->set_rules('txtID', 'Số cmnd', 'numeric');
            if ($this->form_validation->run() == FALSE){
                $this->data['error'] = validation_errors('<li>','</li>');
    		}else{
                $upload = $this->_upload($this->session->userdata('username'));
                if($upload == false){
                    $this->data['error'] = $this->upload->display_errors('<li>','</li>');
                }else{
                    if(!isset($_FILES['userfile']['name'])){
                        $avata = $this->session->userdata('avata');
                    }else{
                        $avata = $upload;
                    }
                    $this->session->set_userdata('avata', $avata);
                    $info['name']       = $this->input->post('txtName');
                    $info['gt']         = $this->input->post('sltGT');
                    $info['birthday']   = $this->input->post('txtNS');
                    $info['address']    = $this->input->post('txtAddress');
                    $info['number']     = $this->input->post('txtNumber');
                    $info['phone']      = $this->input->post('txtPhone');
                    $info['id']         = $this->input->post('txtID');
                    $info = json_encode($info,JSON_UNESCAPED_UNICODE);
                    $this->user->ChangeInfo($this->session->userdata('userid'),$avata,$info);
                    redirect('../trangchu.html');
                }
    		}
        }
        $this->data['avata'] = $this->session->userdata('avata');
        $this->load->view('template',$this->data);
    }
    
    /**
     * TRANG NẠP TIỀN
     */
    function recharge(){
        $this->data['title'] = 'Nạp tiền';
        $this->data['site'] = 'member/recharge';
        $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => 'Nạp tiền')
                                    );
        $this->load->helper('captcha');
        $history = $this->user->GetHistory($this->session->userdata('userid'));
        $this->data['history'] = json_decode($history,true);
        if($this->input->post('btnOK') != false) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('txtMoney', 'Tiền nạp', 'less_than[10]|greater_than[0]');
            $this->form_validation->set_rules('txtCaptcha', 'Mã xác nhận', 'required');
            if ($this->form_validation->run() == FALSE){
                $this->data['error'] = validation_errors('<li>','</li>');
    		}elseif($this->input->post('txtCaptcha') != $this->session->flashdata('captcha')){
                $this->data['error'] = '<li>Mã xác nhận không chính xác</li>';
    		}else {
                $this->load->helper('date');
                $timestamp = time();
                $timezone = TIME_ZONE;
                $time = gmt_to_local($timestamp, $timezone, TRUE);
                $time = mdate(STYLE_TIME, $time);
                $data['date']   = mdate($datestring, $time);
                $data['ip']     = $this->input->ip_address();
                $data['money']  = $this->input->post('txtMoney');
                array_unshift ($this->data['history'],$data);
                $data = json_encode($this->data['history']);
                $money = $this->session->userdata('property') + $this->input->post('txtMoney');
                $this->user->Recharge($this->session->userdata('userid'), $money, $data);
                $this->session->set_userdata('property', $money);
                redirect('../trangchu.html');
            }
        }
        $md5_hash = md5(rand(0,999)); 
        $security_code = substr($md5_hash, 15, 5);
        $vals = array(
            'word'	     => $security_code,
            'img_path'	 => './images/',
            'img_url'	 => base_url().'images/',
            'font_path'	 => './system/fonts/texb.ttf',
            'img_width'	 => '100',
            'img_height' => 30,
            'expiration' => 7200
            );
        $cap = create_captcha($vals);
        $this->data['img'] = $cap['image'];
        $this->session->set_flashdata('captcha', $vals['word']);
        $this->session->set_flashdata('item', $cap['time']);
        $this->load->view('template',$this->data);
    }
    
    /**
     * TRANG TỦ SÁCH
     */
    function bookcase(){
        $this->data['title'] = 'Tủ sách';
        $this->data['site'] = 'member/bookcase';
        $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => 'Tủ sách')
                                    );
        if($this->session->userdata('bookcase') == false){
            $this->data['error'] = '<li>Bạn hiện đang không mướn cuốn sách nào</li>';
        }else{
            $bookcase = json_decode($this->session->userdata('bookcase'),true);
            $this->load->model('book');
            foreach($bookcase as $val){
                $book = $this->book->SelectBook($val['id']);
                if($book != FALSE){
                    $this->data['data'][] = $book;
                    $this->data['date'][] = $val['date'];
                }
            }
        }
        $this->load->view('template',$this->data);
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
     * TRANG ĐỔI MẬT KHẨU
     */
    function pass(){
        $this->data['title'] = 'Đổi mật khẩu';
        $this->data['site'] = 'member/pass';
        $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => 'Đổi mật khẩu')
                                    );
        $this->load->library('form_validation');
        if($this->input->post('btnChange') != FALSE){
            $this->form_validation->set_rules('txtPass', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('txtRepass', 'Confirm password', 'required|min_length[5]');
            $this->form_validation->set_rules('txtCurrent', 'Current password', 'required|min_length[5]');
            if ($this->form_validation->run() == FALSE){
                $this->data['error'] = validation_errors('<li>','</li>');
    		}elseif($this->_CheckPass($this->input->post('txtPass'),$this->input->post('txtRepass')) == FALSE){
                $this->data['error'] = '<li>Mật khẩu không trùng khớp</li>';
    		}elseif(md5($this->input->post('txtCurrent')) != $this->user->GetPass($this->session->userdata('userid'))){
                $this->data['error'] = '<li>Nhập không đúng mật khẩu hiện tại</li>';
    		}else{
                $this->user->ChangePass($this->session->userdata('userid'),$this->input->post('txtPass'));
                redirect('../trangchu.html');
    		}
        }
        $this->load->view('template',$this->data);
    }
    
    /**
     * TRANG ĐỌC SÁCH
     */
    function read($id){
        $bookcase = json_decode($this->session->userdata('bookcase'),true);
        $this->load->model('book');
        $info = $this->book->InfoBook($id);
        foreach($bookcase as $data) {
            $ids[] = $data['id'];
        }
        if(!in_array($id,$ids) || $info == false) {
            redirect('../trangchu.html');
        }else{
            $this->data['id']   = $id;
            $this->data['info'] = $info;
            $this->load->view('member/read',$this->data);
        }
    }
    
    /**
     * TRANG BÌNH CHỌN
     */
    function rating(){
        $this->load->model('book');
        if($this->input->post('action') == "rating" && $this->input->post('rate') <= 20 && $this->input->post('rate') > 0){
            $this->book->Rating($this->input->post('idBox'), $this->input->post('rate'));
        }
    }
     
    function test(){
    }
}
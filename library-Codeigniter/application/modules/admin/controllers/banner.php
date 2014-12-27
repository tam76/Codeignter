<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Banner extends Define{
    protected $data;
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('banners');
    }
    
    /**
     * TRANG QUẢN LÝ BANNER
     */
    function index($order = 'id', $by = 'DESC', $offset = 0){
        $this->data['menu'] = array('banner_add');
        $not_order      = array('id','title', 'link', 'group', 'time_create', 'username', 'status');
        $this->data['site']   = 'banner/list';
        $order          = $this->security->xss_clean($order);
        $by             = $this->security->xss_clean($by);
        $offset         = $this->security->xss_clean($offset);
        if(!in_array($order , $not_order)){
            $order = 'id';
        }
        if($by != 'DESC' && $by!= 'ASC'){
            $by = 'DESC';
        }
        $this->data['data'] = $this->banners->BannerList($order,$by);
        $this->load->view('template',$this->data);
    }
    
    /**
     * HÀM KIỂM TRA NHÓM
     */
    function _group($data){
        $group = array('slide-main','left-ad','right-ad','block-1','block-2');
        if(in_array($data,$group)){
            return true;
        }
    }
    
    /**
     * HÀM TẠO THUMB ẢNH BANNER
     */
    function _thumb($name, $group){
        $config['image_library']    = IMG_IMG_LIBRARY;
        $config['source_image']	    = './'.BANNER_UPOAD_PATH.$name;
        $config['thumb_marker']     = '';
        $config['quality']          = 100;
        switch($group){
            case "slide-main":
                $config['width']    = SLIDE_WIDTH;
                $config['height']   = SLIDE_HEIGHT;
                $config['maintain_ratio']   = FALSE;
                break;
            case "left-ad":
                $config['width']    = LEFT_AD_WIDTH;
                $config['maintain_ratio']   = TRUE;
                break;
            case "right-ad":
                $config['width']    = RIGHT_AD_WIDTH;
                $config['maintain_ratio']   = TRUE;
                break;
            case "block-1":
                $config['height']   = BLOCK_1_HEIGHT;
                $config['maintain_ratio']   = TRUE;
                break;
            case "block-2":
                $config['height']   = BLOCK_2_HEIGHT;
                $config['maintain_ratio']   = TRUE;
                break;
        }
        
        $this->load->library('image_lib', $config); 
        $this->image_lib->initialize($config); 
        $this->image_lib->resize();
    }
    
    /**
     * HÀM UPLOAD ẢNH BANNER
     */
    function _uploadImg($name, $group){
        $config['upload_path']    = './'.BANNER_UPOAD_PATH;
		$config['allowed_types']  = BANNER_ALLOWED_TYPES;
		$config['file_name']      = $name.'.jpg';
		$config['overwrite']      = TRUE;
		$config['max_size']	      = 2048;
		$config['max_width']      = 1600;
		$config['max_height']     = 1600;
        $this->upload->initialize($config);
		if ( ! $this->upload->do_upload('txtImg')){
            return false;
		}else{
            $this->_thumb($config['file_name'], $group);
            return true;
		}
    }
    
    /**
     * TRANG THÊM BANNER
     */
    function add(){
        $this->load->library(array('form_validation','upload'));
        $this->load->helper('seourl');
        $this->data['menu'] = array('banner_list');
        $this->data['site'] = 'banner/add';
        $this->data['group'] = array('slide-main','left-ad','right-ad','block-1','block-2');
        if($this->input->post('btnBannerAdd')){
            $this->form_validation->set_rules('txtTitle', 'Tiêu đề', 'required|min_length[5]|max_length[50]');
            $this->form_validation->set_rules('rdoPublic', 'Trạng thái', 'numeric');
            if ($this->form_validation->run() == FALSE){
                $this->data['error'] = validation_errors('<li>','</li>');
    		}elseif($this->_group($this->input->post('sltCate')) == FALSE){
                $this->data['error'] = '<p>Vui lòng chọn group</p>';
    		}else{
                $name = unicode($this->input->post('txtTitle')).'_'.time();
                if($this->_uploadImg($name, $this->input->post('sltCate')) == false){
                    $this->data['error'] = $this->upload->display_errors();
                }else{
                    $this->load->helper('date');
                    $time       = gmt_to_local(time(), TIME_ZONE, TRUE);
                    $time       = mdate(STYLE_TIME, $time);
                    $banner_img = $name.'.jpg';
                    $this->banners->BannerAdd($this->input->post('txtTitle'), $banner_img,$this->input->post('sltCate'),$time,$this->session->userdata('userid'),$this->input->post('rdoPublic'));
                    redirect('admin/banner');
                }
                
    		}
        }
        $this->load->view('template',$this->data);
    }
    
    /**
     * TRANG SỬA BANNER
     */
    function edit($id){
        $id = $this->security->xss_clean($id);
        $this->data['data'] = $this->banners->InfoBanner($id);
        if($this->data['data'] == false){
            redirect('admin/banner');
        }
        $this->load->helper('seourl');
        $this->data['menu'] = array('banner_list');
        $this->data['site'] = 'banner/edit';
        $this->load->library(array('form_validation','upload'));
        $this->load->helper('seourl');
        $this->data['group'] = array('slide-main','left-ad','right-ad','block-1','block-2');
        if($this->input->post('btnBannerEdit')){
            $this->form_validation->set_rules('txtTitle', 'Tiêu đề', 'required|min_length[5]|max_length[50]');
            $this->form_validation->set_rules('rdoPublic', 'Trạng thái', 'numeric');
            if ($this->form_validation->run() == FALSE){
                $this->data['error'] = validation_errors('<li>','</li>');
    		}elseif($this->_group($this->input->post('sltCate')) == FALSE){
                $this->data['error'] = '<p>Vui lòng chọn group</p>';
    		}else{
                $name = unicode($this->input->post('txtTitle')).'_'.time();
                if(isset($_FILES['txtImg']['name']) && $this->_uploadImg($name, $this->input->post('sltCate')) == false){
                    $this->data['error'] = $this->upload->display_errors('<li>','</li>');
                }else {
                    if(!empty($_FILES['txtImg']['name'])){
                        $banner_img = $name.'.jpg';
                        unlink(BANNER_UPOAD_PATH.$this->data['data']['link']);
                    }else{
                        $banner_img = $this->data['data']['link'];
                    }
                    $data = array(
                                'title' => $this->input->post('txtTitle'),
                                'link'  => $banner_img,
                                'group' => $this->input->post('sltCate'),
                                'status'=> $this->input->post('rdoPublic')
                            );
                    $this->banners->Edit($id,$data);
                    redirect('admin/banner');
                }
    		}
        }
        $this->load->view('template',$this->data);
    }
    
    /**
     * TRANG XÓA BANNER
     */
    function del($id){
        $id = $this->security->xss_clean($id);
        $link = $this->banners->GetInfo($id,'link');
        unlink(BANNER_UPOAD_PATH.$link['link']);
        $this->banners->DelBanner($id);
        redirect('admin/banner');
    }
}
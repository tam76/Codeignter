<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cate extends Define{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('category');
    }
    
    /**
     * TRANG QUẢN LÝ DANH MỤC
     */
    function index($order = 'cateid', $by = 'DESC', $offset = 0){
        $this->load->model('book');
        $data['menu'] = array('cate_add');
        $not_order = array('cateid','cate_title');
        $this->load->library('pagination'); 
        $data['site'] = 'cate/list';
        $order = $this->security->xss_clean($order);
        $by = $this->security->xss_clean($by);
        $offset = $this->security->xss_clean($offset);
        if(!in_array($order , $not_order)){
            $order = 'cateid';
        }
        if($by != 'DESC' && $by!= 'ASC'){
            $by = 'DESC';
        }
        $config['base_url'] = base_url('index.php/admin/cate/index/'.$order.'/'.$by); // xác d?nh trang phân trang 
        $config['total_rows'] = $this->category->CountCate(); // xác d?nh t?ng s? record 
        $config['per_page'] = CATE_LIMIT; // xác d?nh s? record ? m?i trang 
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 6; // xác d?nh segment ch?a page number 
        $config['first_link'] = 'Ðầu';
        $config['cur_tag_open'] = '<span class="current_page">';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config); 
        if($offset > 0){
            $offset = ($offset * $config['per_page']) - $config['per_page'];
        }
        $data['data'] = $this->category->CateList($config['per_page'],$offset,$order,$by); 
        $this->load->view('template',$data);
    }
    
    /**
     * TRANG THÊM DANH MỤC
     */
    function add() {
        $data['site'] = 'cate/add';
        $data['menu'] = array('cate_list');
        $this->load->library('form_validation');
        if($this->input->post('btnCateAdd')){
            $this->form_validation->set_rules('txtCate', 'Danh mục', 'required|is_unique[category.cate_title]|min_length[5]');
            $this->form_validation->set_rules('txttag[]', 'Từ khóa', 'min_length[1]');
            if ($this->form_validation->run() == FALSE){
                $data['data']['tag'] = $this->input->post('txttag');
    			$this->load->view('template',$data);
    		}
    		else{
    			if($this->input->post('txttag')){
                    $tag =json_encode($this->input->post('txttag'),JSON_UNESCAPED_UNICODE);
                }else{
                    $tag = '';
                }
                $this->category->AddCate($this->input->post('txtCate'),$tag);
                redirect('admin/cate');
    		}
        }else {
            $this->load->view('template',$data);
        }
    }
    
    /**
     * TRANG SỬA DANH MỤC
     */
    function edit($id) {
        $id = $this->security->xss_clean($id);
        $data['site'] = 'cate/edit';
        $data['menu'] = array('cate_list');
        $this->load->library('form_validation');
        $info = $this->category->InfoCate($id);
        if(is_numeric($id) && $info != false){
            if($this->input->post('btnCateEdit')){
                $this->form_validation->set_rules('txtCate', 'Danh mục', 'required|min_length[5]');
                $this->form_validation->set_rules('txttag[]', 'Từ khóa', 'min_length[1]');
                if ($this->form_validation->run() == FALSE){
                    $data['cate_title'] = $this->input->post('txtCate');
                    $data['tag'] = $this->input->post('txttag');
        			$this->load->view('template',$data);
        		}
        		else{
        			if($this->input->post('txttag')){
                        $tag =json_encode($this->input->post('txttag'),JSON_UNESCAPED_UNICODE);
                    }else{
                        $tag = '';
                    }
                    $this->category->EditCate($id,$this->input->post('txtCate'),$tag);
                    redirect('admin/cate');
        		}
            }else {
                $data['cate_title'] = $info['cate_title'];
                $data['tag'] = json_decode($info['tag']);
                $this->load->view('template',$data);
            }
        }else{
            redirect('admin/cate');
        }
    }
    
    
    /**
     * TRANG XÓA DANH MỤC
     */
    function del($id) {
        $id = $this->security->xss_clean($id);
        $this->load->model('book');
        $this->category->DelCate($id);
        if($this->book->BookOfCate($id)>0){
            $this->book->ChangeCate($id);
        }
        redirect('admin/cate');
    }
}
?>
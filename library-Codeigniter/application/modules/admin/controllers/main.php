<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Main extends Define{
    protected $data;
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user');
    }
    
    /**
     * TRANG QUẢN LÝ ADMIN
     */
    function index(){
        $data['site'] = 'main/main';
        $info = array();
        $info['user'] = $this->user->CountUser();
        $this->load->model('book');
        $info['book'] = $this->book->CountBook();
        $this->load->model('category');
        $info['category'] = $this->category->CountCate();
        $data['info'] = $info;
        $data['menu'] = array('user_list','cate_list','book_list');
        $this->load->view('template',$data);
    }
    
    /**
     * HÀM KIỂM TRA THỜI HẠN SÁCH TRONG TỦ SÁCH
     */
    function _checkBookCase(){
        $bookcase = json_decode($this->session->userdata('bookcase'),true);
        foreach($bookcase as $key => $data) {
            if($data['date'] < time()){
                unset($bookcase[$key]);
            }
        }
        $bookcase = array_values ($bookcase);
        $this->session->set_userdata('bookcase', json_encode($bookcase));
    }
    
    /**
     * TRANG ĐĂNG NHẬP
     */
    function login(){
        $data['site'] = 'main/login';
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        if($this->input->post('btnLogin')){
            $this->form_validation->set_rules('txtUser', 'Username', 'required|alpha_dash|min_length[5]|xss_clean');
            $this->form_validation->set_rules('txtPass', 'Password', 'required|xss_clean');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('template',$data);
    		}elseif(!$this->user->Checklogin($this->input->post('txtUser'),$this->input->post('txtPass'))){
                $data['error']='Tên tài khoản không tồn tại';
                $this->load->view('template',$data);
    		}else{
                $this->_checkBookCase();
                $this->user->CheckBookCase($this->session->userdata('userid'),$this->session->userdata('bookcase'));
                redirect('admin/main');
            }
        }else{
            $this->load->view('template',$data);
        }
    }
    
    /**
     * TRANG ĐĂNG XUẤT
     */
    function logout(){
        $this->session->sess_destroy();
        redirect('admin/main/login');
    }
}

?>
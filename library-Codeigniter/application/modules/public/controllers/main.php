<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Main extends Define{
    protected $data;
    function __construct(){
        parent::__construct();
        $this->load->helper(array('url','seourl'));
        $this->load->library('xml');
        $this->load->model(array('category','banners'));
        $this->data['cate_menu'] = $this->category->SelectCate();
        $this->data['banner'] = $this->banners->GetBanner();
	}
    
    /**
     * TRANG CHỦ *
    **/
    function index(){
        $this->data['title'] = 'Trang chủ';
        $this->data['site'] = 'main/index';
        $this->data['data'] = $this->xml->ReadXML('home');
        $this->load->view('template',$this->data);
    }
    
    /**
     * HÀM KIỂM TRA THỜI HẠN SÁCH TRONG TỦ SÁCH
     */
    function _checkBookCase(){
        if($this->session->userdata('bookcase')!= false){
            $bookcase = json_decode($this->session->userdata('bookcase'),true);
            foreach($bookcase as $key => $data) {
                if($data['date'] < time()){
                    $this->book->SubtractViews($data['id']);
                    unset($bookcase[$key]);
                }
            }
            $bookcase = array_values ($bookcase);
            $this->session->set_userdata('bookcase', json_encode($bookcase));
        }
    }
    
    /**
     * TRANG ĐĂNG NHẬP
     */
    function login(){
        sleep(1);
        if (empty($_POST["user"]) || empty($_POST["pass"])) {
            echo 'Miss';
        } else {
            $this->load->model(array('user','book'));
            $user = $_POST["user"];
            $pass = $_POST["pass"];
            if(!$this->user->Checklogin($user, $pass)) {
                echo 'Wrong';
            }else {
                $this->_checkBookCase();
                $this->user->CheckBookCase($this->session->userdata('userid'),$this->session->userdata('bookcase'));
                echo '
                <div class="dropdown clearfix" style="margin-bottom: 10px;">
                  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                    <img src="'.base_url(AVATA_UPOAD_PATH.'thumb/'.$this->session->userdata('avata')).'" alt="avata" class="img-thumbnail"/>&nbsp;<b>'.$this->session->userdata('username').'</b>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: relative;">
                    <li role="presentation"><a role="menuitem" class="" tabindex="-1" href="changepass.html"><span class="glyphicon glyphicon-edit">&nbsp;</span>Đổi mật khẩu</a></li>
                      <li class="divider"></li>
                    <li role="presentation"><a role="menuitem" class="" tabindex="-1" href="thongtin.html"><span class="glyphicon glyphicon-info-sign">&nbsp;</span>Thông tin</a></li>
                      <li class="divider"></li>
                    <li role="presentation"><a role="menuitem" class="" tabindex="-1" href="giohang.html"><span class="glyphicon glyphicon-shopping-cart">&nbsp;</span>Giỏ hàng</a></li>
                      <li class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="naptien.html"><span class="glyphicon glyphicon-usd">&nbsp;</span>Nạp Tiền</a></li>
                      <li class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="tusach.html"><span class="glyphicon glyphicon-book">&nbsp;</span>Tủ sách</a></li>
                      <li class="divider"></li>';
                    if($this->session->userdata('level') < 3){
                        echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="'.site_url("admin/main").'"><span class="glyphicon glyphicon-briefcase">&nbsp;</span>Quản trị</a></li>
                                <li class="divider"></li>';
                    }
                    echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="#" title="logout"><span class="glyphicon glyphicon-log-out">&nbsp;</span>Đăng xuất</a></li>
                  </ul>
                </div>';
            }
        }
    }
    
    /**
     * TRANG ĐĂNG XUẤT
     */
    function logout(){
        $this->session->sess_destroy();
        echo 'Finish';
    }
    
    /**
     * TRANG TÌM KIẾM
     */
    function search(){
        $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => 'Tìm kiếm')
                                    );
        $this->data['title'] = 'Tìm kiếm';
        $this->data['site'] = 'main/search';
        if($this->input->post('txtSearch') != false) {
            $text = $this->input->post('txtSearch');
            $this->load->model('book');
            $data = $this->book->SearchBook($text);
            if($data == false) {
                $this->data['error'] = 'Cuốn sách bạn tìm kiếm không tồn tại</li>';
            }else{
                $this->data['data'] = $data;
            }
        }
        $this->load->view('template',$this->data);
    }
    
    /**
     * TRANG GIỚI THIỆU
     */
    function intro(){
        $this->data['title'] = 'Giới thiệu';
        $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => 'Giới thiệu')
                                    );
        $this->data['site'] = 'main/intro';
        $this->load->view('template',$this->data);
    }
    
    /**
     * TRANG DANH MỤC
     */
    function category($id,$page = 1){
        $this->data['site'] = 'main/category';
        $id = $this->security->xss_clean($id);
        $this->load->library('pagingxml');
        $xml = $this->category->SelectTitle($id);
        $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => $xml)
                                    );
        if($xml != false){
            $this->data['title'] = $xml;
            $this->data['data'] = $this->xml->ReadXML($xml,$page-1);
            if(!$this->data['data'] && $page==1){
                $this->data['error'] = 'Danh mục hiện tại chưa có sách';
            }
            $total_page = $this->xml->GetTotal_Page();
            $this->pagingxml->renderNavBar(3, 'danhmuc/' .$id. '-' .unicode($xml), null, $total_page, $page);
            $this->data['paging'] = $this->pagingxml->getNavBar();
        }
        $this->load->view('template',$this->data);
    }
    
    /**
     * DANH SÁCH TRANG CHỦ
     */
    function list_main(){
        $data = $this->xml->ReadXML($_POST["type"]);
        if(!$data){
            echo 'Miss';
        }else{
            echo '<div id="cover">';
                foreach ($data as $bookitem) {
                    // Nếu những tin nằm trong đoạn cần show thì mới show
                    $id = $bookitem[0]['id'];
                    $cid = $bookitem[0]['cid'];
                    $cate_title = $this->category->SelectTitle($cid);
                    $title = $bookitem->TITLE[0];
                    $img = $bookitem->IMG[0];
                    $gia = $bookitem->COST;
                    $data = array('id'=> "$id","cid"=>"$cid");
                    $json = json_encode($data);
                    if(strlen($title)>30){
                        $title = substr($title,0,30);
                        $title = substr($title,0,strrpos($title,' '))." ...";
                    }
                    echo '
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                        <div class="news">
                            <h1>'.$title.'</h1>
                            <div class="pic pic-3d">
                        	    <img src="'.base_url(IMG_UPOAD_PATH .$img). '" class="pic-image" alt="Pic"/>
                        	    <span class="pic-caption open-up">
                                    <span class="button_new">
                                        <a href="'.$cid.'-'.unicode($cate_title).'/'.$id.'-'.unicode($bookitem->TITLE).'.html" class="btn btn-success">Chi tiết</a>
                                        <input type="hidden" class="info" value=\''.$json.'\' />
                                        <button type="submit" class="btn btn-success addbook">Thêm vào giỏ hàng</button>
                                    </span>
                        	    </span>
                            </div>
                            <div class="exemple4" data-average="'.$bookitem->SCORE.'" ></div>
                            <label class ="form_label">';
                            if($gia==0) {
                                echo "miễn phí";
                            } else {
                                echo $gia.'.000 Đ/tuần';
                            }echo
                            '</label>
                            <div class="clearfix"></div>
                        </div>
                	</div>';
                }
                echo '
                <script type="text/javascript">
                	$(document).ready(function(){
                		$(".exemple4").jRating({
                    	  isDisabled : true
                    	});
                	});
                </script></div>';
        }
    }
    
    /**
     * HÀM KIỂM TRA ID SÁCH CÓ TRONG LIST ĐẶC BIỆT
     */
    function _checkBook($id){
        if($this->session->userdata('bookcase') != false){
            $bookcase = json_decode($this->session->userdata('bookcase'));
            foreach($bookcase as $val){
                if($val->id == $id){
                    return true;
                    break;
                }
            }
        }
        return false;
    }
    
    /**
     * TRANG CHI TIẾT
     */
    function detail($cate,$id){
        $this->data['site'] = 'main/detail';
        $this->load->model('book');
        $this->data['error'] = '';
        $this->data['link'] = $this->_checkBook($id);
        if(is_numeric($cate) && is_numeric($id)) {
            $xml = $this->category->SelectTitle($cate);
            if($xml != false){
                $result = $this->xml->Selectbook($xml, $id);
                if($result != false){
                    $this->data['title'] = $result->TITLE;
                    $this->data['data'] = $result;
                    $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => $xml, 'link' => 'danhmuc/'.$cate.'-'.unicode($xml).'.html'),
                                        array('title' => $this->data['title'])
                                    );
                }else{
                    $this->data['error'] = 'Cuốn sách này không tồn tại';
                }
            }
        }else{
            $this->data['error'] = 'Cuốn sách này không tồn tại';
        }
        $this->load->view('template',$this->data);
        
    }
    
    /**
     * TRANG GIỎ HÀNG
     */
    function cart(){
        $this->data['title'] = 'Giỏ hàng';
        $this->data['site'] = 'main/cart';
        $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => 'Giỏ hàng')
                                    );
        $this->data['error'] = '';
        if($this->input->post('btnbuy') != false) {
            $book = $this->input->post('book');
            $this->data['tg'] = $book['txttg'];
            if($this->session->userdata('userid') == false) {
                $this->data['error'] .= '<li>Vui lòng đăng nhập trước khi mua sách</li>';
            }else {
                $array = '';
                $list=array();
                if($this->session->userdata('bookcase') != false) {
                    $bookcase = json_decode($this->session->userdata('bookcase'));
                    foreach($bookcase as $key => $data) {
                        $list[]=$data->id;
                    }
                }
                $sum = 0;
                foreach($book['txttg'] as $key => $val) {
                    if($val <= 9 && $val > 0) {
                        $id = json_decode($book["id"][$key]);
                        $xml = $this->category->SelectTitle($id->cid);
                        $result = $this->xml->Selectbook($xml, $id->id);
                        if($xml != false && $result != false){
                            $title = $result->TITLE;
                            $gia = $result->COST;
                        }else{
                            $this->data['error'] .= '<li>Có cuốn sách không tồn tại</li>';
                            break;
                        }
                        if(in_array($id->id,$list)){
                            $this->data['error'] .= '<li>Bạn đã mượn trùng cuốn '.$title.'</li>';
                            break;
                        }else {
                            $sum    = $sum + ($gia * $val) ;
                            $item   = array('id'=>$id->id,"date"=>time()+($val*604800));
                            $array[] = $item;
                        }
                    }else{
                        $this->data['error'] .= '<li>Sách đăng kí mượn không quá 9 tuần</li>';
                        break;
                    }
                }
                if($sum > $this->session->userdata('property')) {
                    $this->data['error'] .= '<li>Bạn không đủ tiền trong tài khoản</li>';
                }elseif (!empty($array) && empty($this->data['error'])) {
                    $this->load->model(array('user','book'));
                    if($this->session->userdata('bookcase') == false){
                        $addbook = json_encode($array);
                    }else{
                        $addbook = array_merge($bookcase,$array);
                        $addbook = json_encode($addbook);
                    }
                    foreach($array as $val){
                        $this->book->AddViews($val['id']);
                    }
                    $this->session->set_userdata('bookcase', $addbook);
                    $money = $this->session->userdata('property') - $sum;
                    $this->session->set_userdata('property', $money);
                    if($this->user->BuyBook($this->session->userdata('userid'), $addbook, $money)) {
                        $this->session->unset_userdata('cart');
                    }
                    
                }
            }
        }
        if($this->session->userdata('cart') == false) {
            $cart = '';
        }else {
            $cart = $this->session->userdata('cart');
        }
        if($this->input->post("newid") != false) {
            if($this->session->userdata('cart') == false) {
                $cart = array();
            }else {
                $cart = $this->session->userdata('cart');
            }
            if(!in_array($this->input->post("newid"),$cart)) {
                $array = json_decode($this->input->post("newid"));
                if(is_numeric($array->cid) && is_numeric($array->id)) {
                    $xml = $this->category->SelectTitle($array->cid);
                    if($xml != false){
                        $result = $this->xml->Selectbook($xml, $array->id);
                        if($result != false){
                            $cart[] = $this->input->post("newid");
                            $this->session->set_userdata('cart', $cart);
                            echo count($cart);
                        }
                    }
                }
            }
        }
        if ($this->input->post("keys") != false && in_array($this->input->post("keys"),$cart)) {
            $key = array_search ($this->input->post("keys"),$cart);
            unset($cart[$key]);
            $this->session->set_userdata('cart', $cart);
            echo count($cart);
        }
        if(!empty($cart)){
            foreach($cart as $val){
                $data = json_decode($val);
                $xml = $this->category->SelectTitle($data->cid);
                if($xml != false){
                    $result = $this->xml->Selectbook($xml, $data->id);
                    if($result != false){
                        $this->data['cart'][$val] = $result;
                    }
                }
            }
        }
        if(empty($this->data['cart'])){
            $this->data['error'] .= '<li>Giỏ hàng đang trống</li>';
        }
        if(!$this->input->post('newid') && !$this->input->post("keys")){
            $this->load->view('template',$this->data);
        }
    }
    
    /**
     * HÀM KIỂM TRA PASSWORD TRÙNG KHỚP
     */
    function _CheckPass($pass, $rePass){
        if($pass != $rePass){
            return false;
        }else{
            return true;
        }
    }
    
    /**
     * TRANG ĐĂNG KÍ
     */
    function registration(){
        $this->data['title'] = 'Đăng kí';
        $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => 'Đăng kí')
                                    );
        if($this->session->userdata('userid') == false){
            $this->load->helper('captcha');
            $this->data['site'] = 'main/register';
            $this->load->library('form_validation');
            if($this->input->post('btnUserAdd') != false){
                $this->form_validation->set_rules('txtUser', 'Username', 'required|min_length[5]|max_length[20]|alpha_dash|is_unique[user.username]');
                $this->form_validation->set_rules('txtPass', 'Password', 'required|min_length[5]');
                $this->form_validation->set_rules('txtRepass', 'Confirm password', 'required|min_length[5]');
                $this->form_validation->set_rules('txtEmail', 'Email', 'required|min_length[5]|valid_email|is_unique[user.email]');
                $this->form_validation->set_rules('txtCaptcha', 'Mã xác nhận', 'required');
                if ($this->form_validation->run() == FALSE){
                    $this->data['error'] = validation_errors('<li>','</li>');
        		}elseif($this->_CheckPass($this->input->post('txtPass'),$this->input->post('txtRepass')) == FALSE){
                    $this->data['error'] = '<li>Mật khẩu không trùng khớp</li>';
        		}elseif($this->input->post('txtCaptcha') != $this->session->flashdata('captcha')){
                    $this->data['error'] = '<li>Mã xác nhận không chính xác</li>';
        		}else{
                    $this->load->helper('date');
                    $this->load->model('user');
                    $timestamp = time();
                    $timezone = TIME_ZONE;
                    $time = gmt_to_local($timestamp, $timezone, TRUE);
                    $time = mdate(STYLE_TIME, $time);
                    $info['name']       = '';
                    $info['gt']         = '';
                    $info['birthday']   = '';
                    $info['address']    = '';
                    $info['number']     = '';
                    $info['phone']      = '';
                    $info['id']         = '';
                    $info = json_encode($info,JSON_UNESCAPED_UNICODE);
                    
                    $data = array(
                       'username'       => $this->input->post('txtUser') ,
                       'password'       => md5($this->input->post('txtPass')) ,
                       'email'          => $this->input->post('txtEmail'),
                       'avata'          => 'default.jpg' ,
                       'level'          => 3 ,
                       'info'           => $info,
                       'register_date'  => $time,
                       'register_ip'    => $this->input->ip_address() ,
                       'active_code'    => md5(time()),
                       'status'         => '2'
                    );
                    
                    if($this->user->AddUser($data)){
                    
                        $userid     = mysql_insert_id();
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
                        $this->my_email->sendmail();
                    }
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
        }else{
            redirect('../trangchu.html');
        }
    }
    
    /**
     * TRANG QUÊN MẬT KHẨU
     */
    function fg_password(){
        $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => 'Quên mật khẩu')
                                    );
        $this->data['title'] = 'Quên mật khẩu';
        $this->load->model('user');
        $this->load->helper('captcha');
        $this->load->library('form_validation');
        
        //--- Neu Login thi khong duoc vao trang nay
        if($this->session->userdata('userid') != false){
            redirect('../trangchu.html');
        }
        
        $md5_hash = md5(rand(0,999)); 
        $security_code = substr($md5_hash, 15, 5);
        $this->data['site'] = 'main/FGPass';

        $this->form_validation->set_rules("txtEmail","Email","required|valid_email|callback_checkEmailForgot");
        $data['error'] = "";
        
        if($this->form_validation->run()==FALSE){
            $this->data['error'] = validation_errors('<li>','</li>');
            
        }elseif($this->input->post('txtCaptcha') != $this->session->flashdata('captcha')){
            $this->data['error'] = '<li>Mã xác nhận không chính xác</li>';
		}else{
            $email = $this->input->post("txtEmail");
            $info = $this->user->getInfoByEmail($email);

            $message = "";
            if($info['status']==1){

                // reset password cho user
                $password = $security_code;
                $reset = array(
                                "password" => md5($password),
                            );
                $this->user->UpDate($reset,$info['userid']);
                
                //--- Gui mail cho user
                $message  = "Please login with :<br/>";
                $message .= "username :".$info['username']."<br/>";
                $message .= "password:".$password;
                
                $mail = array(
                            "to_receiver"   => $email,
                            "message"       => $message,
                        );

                $this->load->library("my_email");
                $this->my_email->config($mail);
                $this->my_email->sendmail();
                redirect('../trangchu.html');
                
             }else{
                 $this->data['error'] = "You hasn't been actived your account, please check your email again !";
             }
             
             
        }
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
     * TRANG LIÊN HỆ
     */
    function contact(){
        $this->data['breadcrumbs']  = array(
                                        array('title' => 'Trang chủ', 'link' => 'trangchu.html'),
                                        array('title' => 'Liên hệ')
                                    );
        $this->data['title'] = 'Liên hệ';
        $this->load->helper('captcha');
        $this->load->library('form_validation');
        if($this->input->post('btnOk') != false){
            $this->form_validation->set_rules('title', 'Tiêu đề', 'required|min_length[5]|max_length[20]');
            $this->form_validation->set_rules('name', 'Họ và tên', 'required|min_length[5]');
            $this->form_validation->set_rules('txtphone', 'Số điện thoại', 'required|min_length[7]|numeric');
            $this->form_validation->set_rules('txtemail', 'Email', 'required|min_length[5]|valid_email');
            $this->form_validation->set_rules('txtCaptcha', 'Mã xác nhận', 'required|exact_length[5]');
            if ($this->form_validation->run() == FALSE){
                $this->data['error'] = validation_errors('<li>','</li>');
    		}elseif($this->input->post('txtCaptcha') != $this->session->flashdata('captcha')){
                $this->data['error'] = '<li>Mã xác nhận không chính xác</li>';
    		}else{
                $message    = "Bạn nhận được một thư liên hệ từ :".$this->input->post('name')."<br/>";
                $message   .= "Thư liên hệ có chủ đề :".$this->input->post('title')."<br/>";
                $message   .= "Email : ".$this->input->post('txtemail')."<br/>";
                $message   .= "Điện thoại : ".$this->input->post('txtphone')."<br/>";
                $message   .= "Nội dung : ".$this->input->post('txtContent');
                
                $mail = array(
                        "to_receiver"   => 'tam.pro76@gmail.com', 
                        "message"       => $message,
                    );
                    
                $this->load->library("my_email");
                $this->my_email->config($mail);
                $this->my_email->sendmail();
                redirect('../trangchu.html');
    		}
        }
        $md5_hash = md5(rand(0,999)); 
        $security_code = substr($md5_hash, 15, 5);
        $this->data['site'] = 'main/contact';
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
    
    
    function active(){
        $this->load->model('user');
        
        //--- Neu Login thi khong active
        if($this->session->userdata('userid') != false){
            redirect('../trangchu.html');
        }
        
        $userid = $_GET['userid'];
        $key = $_GET['key'];
        $data = array();
        
        
        if(is_numeric($userid)){
            
            $check = $this->user->checkActive($userid,$key);

            if($check){
                
                if($check['status']==1){
                    
                }
                else{
                    
                    $this->user->ChangeStt('active',$userid);
                }
            
            }
            else{
                
            }
            
        }else{
            
        }
        
    }
}
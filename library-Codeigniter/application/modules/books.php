<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Books extends Define{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('book');
    }
    function index($order = 'bookid', $by = 'DESC', $offset = 0){
        $data['menu']   = array('book_add');
        $not_order      = array('bookid','cate_title','book_title','author','publisher','book_date', 'score','book_public');
        $this->load->library('pagination'); 
        $data['site']   = 'book/list';
        $order          = $this->security->xss_clean($order);
        $by             = $this->security->xss_clean($by);
        $offset         = $this->security->xss_clean($offset);
        if(!in_array($order , $not_order)){
            $order = 'bookid';
        }
        if($by != 'DESC' && $by!= 'ASC'){
            $by = 'DESC';
        }
        $config['base_url']         = base_url('index.php/admin/books/index/'.$order.'/'.$by); // xác d?nh trang phân trang 
        $config['total_rows']       = $this->book->Countbook(); // xác d?nh t?ng s? record 
        $config['per_page']         = BOOK_LIMIT; // xác d?nh s? record ? m?i trang 
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment']      = 6; // xác d?nh segment ch?a page number 
        $config['first_link']       = 'Ðầu';
        $config['last_link']        = 'Cuối';
        $config['cur_tag_open']     = '<span class="current_page">';
        $config['cur_tag_close']    = '</span>';
        $this->pagination->initialize($config); 
        if($offset > 0){
            $offset = ($offset * $config['per_page']) - $config['per_page'];
        }
        $data['data'] = $this->book->BookList($config['per_page'],$offset,$order,$by);
        $this->load->view('template',$data);
    }
    function active($change, $id){
        $this->load->library('xml');
        $change =  $this->security->xss_clean($change);
        $id     = $this->security->xss_clean($id);
        $data   = $this->book->GetLink($id);
        $xml['bookid']      = $id;
        $xml['cateid']      = $data['cateid'];
        $xml['limit']       = DEFAULT_LIMIT;
        $xml['home_limit']  = HOME_LIMIT;
        $this->xml->initialize($xml);
        if($this->xml->Checkid() == true){
            $this->xml->HomeXML();
        }
        $this->book->ChangePublic($change,$id);
        if($this->xml->Checkid() == true){
            $this->xml->HomeXML();
        }
        $this->xml->CateXML();
        redirect('admin/books');
    }
    function info ($id){
        $id = $this->security->xss_clean($id);
        $data['data'] = $this->book->InfoBook($id);
        if(is_numeric($id) && $data['data'] != false){
            $data['menu'] = array('book_list','book_add');
            $data['site'] = 'book/info';
            $data['book_tag'] = json_decode($data['data']['book_tag']);
            $this->load->view('template',$data);
        }else{
            redirect('admin/books');
        }
    }
    function key(){
        if(isset($_POST['cateid']) && is_numeric($_POST['cateid'])){
            $this->load->model('category');
            $tag = $this->category->SelectKey($_POST['cateid']);
            $tag = json_decode($tag['tag']);
            foreach($tag as $val) {
                $key .= '<option value="' . $val . '">' . $val . '</option>';
            }
            echo $key;
        }
    }
    function _thumb($name){
        $config = array();
        $config['image_library']    = IMG_IMG_LIBRARY;
        $config['source_image']	    = './'.IMG_UPOAD_PATH.$name;
        $config['thumb_marker']     = '';
        $config['maintain_ratio']   = FALSE;
        $config['quality']          = IMG_QUALITY;
        $config['width']	        = IMG_WIDTH;
        $config['height']	        = IMG_HEIGHT;
        
        $this->load->library('image_lib', $config); 
        $this->image_lib->initialize($config); 
        $this->image_lib->resize();
    }
    function _uploadImg($name){
        $config['file_name'] = 'default.jpg';
        if(!empty($_FILES['txtImg']['name'])){
            $config['upload_path']    = './'.IMG_UPOAD_PATH;
    		$config['allowed_types']  = IMG_ALLOWED_TYPES;
    		$config['file_name']      = $name.'.jpg';
    		$config['overwrite']      = TRUE;
    		$config['max_size']	      = IMG_MAX_SIZE;
    		$config['max_width']      = IMG_MAX_WIDTH;
    		$config['max_height']     = IMG_MAX_HEIGHT;
            $this->upload->initialize($config);
    		if ( ! $this->upload->do_upload('txtImg')){
                return false;
    		}else{
                $this->_thumb($config['file_name']);
                return true;
    		}
        }else {
            return true;
        }
    }
    function _uploadBook($name){
        $config['upload_path']    = './'.BOOK_UPOAD_PATH;
		$config['allowed_types']  = BOOK_ALLOWED_TYPES;
		$config['file_name']      = $name.'.pdf';
		$config['overwrite']      = FALSE;
		$config['max_size']	      = BOOK_MAX_SIZE;
        $this->upload->initialize($config);
		if ( ! $this->upload->do_upload('txtUrl')){
            return false;
		}else{
            return $config['file_name'];
		}
    }
    function add(){
        $this->load->model('category');
        $this->load->library(array('form_validation','upload','xml'));
        $this->load->helper('seourl');
        $data['menu'] = array('book_list');
        $data['site'] = 'book/add';
        $data['cate'] = '';
        foreach($this->category->SelectCate() as $val) {
            $data['cate'] .= '<option value="' . $val['cateid'] . '" ';
                if($this->input->post('sltCate') == $val['cateid']){
                    $data['cate'] .= ' selected="selected"';
                }
            $data['cate'] .=  '>' . $val['cate_title'] . '</option>';
        }
        if($this->input->post('btnBookAdd')){
            $this->form_validation->set_rules('txtTitle', 'Tiêu đề', 'required|min_length[5]|max_length[50]|is_unique[books.book_title]');
            $this->form_validation->set_rules('txtAuthor', 'Tác giả', 'min_length[3]|max_length[50]');
            $this->form_validation->set_rules('txtPublisher', 'Nhà xuất bản', 'min_length[3]|max_length[50]');
            $this->form_validation->set_rules('txtCost', 'Giá sách', 'numeric');
            $this->form_validation->set_rules('sltDate', 'Năm xuất bản', 'numeric');
            $this->form_validation->set_rules('txtDescription', 'Mô tả', 'min_length[5]');
            if ($this->form_validation->run() == FALSE){
                $data['error'] = validation_errors();
    			$this->load->view('template',$data);
    		}else{
                $name = unicode($this->input->post('txtTitle')).'_'.time();
                if($this->_uploadImg($name) == false){
                    $data['error'] = $this->upload->display_errors();
                    $this->load->view('template',$data);
                }elseif($this->_uploadBook($name) == false){
                    $data['error'] = $this->upload->display_errors();
                    $this->load->view('template',$data);
                    if(!empty($_FILES['txtImg']['name'])){
                        unlink(IMG_UPOAD_PATH.$name.'.jpg');
                    }
                }else{
                    if($this->input->post('sltKey') == ''){
                        $book_tag = '';
                    }else{
                        $book_tag = json_encode($this->input->post('sltKey'));
                    }
                    if(!empty($_FILES['txtImg']['name'])){
                        $book_img = $name.'.jpg';
                    }else{
                        $book_img = 'default.jpg';
                    }
                    $book_url = $name.'.swf';
                    exec('C:\xampp\htdocs\library-2\tool\pdf2swf.exe '.BOOK_UPOAD_PATH.$name.'.pdf -o '.BOOK_UPOAD_PATH.$book_url.' -f -T 9 -t -s  storeallcharacters');
                    unlink(BOOK_UPOAD_PATH.$name.'.pdf');
                    $this->book->AddBook($this->input->post('txtTitle'), $book_url,$this->input->post('txtCost'),$book_img,$this->input->post('txtAuthor'),$this->input->post('txtPublisher'),$this->input->post('sltDate'),$book_tag,$this->input->post('txtDescription'),$this->input->post('rdoPublic'),$this->input->post('sltCate'),$this->session->userdata('userid'));
                    $xml['cateid']      = $this->input->post('sltCate');
                    $xml['limit']       = DEFAULT_LIMIT;
                    $xml['home_limit']  = HOME_LIMIT;
                    $this->xml->initialize($xml);
                    $this->xml->HomeXML();
                    $this->xml->CateXML();
                    redirect('admin/books');
                }
                
    		}
        }else {
            $this->load->view('template',$data);
        }
    }
    function edit($id){
        $id = $this->security->xss_clean($id);
        $data['data'] = $this->book->InfoBook($id);
        if(is_numeric($id) && $data['data'] != false){
            $this->load->model('category');
            $this->load->library(array('form_validation','upload','xml'));
            $this->load->helper('seourl');
            $data['menu']       = array('book_list','book_add');
            $data['site']       = 'book/edit';
            $data['book_tag']   = json_decode($data['data']['book_tag']);
            $data['cate']       = '';
            foreach($this->category->SelectCate() as $val) {
                $data['cate'] .= '<option value="' . $val['cateid'] . '" ';
                    if($this->input->post('sltCate') == $val['cateid']){
                        $data['cate'] .= ' selected="selected"';
                    }elseif($data['data']['cate_title'] == $val['cate_title']){
                        $data['cate'] .= ' selected="selected"';
                    }
                $data['cate'] .=  '>' . $val['cate_title'] . '</option>';
            }
            if($this->input->post('btnBookEdit')){
                $this->form_validation->set_rules('txtAuthor', 'Tác giả', 'min_length[3]|max_length[50]');
                $this->form_validation->set_rules('txtPublisher', 'Nhà xuất bản', 'min_length[3]|max_length[50]');
                $this->form_validation->set_rules('txtCost', 'Giá sách', 'numeric');
                $this->form_validation->set_rules('sltDate', 'Năm xuất bản', 'numeric');
                $this->form_validation->set_rules('txtDescription', 'Mô tả', 'min_length[5]');
                if ($this->form_validation->run() == FALSE){
                    $data['error'] = validation_errors();
        			$this->load->view('template',$data);
        		}else{
                    $name = unicode($data['data']['book_title']).'_'.time();
                    if(isset($_FILES['txtImg']['name']) && $this->_uploadImg($name) == false){
                        $data['error'] = $this->upload->display_errors();
                        $this->load->view('template',$data);
                    }elseif(isset($_FILES['txtUrl']['name']) && $this->_uploadBook($name) == false){
                        $data['error'] = $this->upload->display_errors();
                        $this->load->view('template',$data);
                        if(!empty($_FILES['txtImg']['name'])){
                            unlink(IMG_UPOAD_PATH.$name.'.jpg');
                        }
                    }else {
                        if($this->input->post('sltKey') == ''){
                            $book_tag = '';
                        }else{
                            $book_tag = json_encode($this->input->post('sltKey'));
                        }
                        if(!empty($_FILES['txtImg']['name'])){
                            $book_img = $name.'.jpg';
                            if($data['data']['book_img'] != 'default.jpg'){
                                unlink(IMG_UPOAD_PATH.$data['data']['book_img']);
                            }
                        }elseif(empty($_FILES['txtImg']['name']) && isset($_FILES['txtImg']['name'])){
                            $book_img = 'default.jpg';
                            if($data['data']['book_img'] != 'default.jpg'){
                                unlink(IMG_UPOAD_PATH.$data['data']['book_img']);
                            }
                        }else{
                            $book_img = $data['data']['book_img'];
                        }
                        if(!empty($_FILES['txtUrl']['name'])){
                            $book_url = $name.'.swf';
                            unlink(BOOK_UPOAD_PATH.$data['data']['book_url']);
                            exec('C:\xampp\htdocs\library-2\tool\pdf2swf.exe '.BOOK_UPOAD_PATH.$name.'.pdf -o '.BOOK_UPOAD_PATH.$book_url.' -f -T 9 -t -s  storeallcharacters');
                            unlink(BOOK_UPOAD_PATH.$name.'.pdf');
                        }else{
                            $book_url = $data['data']['book_url'];
                        }
                        $xml['bookid']      = $data['data']['bookid'];
                        $xml['cateid']      = $this->input->post('sltCate');
                        $xml['limit']       = DEFAULT_LIMIT;
                        $xml['hot_limit']   = HOT_LIMIT;
                        $xml['home_limit']  = HOME_LIMIT;
                        $this->xml->initialize($xml);
                        $this->book->EditBook($data['data']['bookid'], $book_url,$this->input->post('txtCost'),$book_img,$this->input->post('txtAuthor'),$this->input->post('txtPublisher'),$this->input->post('sltDate'),$book_tag,$this->input->post('txtDescription'),$this->input->post('rdoPublic'),$this->input->post('sltCate'),$this->session->userdata('userid'));
                        
                        $result = $this->xml->Checkid();
                        foreach($result as $val){
                            $this->xml->$val();
                        }
                        if($data['data']['cateid'] != $this->input->post('sltCate')){
                            $this->xml->CateXML($data['data']['cateid']);
                            $this->xml->CateXML($this->input->post('sltCate'));
                        }else{
                            $this->xml->CateXML($this->input->post('sltCate'));
                        }
                        //redirect('admin/books');
                    }
        		}
            }else {
                $this->load->view('template',$data);
            }
        }else{
            redirect('admin/books');
        }
    }
    function del($id){
        $id = $this->security->xss_clean($id);
        $this->load->library('xml');
        if(is_numeric($id)){
            $link = $this->book->GetLink($id);
            if($link['book_img'] != 'default.jpg'){
                unlink(IMG_UPOAD_PATH.$link['book_img']);
            }
            unlink(BOOK_UPOAD_PATH.$link['book_url']);
            $xml['bookid']      = $id;
            $xml['cateid']      = $link['cateid'];
            $xml['limit']       = DEFAULT_LIMIT;
            $xml['hot_limit']   = HOT_LIMIT;
            $xml['home_limit']  = HOME_LIMIT;
            $this->xml->initialize($xml);
            $result = $this->xml->Checkid();
            
            $this->book->DelBook($id);
            foreach($result as $val){
                $this->xml->$val();
            }
        }
        redirect('admin/books');
    }
    function test(){
        $this->load->library('xml');
        $xml['bookid']      = 0;
        $xml['cateid']      = $link['cateid'];
        $xml['limit']       = DEFAULT_LIMIT;
        $xml['hot_limit']   = HOT_LIMIT;
        $xml['home_limit']  = HOME_LIMIT;
        $this->xml->initialize($xml);
        $result = $this->xml->Checkid();
        $aa = 'test';
        $this->xml->$aa();
    }
}
?>
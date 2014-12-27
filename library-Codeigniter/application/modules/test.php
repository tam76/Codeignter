<?php
class Test extends CI_Controller{
	public function __construct(){
		parent::__construct();
		#Tải thư viện  và helper của Form trên CodeIgniter
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('session'));
	}
	
	public function index(){
        $this->load->view('test');
	}
    
    function _thumb($name){
        $config['image_library'] = 'gd2';
        $config['source_image']	= './images/'.$name;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['thumb_marker'] = '';
        $config['new_image']	 = './images/thumb/';
        $config['width']	 = 30;
        $config['height']	= 40;
        
        $this->load->library('image_lib', $config); 
        $this->image_lib->resize();
        $this->image_lib->clear();
        
        
        $config = array();
        $config['image_library'] = 'gd2';
        $config['source_image']	= './images/'.$name;
        $config['maintain_ratio'] = TRUE;
        $config['thumb_marker'] = '';
        $config['quality'] = 100;
        $config['width']	 = 150;
        $config['height']	= 200;
        
        $this->image_lib->initialize($config); 
        $this->image_lib->resize();
    }
    
	function upload()
	{
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = 'test.jpg';
		$config['overwrite'] = TRUE;
		$config['max_size']	= '1000';
		$config['max_width']  = '1800';
		$config['max_height']  = '2400';
        echo '<pre>';
		print_r($this->load->library('upload', $config) );
        echo '</pre>';

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('test', $error);
		}
		else
		{
            //$this->_icon($config['file_name']);
            $this->_thumb($config['file_name']);
		}
	}
    
    
	public function myxml(){
        $this->load->library('xml');
        $data = $this->xml->HomeXML(10);
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        //$this->xml->Checkid(36,10);
        //$this->xml->ReadXML('home');
	}
    public function keke(){
        $vd = array('asp','php');
        $vd2 = json_encode($vd);
        echo $vd2;
        $vd = json_decode($vd2);
        $str = '';
        foreach($vd as $val){
            $str .= $val.' ,';
        }
        echo rtrim($str,',');
    }
}

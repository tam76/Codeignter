<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Config extends Define{
    protected $data;
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('conf');
    }
    
    /**
     * TRANG CÀI ĐẶT CẤU HÌNH
     */
    function setting($name){
        switch($name){
            case 'general':
                $this->data['menu'] = array('upload_avata','upload_book','upload_img','pagination');
                break;
            case 'upload_avata':
                $this->data['menu'] = array('general','upload_book','upload_img','pagination');
                break;
            case 'upload_book':
                $this->data['menu'] = array('general','upload_avata','upload_img','pagination');
                break;
            case 'upload_img':
                $this->data['menu'] = array('general','upload_avata','upload_book','pagination');
                break;
            case 'pagination':
                $this->data['menu'] = array('general','upload_avata','upload_book','upload_img');
                break;
        }
        $this->data['site'] = 'config/'.$name;
        $this->data['name'] = $name;
        if($this->input->post('btnOK') != false){
            $this->conf->update($name,json_encode($this->input->post('config'),JSON_UNESCAPED_UNICODE));
            echo json_encode($this->input->post('config'));
            redirect('admin/main');
        }
        $this->load->view('template',$this->data);
    }
    
    /**
     * TRANG CẤU HÌNH MẶC ĐỊNH
     */
    function config_default($name){
        $this->conf->ConfigDefault($name);
        redirect('admin/main');
    }
}
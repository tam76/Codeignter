<?php
class Access{
	public $CI;
	public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->library(array("Zend","session"));
		$this->CI->load->helper("url");
		$this->CI->zend->load('Zend_Acl'); 
        $flash = $this->CI->session->flashdata('item');
        if($flash != false){
            unlink('images/'.$flash.'.jpg');
        }
	}
	public function start(){
		$this->setRoles();
		$this->setResources();
		$this->setAccess();
		$module = $this->CI->router->fetch_module();
		$controller = $this->CI->router->fetch_class();
		$action = $this->CI->router->fetch_method();
		$level = $this->CI->session->userdata('level');
		$role = 'guest';
		switch($level){
			case '1':
				$role = 'admin';
				break;
			case '2':
				$role = 'mod';
				break;
			case '3':
				$role = 'member';
				break;
		}
		if(!$this->CI->Zend_Acl->isAllowed($role, $module . ':' . $controller, $action)){
			if($level == 2){
                redirect(base_url() . 'index.php/admin/main');
			}elseif($controller == 'member'){
                redirect(base_url() . 'index.php/public/main');
			}else {
                redirect(base_url() . 'index.php/admin/main/login');
			}
		}
	}
	public function setRoles(){
		$this->CI->Zend_Acl ->addRole(new Zend_Acl_Role('guest'))
							->addRole(new Zend_Acl_Role('member'), 'guest')
							->addRole(new Zend_Acl_Role('mod'), 'member')
							->addRole(new Zend_Acl_Role('admin'), 'mod');
	}
	public function setResources(){
		$this->CI->Zend_Acl ->add(new Zend_Acl_Resource('admin:cate'))
                            ->add(new Zend_Acl_Resource('admin:config'))
                            ->add(new Zend_Acl_Resource('admin:banner'))
                            
                            ->add(new Zend_Acl_Resource('general'))
                            ->add(new Zend_Acl_Resource('admin:users'), 'general')
                            
                            ->add(new Zend_Acl_Resource('mod'))
                            ->add(new Zend_Acl_Resource('admin:main'), 'mod')
                            ->add(new Zend_Acl_Resource('admin:books'),'mod')
                            
                            ->add(new Zend_Acl_Resource('guest'))
                            ->add(new Zend_Acl_Resource('public:main'), 'guest')
                            
                            ->add(new Zend_Acl_Resource('member'))
                            ->add(new Zend_Acl_Resource('public:member'), 'member');
                            
	}
	public function setAccess(){
		$this->CI->Zend_Acl ->allow("guest","guest")
                            ->allow("guest","mod",array("login"))
                            ->allow("member","member")
                            ->allow("member","mod",array("logout"))
							->allow('mod','mod')
							->allow('mod','general','edit')
							->allow('admin', null);
	}
}
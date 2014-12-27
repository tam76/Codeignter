<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller']= "public/main";
/** PHẦN MENU **/
$route['trangchu.html']     = "public/main";
$route['gioithieu.html']    = "public/main/intro";
$route['danhmuc/(:num)-:any/trang-(:num).html'] = "public/main/category/$1/$2";
$route['danhmuc/(:num)-:any.html']              = "public/main/category/$1";
$route['lienhe.html']       = "public/main/contact";

/** PHẦN PUBLIC **/
$route['(:num)-:any/(:num)-:any.html']      = "public/main/detail/$1/$2";
$route['giohang.html']      = "public/main/cart";
$route['timkiem.html']      = "public/main/search";
$route['dangnhap.html']     = "public/main/login";
$route['dangxuat.html']     = "public/main/logout";
$route['dangki.html']       = "public/main/registration";
$route['quenmatkhau.html']  = "public/main/fg_password";

/** PHẦN MEMBER **/
$route['thongtin.html']         = "public/member/info";
$route['naptien.html']          = "public/member/recharge";
$route['tusach.html']           = "public/member/bookcase";
$route['changepass.html']       = "public/member/pass";
$route['doc/sach-(:num).html']  = "public/member/read/$1";
$route['binhchon.html']         = "public/member/rating";

$route['404_override']      = '';
$route['key']               = "admin/books/key";


/* End of file routes.php */
/* Location: ./application/config/routes.php */
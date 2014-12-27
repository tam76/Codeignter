<?php
if(isset($menu)){
    foreach($menu as $val){
        switch($val){
            case "user_list":
                $custom_menu['admin/users'] = 'Quản lý user';
                break;
            case "user_add":
                $custom_menu['admin/users/add'] = 'Thêm user';
                break;
            case "cate_list":
                $custom_menu['admin/cate'] = 'Quản lý danh mục';
                break;
            case "cate_add":
                $custom_menu['admin/cate/add'] = 'Thêm danh mục';
                break;
            case "book_list":
                $custom_menu['admin/books'] = 'Quản lý sách';
                break;
            case "book_add":
                $custom_menu['admin/books/add'] = 'Thêm sách';
                break;
            case "banner_list":
                $custom_menu['admin/banner'] = 'Quản lý banner';
                break;
            case "banner_add":
                $custom_menu['admin/banner/add'] = 'Thêm banner';
                break;
            case "general":
                $custom_menu['admin/config/setting/general'] = 'Cấu hình chung';
                break;
            case "upload_avata":
                $custom_menu['admin/config/setting/upload_avata'] = 'Cấu hình upload avata';
                break;
            case "upload_book":
                $custom_menu['admin/config/setting/upload_book'] = 'Cấu hình upload sách';
                break;
            case "upload_img":
                $custom_menu['admin/config/setting/upload_img'] = 'Cấu hình upload hình sách';
                break;
            case "pagination":
                $custom_menu['admin/config/setting/pagination'] = 'Cấu hình phân trang';
                break;
        }
    }
}

echo '<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <base href="'.base_url().'" />
    <link rel="stylesheet" href="'.base_url().'public/admin/css/style.css" />
    <link rel="stylesheet" href="'.base_url().'public/admin/css/jquery-ui.css" />
    <script type="text/javascript" src="'.base_url().'public/javascript/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="'.base_url().'public/ckeditor/ckeditor.js"></script>
    <script src="'.base_url().'public/javascript/jquery-ui.js"></script>
    <script type="text/javascript" src="'.base_url().'public/javascript/myscript.js"></script>
	<script type="text/javascript">
        function xacnhan(msg) {
            if (window.confirm(msg)) {
                return true;
            }
            return false;
        }
    </script>
	<title>Admin Area</title>
</head>

<body>

    <div id="layout">
        <div id="top">
            Admin Area';
            if (isset($admin_function)) {
                echo ' :: '.$admin_function;
            }
            echo '
        </div>';
        echo '<div id="menu">
        <table width="100%">
            <tr>';
                if($this->session->userdata('username') != ''){
                    echo '<td>
                        <a href="'.site_url("admin/main/index").'">Mainpage</a>';
                        if (isset($custom_menu) && !empty($custom_menu)) {
                            foreach ($custom_menu as $link => $name) {
                                echo ' | <a href="' .site_url($link). '">' .$name. '</a>';
                            }
                        }
                        echo '
                    </td>
                    <td align="right">
                        Xin chào <a href="' .site_url("admin/users/edit").'/'.$this->session->userdata('userid'). '"><b>' .$this->session->userdata('username'). '&nbsp;&nbsp;</b><img id = "icon_avata" src = "'.base_url(THUMB_NEW_IMAGE.$this->session->userdata('avata')).'" /></a> | <a href="'.site_url("admin/main/logout").'">Logout</a>
                    </td>';
                }
            echo '</tr>
        </table></div>';
        echo '
        <div id="main">';

?>
<?php
echo '<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <base href="'.base_url().'" />
    <meta name="keywords" content="Thu vien, Sach online, tai lieu online, ebook, do an, sach, tai lieu" />
    <meta name="description" content="Thư viện sách online nơi cung cấp các ebook, sách ,tài liệu chất lượng với các chủ đề phong phú" />
    <link rel="stylesheet" href="'.base_url('public/public/css/style.css').'" />
    <link rel="stylesheet" href="'.base_url('public/public/css/jquery-ui.css').'" />
    <link rel="stylesheet" href="'.base_url('public/public/css/jRating.jquery.css').'" type="text/css" />
	<link href="'.base_url('public/banner/css/skitter.styles.css').'" type="text/css" media="all" rel="stylesheet" />
    <style type="text/css">
		body {margin:15px;font-family:Arial;font-size:13px}
		a img{border:0}
		.datasSent, .serverResponse{margin-top:20px;width:470px;height:73px;border:1px solid #F0F0F0;background-color:#F8F8F8;padding:10px;float:left;margin-right:10px}
		.datasSent{width:200px;position:fixed;left:680px;top:0}
		.serverResponse{position:fixed;left:680px;top:100px}
		.datasSent p, .serverResponse p {font-style:italic;font-size:12px}
		.exemple{margin-top:15px;}
		.clr{clear:both}
		pre {margin:0;padding:0}
		.notice {background-color:#F4F4F4;color:#666;border:1px solid #CECECE;padding:10px;font-weight:bold;width:600px;font-size:12px;margin-top:10px}
	</style>
    <script type="text/javascript" src="'.base_url('public/javascript/jquery-1.11.0.min.js').'"></script>
    <script type="text/javascript" src="'.base_url('public/javascript/jquery-ui.js').'"></script>
    <script type="text/javascript" src="'.base_url('public/javascript/login.js').'"></script>
	<script type="text/javascript" src="'.base_url('public/javascript/jRating.jquery.js').'"></script>
    <script type="text/javascript" src="'.base_url('public/javascript/tooltip.js').'"></script>
    <script type="text/javascript" src="'.base_url('public/javascript/cart.js').'"></script>
	<script type="text/javascript" src="'.base_url('public/banner/js/jquery.easing.1.3.js').'"></script>
	<script type="text/javascript" src="'.base_url('public/banner/js/jquery.skitter.min.js').'"></script>
    <script type="text/javascript" language="javascript">
		$(document).ready(function() {
			$(".box_skitter_large").skitter({
				theme: "clean",
				numbers_align: "center",
				progressbar: false, 
				dots: true, 
				preview: false
			});
		});
	</script>
    
    <title>Thư viện online</title>
</head>

<body>

    <div id="layout">
                <div class="border_box"style=" padding: 0px 10px;" >
    				<div class="box_skitter box_skitter_large">
    					<ul>
    						<li><img src="'.base_url("public/banner/images/example/001.jpg").'" class="circles" /></li>
    						<li><img src="'.base_url("public/banner/images/example/002.jpg").'" /></li>
    						<li><img src="'.base_url("public/banner/images/example/003.jpg").'" class="circlesRotate" /></li>
    						<li><img src="'.base_url("public/banner/images/example/004.jpg").'" class="cubeShow" /></li>	
    					</ul>
    				</div>
    			</div>
        <div id="search">
            <form action = "'.site_url('public/main/search').'" method = "post">
            <div class = "search">
                <input type="text" name="txtSearch" id="txtSearch" class="textbox" />
                <input type="submit" value = "" name="btnSearch" />
            </div>
            </form>
        </div><!-- End Search -->
        <div id="topmenu">
            <ul>
                <li><a href="trangchu.html">Trang Chủ</a></li>
                <li><a href="dangky.html">Đăng Ký</a></li>
                <li><a href="#">Danh Mục</a>
                    <ul>';
                    foreach ($cate_menu as $item) {
                        echo '
                        <li><a href="danh-muc/' .$item["cateid"]. '-' .unicode($item["cate_title"]). '.html">' .$item["cate_title"]. '</a></li>';
                    }
                    echo'
                    </ul>
                </li>
                <li><a href="giohang.html">Giỏ hàng</a></li>
                <li><a href="#">Sản Phẩm</a></li>
                <li><a href="#">Liên Hệ</a></li>
            </ul>
        </div>
        <div id="content">
            <div id="left">
                <div id="leftmenu">
                    <h1>
                        Menu Chính
                    </h1>
                    <ul>
                        <li><a href="trangchu.html">Trang Chủ</a></li>
                        <li><a href="dangky.html">Đăng Ký</a></li>
                        <li><a href="#">Danh Mục</a>
                            <ul>';
                            foreach ($cate_menu as $item) {
                                echo '
                                <li><a href="danh-muc/' .$item["cateid"]. '-' .unicode($item["cate_title"]). '.html">' .$item["cate_title"]. '</a></li>';
                            }
                            echo '
                            </ul>
                        </li>
                        <li><a href="giohang.html">Giỏ hàng</a></li>
                        <li><a href="#">Sản Phẩm</a></li>
                        <li><a href="#">Liên Hệ</a></li>
                    </ul>
                </div><!-- End leftmenu -->
                <div id="login">
                    <h1>
                        Đăng Nhập
                    </h1>
                    <div class="content">
                        <div id="login_msg">';
                        if ($this->session->userdata('userid') != false) {
                            echo 'Xin chào <b>' .$this->session->userdata('username'). '</b><br />
                            <img src="'.base_url(AVATA_UPOAD_PATH.$this->session->userdata('avata')).'" width = "150px" />
                            <a href="giohang.html" class="button" title="Giỏ hàng">Giỏ hàng</a><br />
                            <a href="thanhtoan.html" class="button" title="Thanh Toán">Thanh Toán</a><br />
                            <a href="tusach.html" class="button" title="Tủ sách">Tủ sách</a><br />';
                            if($this->session->userdata('level') < 3){
                                echo '<a href="'.site_url("admin/main").'" class="button" title="Quản trị">Quản trị</a><br />';
                            }
                            echo '<a href="#" class="button" title="logout">Logout</a>';
                        }
                        echo '</div>
                        <form name="fLogin" id="fLogin" action="#" method="post"';
                        if ($this->session->userdata('userid') != false) {
                            echo ' style="display: none;"';
                        }
                        echo '>
                            Username:<br />
                            <input type="text" name="txtUser" id="txtUser" class="textbox" /><br />
                            Password: <br />
                            <input type="password" name="txtPass" id="txtPass" class="textbox" /><br />
                            <input type="submit" name="btnLogin" id="btnLogin" value="Đăng nhập" />
                            <a href="'.site_url('public/main/fg_password').'" class="button" title="Quên mật khẩu">Quên mật khẩu</a><br />
                        </form>
                    </div>
                </div>
            </div><!-- End Left -->
            <div id="main">';

?>
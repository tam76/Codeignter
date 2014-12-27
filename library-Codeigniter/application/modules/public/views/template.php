<?php
echo '<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <base href="'.base_url().'" />
    <meta name="keywords" content="Thu vien, Sach online, tai lieu online, ebook, do an, sach, tai lieu" />
    <link rel="stylesheet" href="'.base_url('public/public/css/bootstrap.min.css').'" type="text/css" />
    <link rel="stylesheet" href="'.base_url('public/public/css/bootstrap-theme.min.css').'" type="text/css" />
    <link rel="stylesheet" href="'.base_url('public/public/css/style.css').'" />
    <link rel="stylesheet" href="'.base_url('public/public/css/jquery-ui.css').'" />
    <link rel="stylesheet" href="'.base_url('public/public/css/jRating.jquery.css').'" type="text/css" />
    
    <script type="text/javascript" src="'.base_url('public/javascript/jquery-1.11.0.min.js').'"></script>
    <script type="text/javascript" src="'.base_url('public/javascript/bootstrap.min.js').'"></script>
	<script type="text/javascript" src="'.base_url('public/javascript/jRating.jquery.js').'"></script>
    <script type="text/javascript" src="'.base_url('public/javascript/main.js').'"></script>
    <script type="text/javascript" src="'.base_url('public/javascript/modernizr.js').'"></script>
    
    <title>Thư viện online - '.$title.'</title>
</head>
<body>
    <div class="container">
        <header class="navbar navbar-default navbar-fixed-top shadow" style="left: 0px; opacity: 1; width: auto;">
            <ul class="cd-header-buttons">
                <li id = "Uzone" class = "pull-left">';
                    if ($this->session->userdata('userid') != false) {
                        echo '
                        <div class="dropdown" style="margin-bottom: 10px;">
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
                echo '</li>
                <li class = "pull-left" id="cart">
                    <a href="giohang.html" style="float: left;color: black;padding: 10px;">
                        <span class="glyphicon glyphicon-shopping-cart badge " style="font-size: 20px;">';
                        if($this->session->userdata('cart')){
                            echo count($this->session->userdata('cart'));
                        }else{
                            echo '';
                        }
                        echo '</span>
                    </a>
                </li>
    			<li class = "pull-left"><a class="cd-search-trigger" href="#cd-search"><span></span></a></li>
    		</ul> <!-- cd-header-buttons -->
                <div class="navbar-header">
                  <a class="navbar-brand " ><img class="col-md-1" alt="logo" src="xxx"></a>
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" style="float: none;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <div class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                    <li><a href="trangchu.html"><span class="glyphicon glyphicon-home margRight"></span>Trang chủ</a></li>
                    <li><a href="gioithieu.html"><span class="glyphicon glyphicon-user margRight"></span>Giới thiệu</a></li>
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-large margRight"></span>Danh mục sách<b class="caret"></b></a>
                      <ul class="dropdown-menu">';
                        foreach($cate_menu as $val){
                            echo '<li class="dropdown-submenu">
                                <a href="danhmuc/'.$val['cateid'].'-'.unicode($val['cate_title']).'.html">'.$val['cate_title'].'</a>
                            </li>';
                        }
                        echo '
                      </ul>
                    </li>
                    <li><a href="lienhe.html"><span class="glyphicon glyphicon-map-marker margRight"></span>Liên hệ</a></li>
                  </ul>
              </div>                            
        </header>
    </div>  
    <div id="cd-search" class="cd-search">
		<form action="timkiem.html" method="post">
			<input name="txtSearch" type="search" placeholder="Search..."/>
		</form>
	</div>
    <!-- ============================================================= SECTION – HERO ============================================================= -->

    <div id="image_carousel" class="carousel slide carousel-fade col-offset-2" data-ride="carousel" data-interval=" 5000">

        <ol class="carousel-indicators">';
            if(isset($banner['slide-main'])){
                for($i=0;$i<count($banner['slide-main']);$i++){
                    echo '<li data-target="#image_carousel" data-slide-to="'.$i.'" ';
                    if($i == 0){
                        echo 'class="active"';
                    } 
                    echo '></li>';
                }
            }
        echo '</ol>

        <div class="carousel-inner">';
            $stt = 0;
            if(isset($banner['slide-main'])){
                foreach($banner['slide-main'] as $val){
                    if($stt == 0){
                        echo '<div class="carousel_background item active" style="background-color: #faf6ee">';
                    }elseif($stt%2 == 1){
                        echo '<div class="carousel_background item">';
                    }elseif($stt%2 == 0){
                        echo '<div class="carousel_background item repeating_background">';
                    }
                    echo '
                    <div class="carousel_image_container">
                            <a href="#"><img src="images/banner/'.$val['link'].'" alt="banner" class="img-responsive"/></a>
                        </div><!-- /.carousel_image_container -->
                    </div><!-- /.carousel_background -->';
                    $stt++;
                }
            }
            echo '
         </div><!-- /.carousel-inner -->
     </div><!-- /#image_carousel -->
  <!-- ============================================================= SECTION – HERO : END ============================================================= -->
    <div>
        <a class="cd-nav-trigger" href="#cd-primary-nav"><span></span></a>';
        if(isset($banner['left-ad'])){
            echo '<img id="adleft" class="col-lg-1 hidden-md hidden-sm hidden-xs" alt="advertise" src="images/banner/'.$banner['left-ad'][0]['link'].'" style="display: none; padding: 0.1%;"/>';
        }
        echo '
        <div id="cd-primary-nav" class="col-lg-2 col-lg-push-1 col-md-3 col-sm-4 col-xs-4 cd-primary-nav sidebar " style="position: absolute;">
          <ul class="nav nav-sidebar">';
            foreach($cate_menu as $val){
                echo '<li class="dropdown-submenu">
                    <a href="danhmuc/'.$val['cateid'].'-'.unicode($val['cate_title']).'.html">'.$val['cate_title'].'</a>
                </li>';
            }
            echo '
          </ul>
          <div id="login_msg"></div>
          <form action="." method="post" name="fLogin" id="fLogin" class="navbar-form navbar-right" ';
                        if ($this->session->userdata('userid') != false) {
                            echo ' style="display: none;"';
                        }
                        echo '>
            <div class="form-group">
              <div class="form-group">
                <input name="txtUser" id="txtUser" type="text" placeholder="User name" class="form-control">
                <input name="txtPass" id="txtPass" type="password" placeholder="Password" class="form-control">
              </div>
              <div class="btn-group">
                <button name="btnLogin" id="btnLogin" type="submit" class="btn btn-success">Đăng nhập</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu" style="position: relative;">
                  <li><a id="forgot" href="quenmatkhau.html">Quên mật khẩu</a></li>
                  <li class="divider"></li>
                  <li><a id="reg" href="dangki.html">Đăng kí</a></li>
                </ul>
              </div>
            </div>
          </form>
        </div>
        <main class="cd-main-content">
            <div id = "main" class="col-lg-8 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12">';
                $this->load->view($site);
            echo '</div>
        </main>
        <div id="bttop" class="img-responsive img-circle"></div>';
        if(isset($banner['right-ad'])){
            echo '<img id="adright" class="col-lg-1 col-lg-push-11 hidden-md hidden-sm hidden-xs" alt="advertise" src="images/banner/'.$banner['right-ad'][0]['link'].'" style="display: none; padding: 0.1%;"/>';
        }
        echo '
    </div>
    <div class="clearfix"></div>
    <footer class="footer dark-bg">
        <div class="footer-bottom">
            <div class="container inner">
                <p class="pull-left">&nbsp; &nbsp; © 2014 Nguyen Duy Tam.</p>
                <ul class="footer-menu pull-right"><li>
                    <ul class="page_links">
                      <li><a href="trangchu.html">Trang chủ</a></li>
                      <li><a href="gioithieu.html">Giới thiệu</a></li>
                      <li><a href="lienhe.html">Liên hệ</a></li>
                    </ul>
                </li></ul><!-- .footer-menu -->
            </div><!-- .container -->
        </div><!-- .footer-bottom -->
    </footer>
</body>
';
?>
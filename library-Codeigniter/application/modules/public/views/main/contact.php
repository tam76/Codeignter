<?php
if(isset($breadcrumbs)){
    echo '<ol class="breadcrumb">';
    foreach($breadcrumbs as $val){
            if(isset($val['link'])){
                echo '
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="'.$val['link'].'" itemprop="url">
                        <span itemprop="title">'.$val['title'].'</span>
                    </a>
                </li>';
            }else{
                echo '
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="active">
                    <strong itemprop="url">
                        <span itemprop="title">'.$val['title'].'</span>
                    </strong>
                </li>';
            }
    }
    echo '</ol>';
}
echo '
<script type="text/javascript" src="public/ckeditor/ckeditor.js"></script>
<form action="'.current_url().'" method="post" class="col-md-8">';
    if(isset($error)){
        echo '<div class="error_msg"><ul>'.$error.'</ul></div>';
    }
    echo '<fieldset>
        <legend>Thông Tin Liên Hệ</legend>
        <span class="form_label app">Tiêu đề:</span>
        <span class="form_item">
            <input type="text" name="title" class="textbox form-control" value="';
            if (isset($_POST["title"])) {
                echo $_POST["title"];
            }
            echo '" />
        </span><br />
        <span class="form_label app">Họ và tên:</span>
        <span class="form_item">
            <input type="text" name="name" class="textbox form-control" value="';
            if (isset($_POST["name"])) {
                echo $_POST["name"];
            }
            echo '" />
        </span><br />
        <span class="form_label app">Email:</span>
        <span class="form_item">
            <input type="text" name="txtemail" class="textbox form-control" value="';
            if (isset($_POST["txtemail"])) {
                echo $_POST["txtemail"];
            }
            echo '" />
        </span><br />
        <span class="form_label app">Điện thoại:</span>
        <span class="form_item">
            <input type="text" name="txtphone" class="textbox form-control" value="';
            if (isset($_POST["txtphone"])) {
                echo $_POST["txtphone"];
            }
            echo '" />
        </span><br />
        <span class="form_label app">Nội dung :</span>
        <span class="form_item">
			<span class="right">
                <textarea id="txt_content" name="txtContent">';
                if (isset($_POST["txtContent"])) {
                    echo $_POST["txtContent"];
                }
                echo '</textarea>
            </span>
        </span><br />
        <span class="form_label app">Mã xác nhận:</span>
        <span class="form_item">
            <input type="text" name="txtCaptcha" maxlength="5" class="textbox form-control" style="width: 100px;" />'.$img.'
        </span><br />
    </fieldset>
    <span class="form_item">
        <input type="submit" name="btnOk" value="Đồng ý" class="btn btn-success" />
        <input type="reset" value="Xóa trắng" class="btn btn-success" />
    </span>
</form>
<div  class="col-md-4">
    <h3 class="lined">Liên hệ với chúng tôi</h3>
    <ul>
    	<li class = "center-block"><h4><span>&nbsp;Nguyễn Duy Tâm</span></h4></li>
    	<li class="glyphicon glyphicon-earphone">&nbsp;<span><strong>Tel:</strong> (84-1) 228 121 763</span></li>
    	<li class="glyphicon glyphicon-envelope">&nbsp;<strong>E-mail:</strong> <a href="#">tam.pro@gmail.com</a></li>
    </ul>
    <h3 class="lined">Chúng tôi trên MXH</h3>
    <ul class="list-inline text-center">
        <li><a class="fb" target="_blank" href="https://www.facebook.com/tam.nguyen.5059">
            <img src="public/images/facebook.jpg" alt="facebook" />
        </a></li>
    	<li><a class="gl" target="_blank" href="#">
            <img src="public/images/google.png" alt="google plus" />
        </a></li>
    </ul>
</div>
<script type="text/javascript">
	$(function() {				    				    
		if(CKEDITOR.instances["txt_content"]) {						
			CKEDITOR.remove(CKEDITOR.instances["txt_content"]);
		}
		CKEDITOR.config.width = 400;
	    CKEDITOR.config.height = 150;
		CKEDITOR.replace("txt_content",{});
	})
</script>';
?>

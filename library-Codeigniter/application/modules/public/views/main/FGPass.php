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
<form action="'.current_url().'" method="post" class="form-horizontal" role="form">';
    if(!empty($error)){
        echo '<div class="error_msg"><ul>'.$error.'</ul></div>';
    }
    echo '<fieldset>
        <legend>Thông Tin Lấy mật khẩu</legend>
        <span class="form_label app">Email :</span>
        <span class="form_item">
            <input type="email" name="txtEmail" class="form-control" id="inputEmail3" placeholder="Email""';
            if (isset($_POST["txtEmail"])) {
                echo ' value="' .htmlspecialchars($_POST["txtEmail"]). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label app">Mã xác nhận:</span>
        <span class="form_item">
            <input type="text" name="txtCaptcha" maxlength="5" class="form-control textbox" style="width: 100px;" />'.$img.'
        </span><br />
    </fieldset>
    <span class="form_item">
        <input type="submit" name="btnPass" value="Đồng ý" class="btn btn-success" />
    </span>
</form>';
?>
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
<form action="'.current_url().'" method=post>';
    if(isset($error)){
        echo '<div class="error_msg"><ul>'.$error.'</ul></div>';
    }
    echo '<fieldset>
        <legend>Thông Tin Đăng Ký</legend>';
        echo '
        <span class="form_label app">Username:</span>
        <span class="form_item">
            <input type="text" name="txtUser" class="textbox form-control"';
            if (isset($_POST["txtUser"])) {
                echo ' value="' .htmlspecialchars($_POST["txtUser"]). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label app">Password:</span>
        <span class="form_item">
            <input type="password" name="txtPass" class="textbox form-control" />
        </span><br />
        <span class="form_label app">Confirm password:</span>
        <span class="form_item">
            <input type="password" name="txtRepass" class="textbox form-control" />
        </span><br />
        <span class="form_label app">Email :</span>
        <span class="form_item">
            <input type="text" name="txtEmail" class="textbox form-control"';
            if (isset($_POST["txtEmail"])) {
                echo ' value="' .htmlspecialchars($_POST["txtEmail"]). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label app">Mã xác nhận:</span>
        <span class="form_item">
            <input type="text" name="txtCaptcha" maxlength="5" class="textbox form-control" style="width: 100px;" />'.$img.'
        </span><br />
    </fieldset>
    <span class="form_item">
        <input type="submit" name="btnUserAdd" value="Đồng ý" class="btn btn-success" />
    </span>
</form>';
?>
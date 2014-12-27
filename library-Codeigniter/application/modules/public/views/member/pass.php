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
        <legend>Thay đổi mật khẩu</legend>';
        echo '
        <span class="form_label app">Password:</span>
        <span class="form_item">
            <input type="password" name="txtPass" class="textbox form-control" />
        </span><br />
        <span class="form_label app">Confirm password:</span>
        <span class="form_item">
            <input type="password" name="txtRepass" class="textbox form-control" />
        </span><br />
        <span class="form_label app">Current password:</span>
        <span class="form_item">
            <input type="password" name="txtCurrent" class="textbox form-control" />
        </span><br />
    </fieldset>
    <span class="form_item">
        <input type="submit" name="btnChange" value="Đồng ý" class="btn btn-success" />
    </span>
</form>';
?>
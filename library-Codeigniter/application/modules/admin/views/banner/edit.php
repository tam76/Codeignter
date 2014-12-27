<?php
echo '
<form action= "'.current_url().'" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Thông Tin Banner</legend>';
        if(isset($error)) {
           echo '<div class="error_msg"><ul>'.$error.'</ul></div>';
        }
        echo '
        <span class="form_label">Gourp :</span>
        <span class="form_item">
            <select name="sltCate" id="sel_change">';
                foreach($group as $val){
                    echo '<option value="'.$val.'" ';
                    if(isset($_POST['sltCate']) && $_POST['sltCate'] == $val){
                        echo 'selected = "selected"';
                    }elseif($data['group'] == $val){
                        echo 'selected = "selected"';
                    }
                    echo '>'.$val.'</option>';
                }
            echo '</select>
        </span><br />
        <span class="form_label">Tiêu đề:</span>
        <span class="form_item">
            <input type="text" name="txtTitle" class="textbox"';
            if (isset($_POST["txtTitle"])) {
                echo ' value="' .$_POST["txtTitle"]. '"';
            }else{
                echo ' value="' .$data['title']. '"';
            }
            echo ' />
        </span><br />
        <span class="form_label">Hình Banner:</span>
        <span class="form_item">
            <input type="button" name="btnimgbook" value="Đổi hình banner" />
        </span><br />
        <span class="form_label">Công bố:</span>
        <span class="form_item">
            <input type="radio" name="rdoPublic" value="1" ';if($data['status'] == 1){echo 'checked="checked"';} echo'/> Có 
            <input type="radio" name="rdoPublic" value="2" ';if($data['status'] == 2){echo 'checked="checked"';} echo' /> Không
        </span><br />
        <span class="form_label"></span>
        <span class="form_item">
            <input type="submit" name="btnBannerEdit" value="Sửa banner" class="button" />
        </span>
        </span><br />
    </fieldset>
</form>';
?>
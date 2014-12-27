<?php
echo'
<form action= "'.current_url().'" method="post">
    <fieldset>
        <legend>Cấu chình pagination phần public</legend>
        <span class="form_label">Trang chủ :</span>
        <span class="form_item">
        <input type="text" name="config[home_limit]" class="textbox" value = "'.HOME_LIMIT.'" placeholder="Số sách trên trang"/>
        </span><br />
        <span class="form_label">Trang thường :</span>
        <span class="form_item">
        <input type="text" name="config[book_limit]" class="textbox" value = "'.DEFAULT_LIMIT.'" placeholder="Số sách trên trang"/>
        </span><br />
        <span class="form_label">Trang hot :</span>
        <span class="form_item">
        <input type="text" name="config[hot_limit]" class="textbox" value = "'.HOT_LIMIT.'" placeholder="Số sách trên trang"/>
        </span><br />
    </fieldset>
    <fieldset>
        <legend>Cấu chình pagination phần admin</legend>
        <span class="form_label">Trang User :</span>
        <span class="form_item">
        <input type="text" name="config[user]" class="textbox" value = "'.USER_LIMIT.'" placeholder="Số dòng trên bảng"/>
        </span><br />
        <span class="form_label">Trang Danh mục :</span>
        <span class="form_item">
        <input type="text" name="config[cate]" class="textbox" value = "'.CATE_LIMIT.'" placeholder="Số dòng trên bảng"/>
        </span><br />
        <span class="form_label">Trang Sách :</span>
        <span class="form_item">
        <input type="text" name="config[book]" class="textbox" value = "'.BOOK_LIMIT.'" placeholder="Số dòng trên bảng"/>
        </span><br />
    </fieldset>
        <span class="form_item">
            <input type="submit" name="btnOK" value="Áp dụng" class="button" />
            <a href = "'.site_url('admin/config/config_default/'.$name).'" class="button" >Mặc định</a>
        </span>
        </span><br />
</form>';
?>
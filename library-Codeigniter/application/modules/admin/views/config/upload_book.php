<?php
echo'
<form action= "'.current_url().'" method="post">
    <fieldset>
        <legend>Cấu chình upload sách</legend>
        <span class="form_label">Thư mục ảnh :</span>
        <span class="form_item">
        <input type="text" name="config[upload_path]" class="textbox" value = "'.BOOK_UPOAD_PATH.'" />
        </span><br />
        <span class="form_label">Đuôi cho phép :</span>
        <span class="form_item">
        <input type="text" name="config[allowed_types]" class="textbox" value = "'.BOOK_ALLOWED_TYPES.'" placeholder="phân biệt nhau bằng dấu |"/>
        </span><br />
        <span class="form_label">Max Size :</span>
        <span class="form_item">
        <input type="text" name="config[max_size]" class="textbox" value = "'.BOOK_MAX_SIZE.'" placeholder="Đơn vị tính KB" />
        </span><br />
        <span class="form_item">
            <input type="submit" name="btnOK" value="Áp dụng" class="button" />
            <a href = "'.site_url('admin/config/config_default/'.$name).'" class="button" >Mặc định</a>
        </span>
        </span><br />
    </fieldset>
</form>';
?>
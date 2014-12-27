<?php
echo'
<form action= "'.current_url().'" method="post">
    <fieldset>
        <legend>Cấu chình chung</legend>
        <span class="form_label">Thư mục ảnh :</span>
        <span class="form_item">
            <input type="text" name="config[upload_path]" class="textbox" value = "'.BANNER_UPOAD_PATH.'" />
        </span><br />
        <span class="form_label">Đuôi cho phép :</span>
        <span class="form_item">
            <input type="text" name="config[allowed_types]" class="textbox" value = "'.BANNER_ALLOWED_TYPES.'" placeholder="phân biệt nhau bằng dấu |"/>
        </span><br />
    </fieldset>
    <fieldset>
        <legend>Cấu chình Slide</legend>
        <span class="form_label">Chiều rộng :</span>
        <span class="form_item">
        <input type="text" name="config[slide][width]" class="textbox" value = "'.SLIDE_WIDTH.'" placeholder="Đơn vị tính px"/>
        </span><br />
        <span class="form_label">Chiều cao :</span>
        <span class="form_item">
        <input type="text" name="config[slide][height]" class="textbox" value = "'.SLIDE_HEIGHT.'" placeholder="Đơn vị tính px"/>
        </span><br />
    </fieldset>
    <fieldset>
        <legend>Cấu chình left-ad</legend>
        <span class="form_label">Chiều rộng :</span>
        <span class="form_item">
        <input type="text" name="config[left-ad][width]" class="textbox" value = "'.LEFT_AD_WIDTH.'" placeholder="Đơn vị tính px"/>
        </span><br />
    </fieldset>
    <fieldset>
        <legend>Cấu chình right-ad</legend>
        <span class="form_label">Chiều rộng :</span>
        <span class="form_item">
        <input type="text" name="config[right-ad][width]" class="textbox" value = "'.RIGHT_AD_WIDTH.'" placeholder="Đơn vị tính px"/>
        </span><br />
    </fieldset>
    <fieldset>
        <legend>Cấu chình block-1</legend>
        <span class="form_label">Chiều cao :</span>
        <span class="form_item">
        <input type="text" name="config[block-1][height]" class="textbox" value = "'.BLOCK_1_HEIGHT.'" placeholder="Đơn vị tính px"/>
        </span><br />
    </fieldset>
    <fieldset>
        <legend>Cấu chình block-2</legend>
        <span class="form_label">Chiều cao :</span>
        <span class="form_item">
        <input type="text" name="config[block-2][height]" class="textbox" value = "'.BLOCK_2_HEIGHT.'" placeholder="Đơn vị tính px"/>
        </span><br />
    </fieldset>
        <span class="form_item">
            <input type="submit" name="btnOK" value="Áp dụng" class="button" />
            <a href = "'.site_url('admin/config/config_default/'.$name).'" class="button" >Mặc định</a>
        </span>
        </span><br />
</form>';
?>
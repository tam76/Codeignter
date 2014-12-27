<?php
echo'
<form action= "'.current_url().'" method="post">
    <fieldset>
        <legend>Cấu chình upload Avata</legend>
        <span class="form_label">Thư mục ảnh :</span>
        <span class="form_item">
        <input type="text" name="config[upload_path]" class="textbox" value = "'.AVATA_UPOAD_PATH.'" />
        </span><br />
        <span class="form_label">Đuôi cho phép :</span>
        <span class="form_item">
        <input type="text" name="config[allowed_types]" class="textbox" value = "'.AVATA_ALLOWED_TYPES.'" placeholder="phân biệt nhau bằng dấu |"/>
        </span><br />
        <span class="form_label">Max Size :</span>
        <span class="form_item">
        <input type="text" name="config[max_size]" class="textbox" value = "'.AVATA_MAX_SIZE.'" placeholder="Đơn vị tính KB" />
        </span><br />
        <span class="form_label">Max Width :</span>
        <span class="form_item">
        <input type="text" name="config[max_width]" class="textbox" value = "'.AVATA_MAX_WIDTH.'" placeholder="Đơn vị tính px"/>
        </span><br />
        <span class="form_label">Max Heigh :</span>
        <span class="form_item">
        <input type="text" name="config[max_height]" class="textbox" value = "'.AVATA_MAX_HEIGHT.'" placeholder="Đơn vị tính px"/>
        </span><br />
    </fieldset>
    <fieldset>
        <legend>Cấu chình avata</legend>
        <span class="form_label">Kiểu thư viện :</span>
        <span class="form_item">
        <input type="text" name="config[image_library]" class="textbox" value = "'.AVATA_IMG_LIBRARY.'" placeholder="imagemagick, netpbm, gd, gd2"/>
        </span><br />
        <span class="form_label">Chất lượng ảnh :</span>
        <span class="form_item">
        <input type="text" name="config[quality]" class="textbox" value = "'.AVATA_QUALITY.'" placeholder="Tính theo đơn vị %"/>
        </span><br />
        <span class="form_label">Chiều rộng :</span>
        <span class="form_item">
        <input type="text" name="config[width]" class="textbox" value = "'.AVATA_WIDTH.'" placeholder="Đơn vị tính px"/>
        </span><br />
        <span class="form_label">Chiều cao :</span>
        <span class="form_item">
        <input type="text" name="config[height]" class="textbox" value = "'.AVATA_HEIGHT.'" placeholder="Đơn vị tính px"/>
        </span><br />
    </fieldset>
    <fieldset>
        <legend>Cấu chình thumb avata</legend>
        <span class="form_label">Thư mục thumb :</span>
        <span class="form_item">
        <input type="text" name="config[new_image]" class="textbox" value = "'.THUMB_NEW_IMAGE.'" />
        </span><br />
        <span class="form_label">Kiểu thư viện :</span>
        <span class="form_item">
        <input type="text" name="config[image_library_thumb]" class="textbox" value = "'.THUMB_IMG_LIBRARY.'" placeholder="imagemagick, netpbm, gd, gd2"/>
        </span><br />
        <span class="form_label">Chiều rộng :</span>
        <span class="form_item">
        <input type="text" name="config[width_thumb]" class="textbox" value = "'.THUMB_WIDTH.'" placeholder="Đơn vị tính px"/>
        </span><br />
        <span class="form_label">Chiều cao :</span>
        <span class="form_item">
        <input type="text" name="config[height_thumb]" class="textbox" value = "'.THUMB_HEIGHT.'" placeholder="Đơn vị tính px"/>
        </span><br />
    </fieldset>
        <span class="form_item">
            <input type="submit" name="btnOK" value="Áp dụng" class="button" />
            <a href = "'.site_url('admin/config/config_default/'.$name).'" class="button" >Mặc định</a>
        </span>
        </span><br />
</form>';
?>
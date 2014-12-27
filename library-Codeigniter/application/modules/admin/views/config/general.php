<?php
echo'
<form action= "'.current_url().'" method="post">
    <fieldset>
        <legend>Cấu chình chung</legend>
        <span class="form_label">Múi giờ :</span>
        <span class="form_item">
        <input type="text" name="config[time_zone]" class="textbox" value = "'.TIME_ZONE.'" />
        </span><br />
        <span class="form_label">Ngôn ngữ:</span>
        <span class="form_item">
            <input type="radio" name="config[language]" value="en"';
            if(LANGUAGE == 'en'){
                echo ' checked="checked" ';
            } 
            echo '/> English 
            <input type="radio" name="config[language]" value="vi"';
            if(LANGUAGE == 'vi'){
                echo ' checked="checked" ';
            } 
            echo ' /> Việt Nam
        </span><br />
        <span class="form_label">Kiểu giờ :</span>
        <span class="form_item">
        <input type="text" name="config[style_time]" class="textbox" value = "'.STYLE_TIME.'" />
        </span><br />
        <span class="form_item">
            <input type="submit" name="btnOK" value="Áp dụng" class="button" />
            <a href = "'.site_url('admin/config/config_default/'.$name).'" class="button" >Mặc định</a>
        </span>
        </span><br />
    </fieldset>
</form>';
?>
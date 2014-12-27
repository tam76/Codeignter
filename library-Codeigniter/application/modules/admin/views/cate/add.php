<?php
echo '
<form action="'.current_url().'" method="post" style="width: 650px;">
    <fieldset>
        <legend>Thông Tin Danh Mục</legend>';
        echo validation_errors();
        echo '
        <div>
        <span class="form_label">Tên danh mục:</span>
        <span class="form_item">
            <input type="text" name="txtCate" class="textbox"';
            if (isset($_POST["txtCate"])) {
                echo ' value="' .htmlspecialchars($_POST["txtCate"]). '"';
            }
            echo ' />
            <input type="button" name="btnadd" value="Thêm từ khóa" />
        </span><br />';
            if (isset($data['tag']) && !empty($data['tag'])){
                foreach($data['tag'] as $val){
                    echo '<div><span class="form_label">Từ khóa :</span><span class="form_item"><input type="text" name="txttag[]" class="textbox" value = "'.$val.'"/><input type="button" name="btndel" value="Xóa" /></ span></div>';
                }
            }
        echo '</div>
        <span class="form_label"></span>
        <span class="form_item">
            <input type="submit" name="btnCateAdd" value="Thêm danh mục" class="button" />
        </span>
    </fieldset>
</form>';
?>
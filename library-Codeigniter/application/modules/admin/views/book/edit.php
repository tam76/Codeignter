<?php
echo'
<form action= "'.current_url().'" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Thông Tin Sách</legend>';
        if(isset($error)) {
           echo ($error) ;
        }
        echo '
        <span class="form_label">Tiêu đề:</span>
        <span class="form_item">';
            echo '<b>'.$data['book_title'].'</b>';
        echo '</span><br />
        <span class="form_label">Danh mục:</span>
        <span class="form_item">
            <select name="sltCate" id="sel_change">
                <option value="none">Chọn danh mục</option>
                '.$cate.'
            </select>
        </span><br />
        <span class="form_label">Từ khóa:</span>
        <span class="form_item">
            <select name="sltKey[]" size="4" multiple="yes" id = "key">
            </select>
        </span><br />
        <span class="form_label">Tác giả:</span>
        <span class="form_item">
            <input type="text" name="txtAuthor" class="textbox"';
            if (isset($_POST["txtAuthor"])) {
                echo ' value="' .$_POST["txtAuthor"]. '"';
            }else{
                echo ' value="' .$data['author']. '"';
            }
            echo ' />
        </span><br />
        <span class="form_label">Nhà xuất bản:</span>
        <span class="form_item">
            <input type="text" name="txtPublisher" class="textbox"';
            if (isset($_POST["txtPublisher"])) {
                echo ' value="' .$_POST["txtPublisher"]. '"';
            }else{
                echo  ' value="' .$data['publisher']. '"';
            }
            echo ' />
        </span><br />
        <span class="form_label">Giá sách:</span>
        <span class="form_item">
            <input type="text" name="txtCost" class="textbox"';
            if (isset($_POST["txtCost"])) {
                echo ' value="' .$_POST["txtCost"]. '"';
            }else{
                echo ' value="' .$data['cost']. '"';
            }
            echo ' />.000 VNĐ
        </span><br />
        <span class="form_label">Năm xuất bản:</span>
        <span class="form_item">
            <select name="sltDate">
                <option value="0">Chọn năm</option>';
                for($i=1990;$i<=getdate()['year'];$i++) {
                    echo '<option value="' .$i. '"';
                    if (isset($_POST["sltDate"]) && $_POST["sltDate"] == $i) {
                        echo ' selected="selected"';
                    }elseif($data['book_date'] == $i){
                        echo ' selected="selected"';
                    }
                    echo '>' .$i. '</option>';
                }
                echo '
            </select>
        </span><br />
        <span class="form_label">Mô tả :</span>
        <span class="form_item">
			<span class="right">
                <textarea id="txt_content" name="txtDescription"  style="width:100%; height:200px;">';
                if (isset($_POST["txtDescription"])) {
                    echo $_POST["txtDescription"];
                }else{
                    echo $data['description'];
                }
                echo '</textarea>
            </span>
        </span><br />
        <span class="form_label"> </span>
        <span class="form_item">
        <img src = "' .base_url(IMG_UPOAD_PATH.$data['book_img']).'" width = "300px" />        
        </span><br />
        <span class="form_label"></span>
        <span class="form_item">
            <input type="button" name="btnimgbook" value="Đổi hình sách" />
        </span><br />
        <span class="form_label"></span>
        <span class="form_item">
            <input type="button" name="btnbook" value="Đổi sách" />
        </span><br />
        <span class="form_label">Công bố:</span>
        <span class="form_item">
            <input type="radio" name="rdoPublic" value="Y"';
            if($data["book_public"] == 'Y'){
                echo ' checked="checked" ';
            } 
            echo '/> Có 
            <input type="radio" name="rdoPublic" value="N"';
            if($data["book_public"] == 'N'){
                echo ' checked="checked" ';
            } 
            echo ' /> Không
        </span><br />
        <span class="form_label"></span>
        <span class="form_item">
            <input type="submit" name="btnBookEdit" value="Sửa sách" class="button" />
        </span>
        </span><br />
    </fieldset>
</form>
<script type="text/javascript">
	$(function() {				    				    
		if(CKEDITOR.instances["txt_content"]) {						
			CKEDITOR.remove(CKEDITOR.instances["txt_content"]);
		}
		CKEDITOR.config.width = 600;
	    CKEDITOR.config.height = 150;
		CKEDITOR.replace("txt_content",{});
	})
</script>';
?>
<?php
echo '
<link rel="stylesheet" href="'.base_url().'public/admin/css/jRating.jquery.css" type="text/css" />
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript" src="'.base_url().'public/javascript/jRating.jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".exemple4").jRating({
    	  isDisabled : true
    	});
	});
</script>

<form style="width: 650px;">
    <fieldset>
        <legend>Thông Tin Sách</legend>
        <span class="form_label"> </span>
        <span class="form_item">
        <img src = "' .base_url(IMG_UPOAD_PATH.$data['book_img']).'" width = "300px" />        
        </span><br />
        <span class="form_label">Tên sách :</span>
        <span class="form_item">'.$data['book_title'].'       
        </span><br />
        <span class="form_label">Danh mục :</span>
        <span class="form_item">'.$data['cate_title'].'       
        </span><br />
        <span class="form_label">Từ Khóa :</span>
        <span class="form_item"><ul>';
        if(!empty($book_tag)){
            foreach($book_tag as $val){
                echo '<li>'.$val.'</li>';
        }
        }
        echo '</ul></span><br />
        <span class="form_label">Giá sách :</span>
        <span class="form_item">'.$data['cost'].' .000 VNĐ    
        </span><br />
        <span class="form_label">Tác giả :</span>
        <span class="form_item">'.$data['author'].'       
        </span><br />
        <span class="form_label">Nhà xuất bản :</span>
        <span class="form_item">'.$data['publisher'].'       
        </span><br />
        <span class="form_label">Năm xuất bản :</span>
        <span class="form_item">'.$data['book_date'].'       
        </span><br />
        <span class="form_label">Mô tả :</span>
        <span class="form_item">'.$data['description'].'
        </span><br />
        <span class="form_label">Người đăng :</span>
        <span class="form_item">'.$data['id_create'].'
        </span><br />
        <span class="form_label">Người sửa :</span>
        <span class="form_item">'.$data['id_modify'].'
        </span><br />
        <span class="form_label">Đang mướn :</span>
        <span class="form_item">'.$data['viewing'].'
        </span><br />
        <span class="form_label">Đánh giá :</span>
        <span class="form_item">
        <div class="exemple4" data-average="'.$data['score'].'" ></div>
        </span><br />
        <span class="form_label">Công bố :</span>
        <span class="form_item">';
        if ($data["book_public"] == 'Y') {
                    echo '<img src="'.base_url('public/images/active.png').'" />';
                } else {
                    echo '<img src="'.base_url('public/images/inactive.png').'" />';
                }   
        echo '</span><br />
    </fieldset>
    <span class="form_item">
        <a href= "'.site_url('admin/books/edit/'.$data["bookid"]).'" class = "button" >Sửa sách</a>
    </span>
</form>';
?>
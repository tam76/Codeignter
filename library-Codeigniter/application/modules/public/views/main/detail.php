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
if(!empty($error)){
    echo '<div class="error_msg"><ul>'.$error.'</ul></div>';
}
if(isset($data)){
    $id     = $data[0]['id'];
    $cid    = $data[0]['cid'];
    $title  = $data->TITLE[0];
    $img    = $data->IMG[0];
    $gia    = $data->COST;
    $score  = $data->SCORE;
    $tag    = $data->TAG;
    $array  = array('id'=> "$id","cid"=>"$cid");
    $json   = json_encode($array);
    $list   = $this->book->BookCache($cid,3,0,$id);
    echo '
    <link rel="stylesheet" href="public/public/css/jquery.tag-editor.css">
    <script type="text/javascript" src="'.base_url('public/javascript/jquery-ui.js').'"></script>
    <script type="text/javascript" src="'.base_url('public/javascript/jquery.caret.min.js').'"></script>
    <script type="text/javascript" src="public/javascript/jquery.tag-editor.min.js"></script>
    
    <h1 style="line-height: 60px;"><mark>'.$title.'</mark></h1>
    <div id="detail">
        <div id="detail_img" class="text-center col-md-4">
            <img src="'.base_url(IMG_UPOAD_PATH .$img). '" class="pic-image" alt="Pic"/>';
            if($link){
                echo '<a href="public/member/read/'.$id.'" class="btn btn-success">Xem sách</a>
                <div class="exemple">
                	<div class="basic" data-average="0" data-id="'.$id.'"></div>
                </div>
                <script type="text/javascript">
                	$(document).ready(function(){
                		$(".basic").jRating();
                	});
                </script>';
            }else{
                echo '<input type="hidden" class="info" value=\''.$json.'\' />
                    <button type="button" class="btn btn-success addbook">Thêm vào giỏ hàng</button>';
            }
            echo '
            <div id="qrcode">
                <img src="http://api.qrserver.com/v1/create-qr-code/?data='. $title .'&size=200x200" alt="QR code - '.$title.'"/>
            </div>
        </div>
        <div id="detail_info" class="col-md-7">
            <div>
                <h3><span class="label label-info">Thông tin chi tiết</span></h3>
                <h5>Tên sách : '.$title.'</h5>
                <h5>Danh mục : '.$this->category->SelectTitle($cid).'</h5>
                <h5>Tác giả : '.$data->AUTHOR.'</h5>
                <h5>Nhà xuất bản : '.$data->PUBLISHER.'</h5>
                <h5>Năm xuất bản : '.$data->DATE.'</h5>
                <h5>Từ Khóa : <span id="demo6"></span></h5>
            </div>
            <div>
                <h3><span class="label label-info">Đánh giá</span></h3>
                <h5>Có '.$data->VOTES.' lượt bình chọn</h5>
                <div class="exemple4" data-average="'.$score.'" ></div>
            </div>
            <div>
                <h3><span class="label label-info">Mô tả của sách</span></h3>
                '.$data->DESCRIPTION.'
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div>';
    $stt = 1;
    foreach ($list as $bookitem) {
        // Nếu những tin nằm trong đoạn cần show thì mới show
        $id     = $bookitem['bookid'];
        $cid    = $bookitem['cateid'];
        $cate_title = $this->category->SelectTitle($cid);
        $title  = $bookitem['book_title'];
        $img    = $bookitem['book_img'];
        $gia    = $bookitem['cost'];
        $data   = array('id'=> "$id","cid"=>"$cid");
        $json   = json_encode($data);
        if(strlen($title)>35){
            $title = substr($title,0,35);
            $title = substr($title,0,strrpos($title,' '))." ...";
        }
        if($stt == 3){
            echo '<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">';
        }else{
            echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">';
        }
        echo '
            <div class="news">
                <h1>'.$title.'</h1>
                <div class="pic pic-3d">
            	    <img src="'.base_url(IMG_UPOAD_PATH .$img). '" class="pic-image" alt="Pic"/>
            	    <span class="pic-caption open-up">
                        <span class="button_new">
                            <a href="'.$cid.'-'.unicode($cate_title).'/'.$id.'-'.unicode($bookitem['book_title']).'.html" class="btn btn-success">Chi tiết</a>
                            <input type="hidden" class="info" value=\''.$json.'\' />
                            <button type="button" class="btn btn-success addbook">Thêm vào giỏ hàng</button>
                        </span>
            	    </span>
                </div>
                <div class="exemple4" data-average="'.$bookitem["score"].'" ></div>
                <label class ="form_label">';
                if($gia==0) {
                    echo "miễn phí";
                } else {
                    echo $gia.'.000 Đ/tuần';
                }echo
                '</label>
                <div class="clearfix"></div>
            </div>
    	</div>';
        $stt ++;
    }
    echo '</div>
    
    <script type="text/javascript">
        $("#demo6").tagEditor({
            initialTags: '.$tag.',
            onChange: tag_classes
        });
        
        function tag_classes(field, editor, tags) {
            $("li", editor).each(function(){
                var li = $(this);
                if (li.find(".tag-editor-tag").html() == "red") li.addClass("red-tag");
                else if (li.find(".tag-editor-tag").html() == "green") li.addClass("green-tag")
                else li.removeClass("red-tag green-tag");
            });
        }
        
    </script>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$(".exemple4").jRating({
        	  isDisabled : true
        	});
    	});
    </script>';
}
?>
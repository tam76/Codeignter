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
if(isset($error)){
    echo '<div class="error_msg"><ul>'.$error.'</ul></div>';
}
if(isset($data)){
    foreach ($data as $bookitem) {
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
        echo '
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
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
    }
echo '
<script type="text/javascript">
	$(document).ready(function(){
		$(".exemple4").jRating({
    	  isDisabled : true
    	});
	});
</script></div>';
}
?>
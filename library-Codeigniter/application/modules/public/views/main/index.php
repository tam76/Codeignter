<?php
/*$newstring = ' abcdef abcdef';
echo $pos = strrpos($newstring, ' '); // $pos = 7, not 0*/
echo '<ul class="nav nav-pills">
          <li role="presentation"><a href="#" class="list" data-type="home">Sách mới</a></li>
          <li role="presentation"><a href="#" class="list" data-type="hot">Sách hot</a></li>
          <li role="presentation"><a href="#" class="list" data-type="rate">Đánh giá cao</a></li>
        </ul><div id="cover">';
foreach ($data as $bookitem) {
    // Nếu những tin nằm trong đoạn cần show thì mới show
    $id = $bookitem[0]['id'];
    $cid = $bookitem[0]['cid'];
    $cate_title = $this->category->SelectTitle($cid);
    $title = $bookitem->TITLE;
    $img = $bookitem->IMG[0];
    $gia = $bookitem->COST;
    $data = array('id'=> "$id","cid"=>"$cid");
    $json = json_encode($data);
    if(strlen($title)>30){
        $title = substr($title,0,30);
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
                        <a href="'.$cid.'-'.unicode($cate_title).'/'.$id.'-'.unicode($bookitem->TITLE).'.html" class="btn btn-success">Chi tiết</a>
                        <input type="hidden" class="info" value=\''.$json.'\' />
                        <button type="submit" class="btn btn-success addbook">Thêm vào giỏ hàng</button>
                    </span>
        	    </span>
            </div>
            <div class="exemple4" data-average="'.$bookitem->SCORE.'" ></div>
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
?>
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
if(!empty($data)) {
    foreach($data as $key=>$bookitem){
        $tg = $date[$key] - time();
        $tuan = floor($tg/604800);
        $ngay = ceil(($tg%604800)/86400);
        $id = $bookitem['bookid'];
        $img = $bookitem['book_img'];
        $title = $bookitem['book_title'];
        $gia = $bookitem['cost'];
        $cateid = $bookitem["cateid"];
        $cate_title = $this->category->SelectTitle($cateid);
        if(strlen($title)>30){
            $title = substr($title,0,30);
            $title = substr($title,0,strrpos($title,' '))." ...";
        }
        if(!$bookitem["score"]){
            $bookitem["score"] = '0';
        }
        echo '
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <div class="news">
                <h1>' .$title. '</h1>
                <div class="pic pic-3d">
                    <img src="'.base_url(IMG_UPOAD_PATH .$img). '" class="pic-image" alt="Pic"/>
                    <span class="pic-caption open-up">
                        <span class="button_new">
                            <a href="'.$cateid.'-'.unicode($cate_title).'/'.$id.'-'.unicode($bookitem['book_title']).'.html" class="btn btn-success">Chi tiết</a>
                            <a href="public/member/read/'.$id.'" class="btn btn-success">Xem sách</a>
                        </span>
            	    </span>
                </div>
                <div class="exemple4" data-average="'.$bookitem["score"].'" ></div>
                <label class ="form_label">';
                if($tuan < 1 ) {
                    echo "còn " .abs($ngay). " ngày";
                } else {
                    echo "còn " .$tuan. " tuần, " .$ngay. " ngày";
                }echo
                '</label>
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
    </script>';
}
?>
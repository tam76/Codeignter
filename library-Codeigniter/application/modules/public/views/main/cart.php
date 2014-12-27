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
echo ' <form class="text-center" id="fCart" name="fCart" action ="'.current_url().'" method="post">';
if(!empty($error)){
    echo '<div class="error_msg"><ul>'.$error.'</ul></div>';
}
if(!empty($cart)) {
    $stt = 0;
    foreach($cart as $key=>$bookitem){
        $id = $bookitem[0]['id'];
        $cid = $bookitem[0]['cid'];
        $img = $bookitem->IMG;
        $cate_title = $this->category->SelectTitle($cid);
        $title = $bookitem->TITLE;
        $gia = $bookitem->COST;
        if(strlen($title)>30){
            $title = substr($title,0,30);
            $title = substr($title,0,strrpos($title,' '))." ...";
        }
        echo '
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <div class="news">
                <h1>' .$title. '</h1>
                <div class="pic pic-3d">
            	    <img src="'.base_url(IMG_UPOAD_PATH .$img). '" class="pic-image" alt="Pic"/>
            	    <span class="pic-caption open-up">
                        <span class="button_new">
                            <a href="'.$cid.'-'.unicode($cate_title).'/'.$id.'-'.unicode($bookitem->TITLE).'.html" class="btn btn-success">Chi tiết</a>
                        </span>
            	    </span>
                </div>
                <label class ="form_label">';
                if($gia==0) {
                    echo "miễn phí";
                } else {
                    echo $gia.'.000 Đ/tuần';
                }echo
                '</label>
                <input type="text" maxlength="1" class ="soluong" name = "book[txttg][]" value="';
                if(!empty($tg[$stt])){
                    echo $tg[$stt];
                }else{echo 1;}
                echo'" />Tuần
                <input type="hidden" name = "book[id][]" value=\''.$key.'\' />
                <button type="button" class="btn btn-success delbook">Xóa khỏi giỏ hàng</button>
            </div>
        </div>';
    }
}
if($this->session->userdata('cart') != false){
    echo '
    <div class="clearfix"></div>
    <input type="submit" name="btnbuy" value="Thuê sách" class="btn btn-success" />';
}
echo '</form>';
?>
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
echo '<form action="'.current_url().'" method=post>';
if(isset($error)){
    echo '<div class="error_msg"><ul>'.$error.'</ul></div>';
}
    echo '<h3><span class="label label-info">Hiện tại bạn đang có ';
    echo $this->session->userdata('property').'.000 VNĐ:</span></h3><br />
    <span class="form_label app">Tiền nạp :</span>
    <span class="form_item">
        <input type="text" name="txtMoney" maxlength="1" class = "soluong form-control"';
        if (isset($_POST["txtMoney"])) {
            echo ' value="' .htmlspecialchars($_POST["txtMoney"]). '"';
        }
        echo ' />.000 VNĐ
    </span><br />
    <span class="form_label app">Mã xác nhận:</span>
    <span class="form_item">
        <input type="text" name="txtCaptcha" maxlength="10" class="textbox form-control" style="width: 100px;"/>'.$img.'
    </span><br />
    <span class="form_item">
        <input type="submit" name="btnOK" value="Đồng ý" class="btn btn-success" />
    </span>';
    if(!empty($history)){
        echo '<fieldset style="width: 400px;" class="table-responsive">
            <legend>Lịch sử nạp tiền</legend>
                <table class="table table-hover">
                    <tr>
                        <td>STT</td>
                        <td>Tiền nạp</td>
                        <td>Thời gian nạp</td>
                    </tr>';
                $stt = 1;
                foreach($history as $val){
                    echo '
                    <tr>
                        <td>'.$stt.'</td>
                        <td>'.$val['money'].'</td>
                        <td>'.$val['date'].'</td>
                    </tr>';
                    $stt++;
                }
        echo '</table></fieldset>';
    }
echo '</form>';
?>
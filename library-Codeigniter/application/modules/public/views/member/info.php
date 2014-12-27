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
echo '
<script type="text/javascript" src="'.base_url('public/javascript/jquery-ui.js').'"></script>
<script type="text/javascript">
$(function() {
$.datepicker.regional["vi"] = {
closeText: "Đóng",
prevText: "&#x3c;Trước",
nextText: "Tiếp&#x3e;",
currentText: "Hôm nay",
monthNames: [" Tháng Một", "Tháng Hai", "Tháng Ba", "Tháng Tư", "Tháng Năm", "Tháng Sáu",
"Tháng Bảy", "Tháng Tám", "Tháng Chín", "Tháng Mười", "Tháng Mười Một", "Tháng Mười Hai"],
monthNamesShort: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6",
"Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
dayNames: ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"],
dayNamesShort: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
weekHeader: "Tu",
dateFormat: "dd/mm/yy",
firstDay: 0,
isRTL: false,
showMonthAfterYear: false,
yearSuffix: ""};
$.datepicker.setDefaults($.datepicker.regional["vi"]);
$(".datepicker").datepicker();
}); 
</script>
<script type="text/javascript" src="'.base_url('public/javascript/myscript.js').'"></script>
<form action= "'.current_url().'" method="post" style="width: 600px;" enctype="multipart/form-data">';
if(isset($error)){
    echo '<div class="error_msg"><ul>'.$error.'</ul></div>';
}
    echo '<fieldset>
        <legend>Thông Tin Cá Nhân</legend>
        <span class="form_label app">Avata :</span>
        <span class="form_item">
        <img src = "'.base_url(AVATA_UPOAD_PATH.$avata).'" alt = "avata" class="img-rounded" />        
        </span><br />
        <span class="form_label app"></span>
        <span class="form_item">
            <input type="button" name="btnimg" value="Đổi avata" class="btn btn-primary" />
        </span><br />
        <span class="form_label app">Họ và tên:</span>
        <span class="form_item">
            <input type="text" name="txtName" class="textbox form-control"';
            if (isset($_POST["txtName"])) {
                echo ' value="' .htmlspecialchars($_POST["txtName"]). '"';
            }elseif (isset($info->name)) {
                echo ' value="' .htmlspecialchars($info->name). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label app">Giới tính:</span>
        <span class="form_item">
            <select name="sltGT" class="form-control">
                <option value="0">Chọn giới tính</option>
                <option value="1" ';
                if (isset($_POST["sltGT"]) && $_POST["sltGT"] == 1) {
                    echo ' selected = selected';
                }elseif (isset($info->gt) && $info->gt == 1) {
                    echo '  selected = selected ';
                }
                echo '>Nam</option>
                <option value="2" ';
                if (isset($_POST["sltGT"]) && $_POST["sltGT"] == 2) {
                    echo ' selected = selected';
                }elseif (isset($info->gt) && $info->gt == 2) {
                    echo '  selected = selected ';
                }
                echo '>Nữ</option>
            </select>
        </span><br />
        <span class="form_label app">Ngày sinh:</span>
        <span class="form_item">
            <input type="text" name="txtNS"  id="txt" class="datepicker form-control"';
            if (isset($_POST["txtNS"])) {
                echo ' value="' .$_POST["txtNS"]. '"';
            }elseif (isset($info->birthday)) {
                echo ' value="' .htmlspecialchars($info->birthday). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label app">Địa chỉ:</span>
        <span class="form_item">
            <input type="text" name="txtAddress" class="textbox form-control"';
            if (isset($_POST["txtAddress"])) {
                echo ' value="' .$_POST["txtAddress"]. '"';
            }elseif (isset($info->address)) {
                echo ' value="' .htmlspecialchars($info->address). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label app">Điện thoại:</span>
        <span class="form_item">
            <input type="text" name="txtNumber" class="textbox form-control"';
            if (isset($_POST["txtNumber"])) {
                echo ' value="' .$_POST["txtNumber"]. '"';
            }elseif (isset($info->number)) {
                echo ' value="' .htmlspecialchars($info->number). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label app">Di động:</span>
        <span class="form_item">
            <input type="text" name="txtPhone" class="textbox form-control"';
            if (isset($_POST["txtPhone"])) {
                echo ' value="' .$_POST["txtPhone"]. '"';
            }elseif (isset($info->phone)) {
                echo ' value="' .htmlspecialchars($info->phone). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label app">Số cmnd:</span>
        <span class="form_item">
            <input type="text" name="txtID" class="textbox form-control"';
            if (isset($_POST["txtID"])) {
                echo ' value="' .$_POST["txtID"]. '"';
            }elseif (isset($info->id)) {
                echo ' value="' .htmlspecialchars($info->id). '"';
            }
            echo ' />
        </span>
    </fieldset>
    <span class="form_item">
        <input type="submit" name="btnUserEdit" value="Thay đổi thông tin" class="btn btn-success" />
    </span>
</form>';
?>
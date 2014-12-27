<?php
echo '
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
<form action= "'.current_url().'" method="post" style="width: 650px;" enctype="multipart/form-data">
    <fieldset>
        <legend>Thông Tin User</legend>
        <span class="form_label">Username:</span>
        <span class="form_item">
            <b>' .$data['username']. '</b>
        </span><br />
        <span class="form_label">Password:</span>
        <span class="form_item">
            <input type="password" name="txtPass" class="textbox" />
        </span><br />
        <span class="form_label">Confirm password:</span>
        <span class="form_item">
            <input type="password" name="txtRepass" class="textbox" />
        </span><br />
        <span class="form_label">Email:</span>
        <span class="form_item">
            <input type="text" name="txtEmail" class="textbox"';
            if (isset($_POST["txtEmail"])) {
                echo ' value="' .$_POST["txtEmail"]. '"';
            }else{
                echo ' value="' .$data['email']. '"'; 
            }
            echo ' />
        </span><br />
        <span class="form_label">Level:</span>
        <span class="form_item">
            <input type="radio" name="rdoLevel" value="1" ';
            if($data['level'] == 1){
                echo 'checked="checked"';
            }
            echo '/> Admin 
            <input type="radio" name="rdoLevel" value="2" ';
            if($data['level'] == 2){
                echo 'checked="checked"';
            }
            echo ' /> Mod
        </span><br />
    </fieldset>
    <fieldset>
        <legend>Thông Tin Cá Nhân</legend>
        <span class="form_label">Avata :</span>
        <span class="form_item">
        <img src = "'.base_url(AVATA_UPOAD_PATH.$data['avata']).'" />        
        </span><br />
        <span class="form_label"></span>
        <span class="form_item">
            <input type="button" name="btnimg" value="Đổi avata" />
        </span><br />
        <span class="form_label">Họ và tên:</span>
        <span class="form_item">
            <input type="text" name="txtName" class="textbox"';
            if (isset($_POST["txtName"])) {
                echo ' value="' .htmlspecialchars($_POST["txtName"]). '"';
            }elseif (isset($info->name)) {
                echo ' value="' .htmlspecialchars($info->name). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label">Giới tính:</span>
        <span class="form_item">
            <select name="sltGT">
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
        <span class="form_label">Ngày sinh:</span>
        <span class="form_item">
            <input type="text" name="txtNS"  id="txt" class="datepicker"';
            if (isset($_POST["txtNS"])) {
                echo ' value="' .$_POST["txtNS"]. '"';
            }elseif (isset($info->birthday)) {
                echo ' value="' .htmlspecialchars($info->birthday). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label">Địa chỉ:</span>
        <span class="form_item">
            <input type="text" name="txtAddress" class="textbox"';
            if (isset($_POST["txtAddress"])) {
                echo ' value="' .$_POST["txtAddress"]. '"';
            }elseif (isset($info->address)) {
                echo ' value="' .htmlspecialchars($info->address). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label">Điện thoại:</span>
        <span class="form_item">
            <input type="text" name="txtNumber" class="textbox"';
            if (isset($_POST["txtNumber"])) {
                echo ' value="' .$_POST["txtNumber"]. '"';
            }elseif (isset($info->number)) {
                echo ' value="' .htmlspecialchars($info->number). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label">Di động:</span>
        <span class="form_item">
            <input type="text" name="txtPhone" class="textbox"';
            if (isset($_POST["txtPhone"])) {
                echo ' value="' .$_POST["txtPhone"]. '"';
            }elseif (isset($info->phone)) {
                echo ' value="' .htmlspecialchars($info->phone). '"';
            }
            echo ' />
        </span><br />
        <span class="form_label">Số cmnd:</span>
        <span class="form_item">
            <input type="text" name="txtID" class="textbox"';
            if (isset($_POST["txtID"])) {
                echo ' value="' .$_POST["txtID"]. '"';
            }elseif (isset($info->id)) {
                echo ' value="' .htmlspecialchars($info->id). '"';
            }
            echo ' />
        </span>
    </fieldset>
    <span class="form_item">
        <input type="submit" name="btnUserEdit" value="Sửa user" class="button" />
    </span>
</form>';
?>
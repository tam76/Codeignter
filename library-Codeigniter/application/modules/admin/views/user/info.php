<?php
echo '
<form style="width: 650px;">
    <fieldset>
        <legend>Thông Tin User</legend>
        <span class="form_label">Username :</span>
        <span class="form_item">'.$data['username'].'
        </span><br />
        <span class="form_label">Level :</span>
        <span class="form_item">'.$data['level'].'
        </span><br />
        <span class="form_label">Email :</span>
        <span class="form_item">'.$data['email'].'
        </span><br />
        <span class="form_label">Tài khoản :</span>
        <span class="form_item">'.$data['property'].'
        </span><br />
        <span class="form_label">Ngày đăng kí :</span>
        <span class="form_item">'.$data['register_date'].'
        </span><br />
        <span class="form_label">IP đăng kí :</span>
        <span class="form_item">'.$data['register_ip'].'
        </span><br />
        <span class="form_label">Ngày đăng nhập :</span>
        <span class="form_item">'.$data['visited_date'].'
        </span><br />
        <span class="form_label">IP đăng nhập :</span>
        <span class="form_item">'.$data['visited_ip'].'
        </span><br />
        <span class="form_label">Trạng thái :</span>
        <span class="form_item">';
        if ($data["status"] == 1){
            echo '<img src="'.base_url('public/images/active.png').'" />';
        }else{
            echo '<img src="'.base_url('public/images/inactive.png').'" />';
        }
        echo '</span><br />
    </fieldset>
    <fieldset>
        <legend>Thông Tin Cá Nhân</legend>
        <span class="form_label">Avata :</span>
        <span class="form_item">
        <img src = "'.base_url(AVATA_UPOAD_PATH.$data['avata']).'" />        
        </span><br />
        <span class="form_label">Họ và tên:</span>
        <span class="form_item">';
        if(isset($info->name)){
            echo $info->name;
        }
        echo '</span><br />
        <span class="form_label">Giới tính:</span>
        <span class="form_item">';
        if(isset($info->gt)){
            if($info->gt==1){
                echo 'Nam';
            }elseif($info->gt==2){
                echo 'Nữ';
            }
        }
        echo '</span><br />
        <span class="form_label">Ngày sinh:</span>
        <span class="form_item">';
        if(isset($info->birthday)){
            echo $info->birthday;
        }
        echo '</span><br />
        <span class="form_label">Địa chỉ:</span>
        <span class="form_item">';
        if(isset($info->address)){
            echo $info->address;
        }
        echo '</span><br />
        <span class="form_label">Điện thoại:</span>
        <span class="form_item">';
        if(isset($info->number)){
            echo $info->number;
        }
        echo '
        </span><br />
        <span class="form_label">Di động:</span>
        <span class="form_item">';
        if(isset($info->phone)){
            echo $info->phone;
        }
        echo '
        </span><br />
        <span class="form_label">Số cmnd:</span>
        <span class="form_item">';
        if(isset($info->id)){
            echo $info->id;
        }
        echo '
        </span>
    </fieldset>
    <span class="form_item">
        <a href= "'.site_url('admin/users/edit/'.$data["userid"]).'" class = "button" >Sửa user</a>
    </span>
</form>';
?>
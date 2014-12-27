<?php
if($this->uri->segment(4) == 'username'){
    if($this->uri->segment(5) == 'DESC'){
        $username = '<a href = "'.site_url('admin/users/index/username/ASC/'.$this->uri->segment(6)).'" >Username<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $username = '<a href = "'.site_url('admin/users/index/username/DESC/'.$this->uri->segment(6)).'" >Username<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $username = '<a href = "'.site_url('admin/users/index/username/DESC/').'" >Username</a>';
}
if($this->uri->segment(4) == 'level'){
    if($this->uri->segment(5) == 'DESC'){
        $level = '<a href = "'.site_url('admin/users/index/level/ASC/'.$this->uri->segment(6)).'" >Level<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $level = '<a href = "'.site_url('admin/users/index/level/DESC/'.$this->uri->segment(6)).'" >Level<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $level = '<a href = "'.site_url('admin/users/index/level/DESC/').'" >Level</a>';
}
if($this->uri->segment(4) == 'email'){
    if($this->uri->segment(5) == 'DESC'){
        $email = '<a href = "'.site_url('admin/users/index/email/ASC/'.$this->uri->segment(6)).'" >Email<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $email = '<a href = "'.site_url('admin/users/index/email/DESC/'.$this->uri->segment(6)).'" >Email<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $email = '<a href = "'.site_url('admin/users/index/email/DESC/').'" >Email</a>';
}
if($this->uri->segment(4) == 'visited_date'){
    if($this->uri->segment(5) == 'DESC'){
        $visited_date = '<a href = "'.site_url('admin/users/index/visited_date/ASC/'.$this->uri->segment(6)).'" >Visited_date<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $visited_date = '<a href = "'.site_url('admin/users/index/visited_date/DESC/'.$this->uri->segment(6)).'" >Visited_date<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $visited_date = '<a href = "'.site_url('admin/users/index/visited_date/DESC/').'" >Visited_date</a>';
}
if($this->uri->segment(4) == 'property'){
    if($this->uri->segment(5) == 'DESC'){
        $property = '<a href = "'.site_url('admin/users/index/property/ASC/'.$this->uri->segment(6)).'" >Tài khoản<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $property = '<a href = "'.site_url('admin/users/index/property/DESC/'.$this->uri->segment(6)).'" >Tài khoản<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $property = '<a href = "'.site_url('admin/users/index/property/DESC/').'" >Tài khoản</a>';
}
if($this->uri->segment(4) == 'status'){
    if($this->uri->segment(5) == 'DESC'){
        $status = '<a href = "'.site_url('admin/users/index/status/ASC/'.$this->uri->segment(6)).'" >Trạng thái<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $status = '<a href = "'.site_url('admin/users/index/status/DESC/'.$this->uri->segment(6)).'" >Trạng thái<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $status = '<a href = "'.site_url('admin/users/index/status/DESC/').'" >Trạng thái</a>';
}
echo '<table class="list_table">
    <tr class="list_heading">
        <td class="id_col">STT</td>
        <td>'.$username.'</td>
        <td>'.$level.'</td>
        <td>'.$email.'</td>
        <td>'.$visited_date.'</td>
        <td>'.$property.'</td>
        <td>'.$status.'</td>
        <td class="action_col">Quản lý</td>
    </tr>';
    // Lấy tất cả user đổ ra trang
    if (!$data) {
        echo '
        <tr class="list_data">
            <td colspan="4" class="aligncenter">Chưa có dữ liệu</td>
        </tr>';
    } else {
        $stt = 0;
        foreach ($data as $item) {
            $stt++;
            echo '
            <tr class="list_data">
                <td class="alignright">' .$stt. '</td>
                <td>' .$item["username"]. '</td>
                <td>';
                if ($item["userid"] == 2) {
                    echo '<img src="'.base_url('public/images/super_admin.png').'" width="16px" align="absmiddle" /> <span style="color: red; font-weight: bolder;">Super admin</span>';
                } elseif ($item["level"] == 1) {
                    echo '<b>Admin</b>';
                } elseif ($item["level"] == 2) {
                    echo '<b>Mod</b>';
                } else {
                    echo 'Member';
                }
                echo '</td>
                <td>' .$item["email"]. '</td>
                <td>' .$item["visited_date"]. '</td>
                <td>' .$item["property"]. '</td>
                <td>';
                if ($item["status"] == 1){
                    echo '<a href = "'.site_url('admin/users/active/inactive/'.$item["userid"]).'" ><img src="'.base_url('public/images/active.png').'" /></a>';
                }else{
                    echo '<a href = "'.site_url('admin/users/active/active/'.$item["userid"]).'" ><img src="'.base_url('public/images/inactive.png').'" /></a>';
                }
                echo '</td>
                <td class="aligncenter">
                    <a href= "'.site_url('admin/users/info/'.$item["userid"]).'" ><img src="'.base_url('public/images/info.png').'" /></a>&nbsp;
                    <a href= "'.site_url('admin/users/edit/'.$item["userid"]).'" ><img src="'.base_url('public/images/edit.png').'" /></a>&nbsp;
                    <a href= "'.site_url('admin/users/del/'.$item["userid"]).'" onclick="return (xacnhan(\'Bạn có chắc muốn xóa user thứ ' .$stt. '?\') && xacnhan(\'Bạn có chắc muốn xóa user thứ ' .$stt. '?\'));"><img src="'.base_url('public/images/delete.png').'" /></a>
                </td>
            </tr>
            ';
        }
        echo '<tr><th colspan="8"><div id="paging_nav">'.$this->pagination->create_links().'</div></th></tr>';
    }
    echo '</table>';
?>
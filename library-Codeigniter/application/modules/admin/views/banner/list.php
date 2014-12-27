<?php
if($this->uri->segment(4) == 'title'){
    if($this->uri->segment(5) == 'DESC'){
        $title = '<a href = "'.site_url('admin/banner/index/title/ASC/'.$this->uri->segment(6)).'" >Tên<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $title = '<a href = "'.site_url('admin/banner/index/title/DESC/'.$this->uri->segment(6)).'" >Tên<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $title = '<a href = "'.site_url('admin/banner/index/title/DESC/').'" >Tên</a>';
}
if($this->uri->segment(4) == 'group'){
    if($this->uri->segment(5) == 'DESC'){
        $group = '<a href = "'.site_url('admin/banner/index/group/ASC/'.$this->uri->segment(6)).'" >Group<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $group = '<a href = "'.site_url('admin/banner/index/group/DESC/'.$this->uri->segment(6)).'" >Group<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $group = '<a href = "'.site_url('admin/banner/index/group/DESC/').'" >Group</a>';
}
if($this->uri->segment(4) == 'status'){
    if($this->uri->segment(5) == 'DESC'){
        $status = '<a href = "'.site_url('admin/banner/index/status/ASC/'.$this->uri->segment(6)).'" >Trạng thái<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $status = '<a href = "'.site_url('admin/banner/index/status/DESC/'.$this->uri->segment(6)).'" >Trạng thái<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $status = '<a href = "'.site_url('admin/banner/index/status/DESC/').'" >Trạng thái</a>';
}
echo '
<table class="list_table">
    <tr class="list_heading">
        <td class="id_col">STT</td>
        <td>'.$title.'</td>
        <td>'.$group.'</td>
        <td>Ngày tạo</td>
        <td>Người tạo</td>
        <td>'.$status.'</td>
        <td class="action_col">Quản lý</td>
    </tr>';
    if (!$data) {
        echo '
        <tr class="list_data">
            <td colspan="3" class="aligncenter">Chưa có danh mục</td>
        </tr>';
    } else {
        $stt = 0;
        foreach($data as $item) {
            $stt++;
            echo '
            <tr class="list_data">
                <td class="alignright">' .$stt. '</td>
                <td>' .$item["title"]. '</td>
                <td>' .$item["group"]. '</td>
                <td>' .$item["time_create"]. '</td>
                <td>' .$item["username"]. '</td>
                <td>';
                if ($item["status"] == 1){
                    echo '<a href = "'.site_url('admin/banner/active/inactive/'.$item["id"]).'" ><img src="'.base_url('public/images/active.png').'" /></a>';
                }else{
                    echo '<a href = "'.site_url('admin/banner/active/active/'.$item["id"]).'" ><img src="'.base_url('public/images/inactive.png').'" /></a>';
                }
                echo '</td>
                <td class="aligncenter">
                    <a href= "'.site_url('admin/banner/edit/'.$item["id"]).'" ><img src="'.base_url('public/images/edit.png').'" /></a>
                    <a href= "'.site_url('admin/banner/del/'.$item["id"]).'" onclick="return xacnhan(\'Bạn có chắc muốn xóa danh mục có STT là ' .$stt. ' \');"><img src="'.base_url('public/images/delete.png').'" /></a>
                </td>
            </tr>';
        }
    }
    echo '
</table>';
?>
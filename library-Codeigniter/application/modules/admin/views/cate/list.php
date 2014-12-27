<?php
if($this->uri->segment(4) == 'cate_title'){
    if($this->uri->segment(5) == 'DESC'){
        $cate_title = '<a href = "'.site_url('admin/cate/index/cate_title/ASC/'.$this->uri->segment(6)).'" >Danh mục<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $cate_title = '<a href = "'.site_url('admin/cate/index/cate_title/DESC/'.$this->uri->segment(6)).'" >Danh mục<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $cate_title = '<a href = "'.site_url('admin/cate/index/cate_title/DESC/').'" >Danh mục</a>';
}
echo '
<table class="list_table">
    <tr class="list_heading">
        <td class="id_col">STT</td>
        <td>'.$cate_title.'</td>
        <td>Từ khóa</td>
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
                <td>' .$item["cate_title"];
                $count = $this->book->BookOfCate($item["cateid"]);
                echo '( Có '.$count.'cuốn sách)';
                //$cate->CountNews($item["cateid"]);
                echo '</td>
                <td>' .trim(trim($item["tag"],'['),']'). '</td>
                <td class="aligncenter">
                    <a href= "'.site_url('admin/cate/edit/'.$item["cateid"]).'" ><img src="'.base_url('public/images/edit.png').'" /></a>
                    <a href= "'.site_url('admin/cate/del/'.$item["cateid"]).'" onclick="return xacnhan(\'Bạn có chắc muốn xóa danh mục có STT là ' .$stt. ' \')';
                    if($count>0){
                        echo ' && xacnhan(\'Đã tồn tại sách trong danh mục này bạn có chắc muốn xóa  \')';
                    }
                    echo ';"><img src="'.base_url('public/images/delete.png').'" /></a>
                </td>
            </tr>';
        }
        echo '<tr><th colspan="8"><div id="paging_nav">'.$this->pagination->create_links().'</div></th></tr>';
    }
    echo '
</table>';
?>
<?php
if($this->uri->segment(4) == 'book_title'){
    if($this->uri->segment(5) == 'DESC'){
        $book_title = '<a href = "'.site_url('admin/books/index/book_title/ASC/'.$this->uri->segment(6)).'" >Tiêu đề<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $book_title = '<a href = "'.site_url('admin/books/index/book_title/DESC/'.$this->uri->segment(6)).'" >Tiêu đề<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $book_title = '<a href = "'.site_url('admin/books/index/book_title/DESC/').'" >Tiêu đề</a>';
}
if($this->uri->segment(4) == 'author'){
    if($this->uri->segment(5) == 'DESC'){
        $author = '<a href = "'.site_url('admin/books/index/author/ASC/'.$this->uri->segment(6)).'" >Tác giả<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $author = '<a href = "'.site_url('admin/books/index/author/DESC/'.$this->uri->segment(6)).'" >Tác giả<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $author = '<a href = "'.site_url('admin/books/index/author/DESC/').'" >Tác giả</a>';
}
if($this->uri->segment(4) == 'publisher'){
    if($this->uri->segment(5) == 'DESC'){
        $publisher = '<a href = "'.site_url('admin/books/index/publisher/ASC/'.$this->uri->segment(6)).'" >Nhà xuất bản<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $publisher = '<a href = "'.site_url('admin/books/index/publisher/DESC/'.$this->uri->segment(6)).'" >Nhà xuất bản<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $publisher = '<a href = "'.site_url('admin/books/index/publisher/DESC/').'" >Nhà xuất bản</a>';
}
if($this->uri->segment(4) == 'book_date'){
    if($this->uri->segment(5) == 'DESC'){
        $book_date = '<a href = "'.site_url('admin/books/index/book_date/ASC/'.$this->uri->segment(6)).'" >Năm xuất bản<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $book_date = '<a href = "'.site_url('admin/books/index/book_date/DESC/'.$this->uri->segment(6)).'" >Năm xuất bản<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $book_date = '<a href = "'.site_url('admin/books/index/book_date/DESC/').'" >Năm xuất bản</a>';
}
if($this->uri->segment(4) == 'cate_title'){
    if($this->uri->segment(5) == 'DESC'){
        $cateid = '<a href = "'.site_url('admin/books/index/cate_title/ASC/'.$this->uri->segment(6)).'" >Danh mục<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $cateid = '<a href = "'.site_url('admin/books/index/cate_title/DESC/'.$this->uri->segment(6)).'" >Danh mục<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $cateid = '<a href = "'.site_url('admin/books/index/cate_title/DESC/').'" >Danh mục</a>';
}
if($this->uri->segment(4) == 'score'){
    if($this->uri->segment(5) == 'DESC'){
        $score = '<a href = "'.site_url('admin/books/index/score/ASC/'.$this->uri->segment(6)).'" >Đánh giá<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $score = '<a href = "'.site_url('admin/books/index/score/DESC/'.$this->uri->segment(6)).'" >Đánh giá<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $score = '<a href = "'.site_url('admin/books/index/score/DESC/').'" >Đánh giá</a>';
}
if($this->uri->segment(4) == 'book_public'){
    if($this->uri->segment(5) == 'DESC'){
        $book_public = '<a href = "'.site_url('admin/books/index/book_public/ASC/'.$this->uri->segment(6)).'" >Công bố<img src="'.base_url('public/images/down.png').'" /></a>';
    }else{
        $book_public = '<a href = "'.site_url('admin/books/index/book_public/DESC/'.$this->uri->segment(6)).'" >Công bố<img src="'.base_url('public/images/up.png').'" /></a>';
    }
}else{
    $book_public = '<a href = "'.site_url('admin/books/index/book_public/DESC/').'" >Công bố</a>';
}
echo '
<table class="list_table">
    <tr class="list_heading">
        <td class="id_col">STT</td>
        <td>'.$book_title.'</td>
        <td>'.$author.'</td>
        <td>'.$publisher.'</td>
        <td>'.$book_date.'</td>
        <td>'.$cateid.'</td>
        <td>'.$score.'</td>
        <td>'.$book_public.'</td>
        <td class="action_col">Quản lý</td>
    </tr>';
    // Lấy tất cả danh mục đổ ra trang
    if (!$data) {
        echo '
        <tr class="list_data">
            <td colspan="8" class="aligncenter">Chưa có sách</td>
        </tr>';
    } else {
        $stt = 0;
        foreach($data as $data) {
            $stt++;
            if(empty($data['score'])){
                $data['score'] = 0;
            }
            echo '
            <tr class="list_data">
                <td class="alignright">' .$stt. '</td>
                <td>' .htmlspecialchars($data["book_title"]). '</td>
                <td>';
                if (empty($data["author"])) {
                    echo 'Chưa xác định';
                } else {
                    echo htmlspecialchars($data["author"]);
                }
                echo  '</td>
                <td>';
                if (empty($data["publisher"])) {
                    echo 'Chưa xác định';
                } else {
                    echo htmlspecialchars($data["publisher"]);
                }
                echo  '</td>
                <td>';
                if (empty($data["book_date"])) {
                    echo 'Chưa xác định';
                } else {
                    echo $data["book_date"];
                }
                echo  '</td>
                <td>' .$data["cate_title"]. '</td>
                <td>' .$data["score"]. '</td>
                <td>';
                if ($data["book_public"] == 'Y') {
                    echo '<a href = "'.site_url('admin/books/active/inactive/'.$data["bookid"]).'" ><img src="'.base_url('public/images/active.png').'" /></a>';
                } else {
                    echo '<a href = "'.site_url('admin/books/active/active/'.$data["bookid"]).'" ><img src="'.base_url('public/images/inactive.png').'" /></a>';
                }
                echo '</td>
                <td class="aligncenter">
                    <a href= "'.site_url('admin/books/info/'.$data["bookid"]).'" ><img src="'.base_url('public/images/info.png').'" /></a>
                    <a href= "'.site_url('admin/books/edit/'.$data["bookid"]).'" ><img src="'.base_url('public/images/edit.png').'" /></a>
                    <a href= "'.site_url('admin/books/del/'.$data["bookid"]).'" onclick="return xacnhan(\'Bạn có chắc muốn xóa cuốn sách có STT là ' .$stt. ' \');"><img src="'.base_url('public/images/delete.png').'" /></a>
                </td>
            </tr>';
        }
        echo '<tr><th colspan="8"><div id="paging_nav">'.$this->pagination->create_links().'</div></th></tr>';
    }
    echo '
</table>';
?>
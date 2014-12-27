<?php 
    echo '
    <table class="function_table" style="margin: 0 auto;">
        <tr>
            <td class="function_item user_list">
                <a href="'.site_url("admin/users").'">Quản lý user</a>
            </td>
            <td class="function_item user_add">
                <a href="'.site_url("admin/users/add").'">Thêm user</a>
            </td>
            <td rowspan="2" class="statistics_panel">
                <h3>Thống kê</h3>
                <ul>
                    <li>Tổng số user: ' .$info['user']. '</li>
                    <li>Tổng số danh mục: ' .$info['category']. '</li>
                    <li>Tổng số sách: ' .$info['book']. '</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td class="function_item cate_list">
                <a href="'.site_url("admin/cate").'">Quản lý danh mục: </a>
            </td>
            <td class="function_item cate_add">
                <a href="'.site_url("admin/cate/add").'">Thêm danh mục: </a>
            </td>
        </tr>
        <tr>
            <td  class="function_item book_list">
                <a href="'.site_url("admin/books").'">Quản lý sách</a>
            </td>
            <td class="function_item book_add">
                <a href="'.site_url("admin/books/add").'">Thêm sách</a>
            </td>
            <td class="function_item config">
                <a href="'.site_url("admin/config/setting/general").'">Chung</a>|
                <a href="'.site_url("admin/config/setting/upload_avata").'">Avata</a>|
                <a href="'.site_url("admin/config/setting/upload_book").'">Sách</a>|
                <a href="'.site_url("admin/config/setting/upload_img").'">Hình sách</a>|
                <a href="'.site_url("admin/config/setting/pagination").'">Phân trang</a>|
                <a href="'.site_url("admin/config/setting/banner").'">Banner</a>
            </td>
        </tr>
    </table>';
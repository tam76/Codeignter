$(document).ready(function() {
    // Sự kiện login
    $('#btnLogin').click(function() {
        $('#login_msg').html('<div class="loading"><img src="public/images/loading.gif" /></loading>');
        // bắt lấy username và password
        var user = $('#txtUser').val();
        var pass = $('#txtPass').val();
        $.ajax({
            "url": "index.php/public/main/login",
            "type": "post",
            "data": "user="+user+"&pass="+pass,
            "async": true,
            "success": function(result_login) {
                if (result_login == 'Miss') {
                    $('#login_msg').html('<span class="error">Vui lòng nhập thông tin đầy đủ</span>');
                } else if (result_login == 'Wrong') {
                    $('#login_msg').html('<span class="error">Sai thông tin đăng nhập</span>');
                } else {
                    $('#login_msg').html(result_login);
                    document.fLogin.reset();
                    $('#fLogin').hide();
                    
                    // Hiện lại các phần tử form comment
                    $('#comment_element').show();
                    $('#comment_msg').html('');
                }
            }
        });
        return false;
    });
    // Sự kiện logout
    $(document).on('click', '#login_msg a[title="logout"]', function() {
        $.ajax({
            "url": "index.php/public/main/logout",
            "type": "get",
            "data": "",
            "async": true,
            "success": function(result_logout) {
                if (result_logout == 'Finish') {
                    $('#login_msg').html('');
                    $('#fLogin').show();
                    
                    // Ẩn các phần tử form comment
                    $('#comment_element').hide();
                    $('#comment_msg').html('Vui lòng đăng nhập để post comment');
                }
            }
        });
        return false;
    })
});
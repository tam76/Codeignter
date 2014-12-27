$(document).ready(function(){
    /*----- phần nút -----*/
    $('input[name="btnadd"]').click(function(){
        $(this).parent().parent().append('<div><span class="form_label">Từ khóa :</span><span class="form_item"><input type="text" name="txttag[]" class="textbox"/><input type="button" name="btndel" value="Xóa" /></ span></div>');
    });
    $(document).on('click','input[name="btndel"]',function(){
        $(this).parent().parent().remove();
    });
    $(document).on('click','input[name="btnimg"]',function(){
        $(this).parent().html('<input type="file" name="userfile" class="textbox" /><input type="button" name="btncancel" value="Hủy" class="btn btn-primary" />');
    });
    $(document).on('click','input[name="btncancel"]',function(){
        $(this).parent().html('<input type="button" name="btnimg" value="Đổi avata" class="btn btn-primary"/>');
    });
    $(document).on('click','input[name="btnbook"]',function(){
        $(this).parent().html('<input type="file" name="txtUrl" class="textbox" /><input type="button" name="btncancelbook" value="Hủy" />');
    });
    $(document).on('click','input[name="btncancelbook"]',function(){
        $(this).parent().html('<input type="button" name="btnbook" value="Đổi sách" />');
    });
    $(document).on('click','input[name="btnimgbook"]',function(){
        $(this).parent().html('<input type="file" name="txtImg" class="textbox" /><input type="button" name="btncancelimg" value="Hủy" />');
    });
    $(document).on('click','input[name="btncancelimg"]',function(){
        $(this).parent().html('<input type="button" name="btnimgbook" value="Đổi hình sách" />');
    });
    $( "#sel_change" ).change(function () {
        var cate = "";
        $( "#sel_change option:selected" ).each(function() {
            cate = $( this ).val();
            $.ajax({
                "url":"index.php/key",
                "type":"post",
                "data":"cateid="+cate,
                "async":true,
                "success":function(list_key){
                    $( "#key" ).html(list_key);
                }
            });
            return false;
        });
    })
        .change();
});
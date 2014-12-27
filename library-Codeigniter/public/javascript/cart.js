$(document).ready(function() {
    $('.delbook').click(function() {
        var key = $(this).prev().val();
        $(this).parent().remove();
        $.ajax({
            "url":"index.php/public/main/cart",
            "type":"post",
            "data":"keys="+key,
            "async":true,
            "success":function(){
                document.fCart.reset();
            }
        });
        return false;
    });
});

$(document).on( "click", ".addbook", function() {
    $(this).slideToggle();
    var newid=$(this).prev().val();
    $.ajax({
        "url":"index.php/public/main/cart",
        "type":"post",
        "dataType":"json",
        "data":"newid="+newid,
        "async":true,
        "success":function(){
        }
    });
    return false;
});

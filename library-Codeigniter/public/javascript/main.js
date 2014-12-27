jQuery(document).ready(function($){
	//if you change this breakpoint in the style.css file (or _layout.scss if you use SASS), don't forget to update this value as well
	var MqL = 1170;
	//move nav element position according to window width
	moveNavigation();
	$(window).on('resize', function(){
		(!window.requestAnimationFrame) ? setTimeout(moveNavigation, 300) : window.requestAnimationFrame(moveNavigation);
	});

	//mobile - open lateral menu clicking on the menu icon
	$('.cd-nav-trigger').on('click', function(event){
		event.preventDefault();
		if( $('.cd-main-content').hasClass('nav-is-visible') ) {
			closeNav();
			$('.cd-overlay').removeClass('is-visible');
            $(this).css({
                "left": 0
            });
		} else {
			$(this).addClass('nav-is-visible');
			$('.cd-primary-nav').addClass('nav-is-visible');
			$('.cd-main-header').addClass('nav-is-visible');
			$('.cd-main-content').addClass('nav-is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').addClass('overflow-hidden');
			});
			toggleSearch('close');
			$('.cd-overlay').addClass('is-visible');
            $(this).css({
                "left": $("#cd-primary-nav").width() + 20
            });
		}
	});
	//open search form
	$('.cd-search-trigger').on('click', function(event){
		event.preventDefault();
		toggleSearch();
		closeNav();
	});

	//close lateral menu on mobile 
	$('.cd-overlay').on('swiperight', function(){
		if($('.cd-primary-nav').hasClass('nav-is-visible')) {
			closeNav();
			$('.cd-overlay').removeClass('is-visible');
		}
	});
	$('.nav-on-left .cd-overlay').on('swipeleft', function(){
		if($('.cd-primary-nav').hasClass('nav-is-visible')) {
			closeNav();
			$('.cd-overlay').removeClass('is-visible');
		}
	});
	$('.cd-overlay').on('click', function(){
		closeNav();
		toggleSearch('close')
		$('.cd-overlay').removeClass('is-visible');
	});


	//prevent default clicking on direct children of .cd-primary-nav 
	$('.cd-primary-nav').children('.has-children').children('a').on('click', function(event){
		event.preventDefault();
	});
	//open submenu
	$('.has-children').children('a').on('click', function(event){
		if( !checkWindowWidth() ) event.preventDefault();
		var selected = $(this);
		if( selected.next('ul').hasClass('is-hidden') ) {
			//desktop version only
			selected.addClass('selected').next('ul').removeClass('is-hidden').end().parent('.has-children').parent('ul').addClass('moves-out');
			selected.parent('.has-children').siblings('.has-children').children('ul').addClass('is-hidden').end().children('a').removeClass('selected');
			$('.cd-overlay').addClass('is-visible');
		} else {
			selected.removeClass('selected').next('ul').addClass('is-hidden').end().parent('.has-children').parent('ul').removeClass('moves-out');
			$('.cd-overlay').removeClass('is-visible');
		}
		toggleSearch('close');
	});

	//submenu items - go back link
	$('.go-back').on('click', function(){
		$(this).parent('ul').addClass('is-hidden').parent('.has-children').parent('ul').removeClass('moves-out');
	});

	function closeNav() {
		$('.cd-nav-trigger').removeClass('nav-is-visible');
		$('.cd-main-header').removeClass('nav-is-visible');
		$('.cd-primary-nav').removeClass('nav-is-visible');
		$('.has-children ul').addClass('is-hidden');
		$('.has-children a').removeClass('selected');
		$('.moves-out').removeClass('moves-out');
		$('.cd-main-content').removeClass('nav-is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			$('body').removeClass('overflow-hidden');
		});
	}

	function toggleSearch(type) {
		if(type=="close") {
			//close serach 
			$('.cd-search').removeClass('is-visible');
			$('.cd-search-trigger').removeClass('search-is-visible');
		} else {
			//toggle search visibility
			$('.cd-search').toggleClass('is-visible');
			$('.cd-search-trigger').toggleClass('search-is-visible');
			if($(window).width() > MqL && $('.cd-search').hasClass('is-visible')) $('.cd-search').find('input[type="search"]').focus();
			($('.cd-search').hasClass('is-visible')) ? $('.cd-overlay').addClass('is-visible') : $('.cd-overlay').removeClass('is-visible') ;
		}
	}

	function checkWindowWidth() {
		//check window width (scrollbar included)
		var e = window, 
            a = 'inner';
        if (!('innerWidth' in window )) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        if ( e[ a+'Width' ] >= MqL ) {
			return true;
		} else {
			return false;
		}
	}

	function moveNavigation(){
		var navigation = $('.cd-nav');
  		var desktop = checkWindowWidth();
        if ( desktop ) {
			navigation.detach();
			navigation.insertBefore('.cd-header-buttons');
		} else {
			navigation.detach();
			navigation.insertAfter('.cd-main-content');
		}
	}
    var nav_header = $('.sidebar');
    var main = $('#main');
    $(window).scroll(function() {
    if ($(this).scrollTop() > $(image_carousel).height()) {
      nav_header.css({
        "position": "fixed",
        "top": 50,
      });
        $("#adleft").css({
            "top":"150px",
            "position": "fixed"
        });
        $("#adleft").fadeIn(1000);
        $("#adright").css({
            "top":"150px",
            "position": "fixed"
        });
        $("#adright").fadeIn(1000);
    } else {
      nav_header.css({
        "position": "absolute",
        "top": 'auto',
      });
        $("#adleft").fadeOut(250);
        $("#adright").fadeOut(250);
    }
    if ($(this).scrollTop() > 200) {
        $('.news').css({
            "visibility": "inherit",
            "-webkit-animation":"anima 2s",
            "-moz-animation":"anima 2s",
            "-o-animation":"anima 2s",
            "-ms-animation":"anima 2s",
            "animation":"anima 2s",
            "-webkit-backface-visibility":"hidden",
            "-moz-backface-visibility":"hidden",
            "-o-backface-visibility":"hidden",
            "-ms-backface-visibility":"hidden",
            "backface-visibility":"hidden"
        });
        
        $("#bttop").fadeIn(1000);
        $('.cd-nav-trigger').css({
            "position": "fixed",
            "top" : "50px"
        })
    }else{
        $('.cd-nav-trigger').css({
            "position": "absolute",
            "top" : "0px"
        })
        $("#bttop").fadeOut(250);
    }
    });
    $('#bttop').click(function(){$('body,html').animate({scrollTop:0},1000);});
    var $timeline_block = $('.cd-timeline-block');

	//hide timeline blocks which are outside the viewport
	$timeline_block.each(function(){
		if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
			$(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
		}
	});

	//on scolling, show/animate timeline blocks when enter the viewport
	$(window).on('scroll', function(){
		$timeline_block.each(function(){
			if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
				$(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
			}
		});
	});
    $('.list:first').parent().addClass('active');
    $('.list').click(function() {
        $('.list').parent().removeClass('active');
        $(this).parent().addClass('active');
        var type = $(this).attr('data-type');
        $.ajax({
            "url": "index.php/public/main/list_main",
            "type": "post",
            "data": "type="+type,
            "async": true,
            "success": function(result) {
                if (result == 'Miss') {
                    
                } else {
                    $('#cover').html(result);
                }
                $('.news').css({
            "visibility": "inherit",
            "-webkit-animation":"anima 2s",
            "-moz-animation":"anima 2s",
            "-o-animation":"anima 2s",
            "-ms-animation":"anima 2s",
            "animation":"anima 2s",
            "-webkit-backface-visibility":"hidden",
            "-moz-backface-visibility":"hidden",
            "-o-backface-visibility":"hidden",
            "-ms-backface-visibility":"hidden",
            "backface-visibility":"hidden"
        });
            }
        });
        return false;
    });
    
    
    /*----- phần giỏ hàng -----*/
    
    var test = $('.badge').text();
    $('.delbook').click(function() {
        var key = $(this).prev().val();
        $(this).parent().remove();
        $.ajax({
            "url":"giohang.html",
            "type":"post",
            "data":"keys="+key,
            "async":true,
            "success":function(kqq){
                document.fCart.reset();
                if(kqq > 0){
                    $('.badge').text(kqq);
                }else{
                    $('.badge').text('');
                }
            }
        });
        return false;
    });
    
    
    $(document).on( "click", ".addbook", function() {
        $(this).slideToggle();
        var newid=$(this).prev().val();
        $.ajax({
            "url":"giohang.html",
            "type":"post",
            "data":"newid="+newid,
            "async":true,
            "success": function(kqq) {
                if(kqq > 0){
                    $('.badge').text(kqq);
                }
            }
        });
        return false;
    });
    
    /*----- phần đăng xuất/đăng nhập -----*/
    // Sự kiện login
    $('#btnLogin').click(function() {
        $('#Uzone').html('<div class="loading"><img src="public/images/loading.gif" /></loading>');
        // bắt lấy username và password
        var user = $('#txtUser').val();
        var pass = $('#txtPass').val();
        $.ajax({
            "url": "dangnhap.html",
            "type": "post",
            "data": "user="+user+"&pass="+pass,
            "async": true,
            "success": function(result_login) {
                if (result_login == 'Miss') {
                    $('#login_msg').html('<span class="error">Vui lòng nhập thông tin đầy đủ</span>');
                } else if (result_login == 'Wrong') {
                    $('#login_msg').html('<span class="error">Sai thông tin đăng nhập</span>');
                } else {
                    $('#Uzone').html(result_login);
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
    $(document).on('click', '#Uzone a[title="logout"]', function() {
        $.ajax({
            "url": "dangxuat.html",
            "type": "get",
            "data": "",
            "async": true,
            "success": function(result_logout) {
                if (result_logout == 'Finish') {
                    $('#Uzone').html('');
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

    
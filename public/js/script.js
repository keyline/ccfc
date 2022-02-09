//nav part start
//$(document).ready(function(){
//    "use script";
//    
//    $('.plus').click(function(){
//        if ($('#qty').val() < 10){
//            $('#qty').val(+$('#qty').val() + 1);   
//        }
//    });
//    $('.minus').click(function(){
//       if ($('#qty').val() > 1) {
//           if ($('#qty').val() > 1) $('#qty').val(+$('#qty').val() - 1);
//       }
//    });
//    $('.product-image-slider .item').on('click', function(){
//        var parent = $(this).parents('.product-image-slider');
//        var image = $(this).find('img').attr('src');
//        parent.siblings('.product-image').find('img').attr('src', image);
//    });
//});
//nav part end


//navigation-part start
//navigation
$('.btn-menu').on('click', function(){
    $('.header .navigation-wrap').addClass('active');
    $('.header .menu-overlay').addClass('active');
});
$('.header .menu-overlay').on('click', function(){
    $('.header .navigation-wrap').removeClass('active');
    $(this).removeClass('active');
});
//navigation-part end


//search
$('.search-btn').on('click', function(){
    $('.user-options .search-wrap').addClass('active');
    $('.header .search-overlay').addClass('active');
});
$('.header .search-overlay').on('click', function(){
   $('.user-options .search-wrap').removeClass('active');
    $(this).removeClass('active');
});
$('.user-options .close-btn').on('click', function(){
   $('.user-options .search-wrap').removeClass('active');
    $(this).removeClass('active');
    $('.header .search-overlay').removeClass('active');
    $(this).removeClass('active');
});



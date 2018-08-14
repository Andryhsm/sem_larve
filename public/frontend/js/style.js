/****** CSS MANIPULATION *****/

     if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
    {
        $('.sell_coeur').css('margin-top', '-10px !important');
    }
    else if(navigator.userAgent.indexOf("Chrome") != -1 )
    {
        $('.sell_coeur').css('margin-top', '-10px !important');
    }
    else if(navigator.userAgent.indexOf("Safari") != -1)
    {
        $('.sell_coeur').css('margin-top', '-10px !important');
    }
    else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
    {
         $('.sell_coeur').css('margin-top', '0px !important');
    }
    else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
    {
      
    } 

    if (Modernizr.mq('(max-width: 767px)')) {
        var tab = $('.section-product .nav-tabs li.active a').attr('href');
        product_column(tab);
        $('.tab-menu').click(function(){
            tab = $(this).attr('href');
            product_column(tab);
        });
    }


    function product_column(tab){
        $('.tab-content #home').hide();
        $('.tab-content #menu1').hide();
        $('.tab-content #menu2').hide();
        $('.tab-content #home').removeClass('column-product');
        $('.tab-content #menu1').removeClass('column-product');
        $('.tab-content #menu2').removeClass('column-product');
        console.log(tab + '**********')
        $( ".tab-content "+ tab).show();
        $("" + tab).addClass('column-product');
    } 
 
 
    

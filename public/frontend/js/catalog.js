$('span').css('font-family','Roboto, sans-serif');
$('#search-input').val("");
$(".product-container").find(".category-drop").off("click");
$(".product-container").on('click', '.category-drop', function (event) {
    if ($(this).hasClass('fa-caret-up')) {
        $(this).removeClass('fa-caret-up');
        $(this).addClass('fa-caret-down');
    } else {
        $(this).addClass('fa-caret-up');
        $(this).removeClass('fa-caret-down');
    }
    $(this).parent().toggleClass('collapsed');
    $(this).next().toggleClass('in');
})

//------------ filter for checkbox ------------------//
$(".product-container").find(".filter").off("click");   
$(".product-container").on('click', '.filter', function (event) {
    event.preventDefault();
    if ($(this).parents('.category-filter').find('.selected').length > 0) {
        $(this).parents('.category-filter').find('a').removeClass('selected');
    }
    if ($(this).parents('.discount-filter').find('.selected').length > 0) {
        $(this).parents('.discount-filter').find('a').removeClass('selected');
    }
    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
        if($(this).data('type') == "brand"){
            //$(this).children('i').removeClass('fa-check-square-o').addClass('fa-square-o');
        }
        if($(this).data('type') == "color"){
            //$(this).prev('i').removeClass('icon-active').addClass('icon-inactive');
        }
        if($(this).data('type') == "size"){
            //$(this).children('i').removeClass('fa-check-square-o').addClass('fa-square-o');
        }
    } else {
        $(this).addClass('selected');
        if($(this).data('type') == "brand"){
            //$(this).children('i').removeClass('fa-square-o').addClass('fa-check-square-o');
        }
        if($(this).data('type') == "color"){
            //$(this).prev('i').removeClass('icon-inactive').addClass('icon-active');
        }
        if($(this).data('type') == "size"){
            //$(this).children('i').removeClass('fa-square-o').addClass('fa-check-square-o');
        }
    }
    save_latest_category($(this).data('type'));
    var filter_url = get_filter_url();
    apply_filter(filter_url);
});


$(".product-container").on('change', '.filter-size', function (event) {
    if($(this).is(':checked')){
        if ($(this).hasClass('all-size')) {
            $(this).parents('.size-filter').find('a').removeClass('selected');
        } else if ($(this).parents().hasClass('size-filter')) {
            $(".all-size").removeClass('selected');
        }
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            $(this).addClass('selected');
        }
        var filter_url = get_filter_url();
        apply_filter(filter_url);
    }else{
        $(this).removeClass('selected');
        var filter_url = get_filter_url();
        apply_filter(filter_url);       
    }
});

//Avoir le resultat du produit par page
function changeNumberProduct(){
    if ($(".product-container").parents('.category-filter').find('.selected').length > 0) {
        $(".product-container").parents('.category-filter').find('a').removeClass('selected');
    }
    if ($(".product-container").hasClass('all-size')) {
        $(".product-container").parents('.size-filter').find('a').removeClass('selected');
    } else if ($(".product-container").parents().hasClass('size-filter')) {
        $(".all-size").removeClass('selected');
    }
    if ($(".product-container").parents('.discount-filter').find('.selected').length > 0) {
        $(".product-container").parents('.discount-filter').find('a').removeClass('selected');
    }
    if ($(".product-container").hasClass('selected')) {
        $(".product-container").removeClass('selected');
    } else {
        $(".product-container").addClass('selected');
    }
    var filter_url = get_filter_url();
    apply_filter(filter_url);
}       


//Changer le visualisation du produit
function changeVisualisation(){
    if ($(".product-container").parents('.category-filter').find('.selected').length > 0) {
        $(".product-container").parents('.category-filter').find('a').removeClass('selected');
    }
    if ($(".product-container").hasClass('all-size')) {
        $(".product-container").parents('.size-filter').find('a').removeClass('selected');
    } else if ($(".product-container").parents().hasClass('size-filter')) {
        $(".all-size").removeClass('selected');
    }
    if ($(".product-container").parents('.discount-filter').find('.selected').length > 0) {
        $(".product-container").parents('.discount-filter').find('a').removeClass('selected');
    }
    if ($(".product-container").hasClass('selected')) {
        $(".product-container").removeClass('selected');
    } else {
        $(".product-container").addClass('selected');
    }
    var filter_url = get_filter_url();
    apply_filter(filter_url);
} 

function apply_filter(url) {
    $.ajax({
        type: 'get',
        url: url,
        dataType: "html",
        beforeSend: function () {
            $.LoadingOverlay("show",{'size': "10%",'zIndex': 9999});
        },
        success: function (response, status) {
            $(".product-container").html($(response).find(".product-container").html())
            history.pushState(null, null, url);
            initializePriceSlider();
            category_selected();
            check_active_filter();
            header_title_category();
            $.LoadingOverlay("hide");
            $('#search-input').val("");
        },
        error: function(xhr, status, error){
            //console.log("une erreur est survenue");
            //console.log(xhr.responseText);
        }
    });
}

function get_filter_url() {
    var url = $(".category-url").data('url');
    var brands = [];
    var tags = [];
    var color = [];
    var size = [];
    size['attrs'] = [];

    $(".brands-filter").find(".selected").each(function () {
        brands.push($.trim($(this).data('id')));
    });
    $(".tags-filter").find(".selected").each(function () {
        tags.push($.trim($(this).data('id')));
    });
    $(".color-filter").find(".selected").each(function () {
        color.push($.trim($(this).data('id')));
    });
    $(".size-filter").find(".selected").each(function () {
        var attribute_id = $.trim($(this).data('attribute_id'));
        var attribute_option_id = $.trim($(this).data('id'));
        if(typeof size['attrs'][attribute_id]==='undefined'){
            size['attrs'][attribute_id] = [];
        }
        size['attrs'][attribute_id].push(attribute_option_id);
    });
    var category = $.trim(($(".category-filter").find(".selected").data('id')));
    var discount = $.trim(($(".discount-filter").find(".selected").data('id')));
    if (brands.length > 0) {
        url += "&brand=" + brands.toString();
    }
    if (tags.length > 0) {
        url += "&tag=" + tags.toString();
    }
    if (color.length > 0) {
        url += "&color=" + color.toString();
    }
    var attrs = [];
    var query_string = '';
    if (size.attrs.length > 0) {
        $.each(size['attrs'], function (key,val) {
            if(typeof val!='undefined'){
                attrs[key] = val.toString();
                query_string+='&attrs['+key+']='+val.toString();
            }
        });
    }

    url += query_string;

    if (category) {
        url += "&category=" + category;
    }

    if (discount) {
        url += "&discount=" + discount;
    }
    var start_price = $(".start-price").val();
    var end_price = $(".end-price").val();
    if (start_price > 0 && end_price > 0) {
        url += "&start_price=" + start_price + '&end_price=' + end_price;
    }
    if(typeof $("#nb").val() != "undefined")
        url += "&nb="+ $("#nb").val();
     else
        url += "&nb=48";
    if(typeof $("#vp").val() != "undefined")
        url += "&vp="+ $("#vp").val();    
     else
        url += "&vp='news'";                                       //Associer le filtre par pagination 
    return url;
}

function price_filter(start_price, end_price) {
    $(".start-price").val(start_price);
    $(".end-price").val(end_price);
    $('.price-start').append('<span>'+start_price+'</span>');
    $('.price-end').append('<span>'+end_price+'</span>');
    var filter_url = get_filter_url();             
    apply_filter(filter_url);
}

function initializePriceSlider() {
    /*var max_price = $("#max_price").data("max-price");
    var start_price = ($(".start-price").val() > 0) ? $(".start-price").val() : 1;
    var end_price = ($(".end-price").val() > 0) ? $(".end-price").val() : max_price;
    $("#amount").val("$" + start_price +
        " - $" + end_price);
    $('.show-price-start').append('<span>$'+start_price+'</span>');
    $('.show-price-end').append('<span>$'+end_price+'</span>');
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: max_price,
        values: [start_price, end_price],
        slide: function (event, ui) {
        },
        change: function (e, ui) {
            price_filter(ui.values[0], ui.values[1])
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            $('.price-start').append('<span>$'+ui.values[0]+'</span>');
            $('.price-end').append('<span>$'+ui.values[1]+'</span>');
        }
    });*/
    $('#filter-by-price').on('click', function() {
        var max_price = $("#max_price").data("max-price");
        var start_price = ($(".start-price").val() > 0) ? $(".start-price").val() : 1;
        var end_price = ($(".end-price").val() > 0) ? $(".end-price").val() : max_price;
        if(start_price > end_price){
            $('.facet-content.content-price-filter.show-filter .error').css('display', 'block');
        }else{
            price_filter(start_price, end_price);
        }
    });
    $('#cate-toggle li.has-sub').on('click', function () {
        $(this).find('a').removeAttr('href');
        var $that = $(this).find('a');
        var element = $that.parent('li');
        if (element.hasClass('open')) {
            element.removeClass('open');
            element.find('li').removeClass('open');
            element.find('ul').slideUp();
        } else if ($that.next().hasClass('category-sub')) {
            element.addClass('open');
            element.children('ul').slideDown();
        }
    });
}
category_selected();
function category_selected(){
    var category_filter=$('.category-filter');
    var selected_filter=$(category_filter).find('.selected');
    if ($(selected_filter)) {
        $(selected_filter).parents('.list-group-submenu').addClass('in');
        $(selected_filter).parent().addClass('in');
    }
}

//------------ Voir et cacher les contenues des filtres ------------------//
$(".product-container").find(".facet-title").off('click');
$(".product-container").on('click', '.facet-title', function(event){
    event.preventDefault();
    var current = $(this).next();
    if(current.hasClass('hide-filter')){
        current.show(300);  
        current.removeClass('hide-filter');
        $(this).find('.fa').removeClass('fa-angle-down').addClass('fa-angle-up');
    }else{
        current.hide(300);
        current.addClass('hide-filter');
        $(this).find('.fa').removeClass('fa-angle-up').addClass('fa-angle-down');
        
    }
});     
//------------ select the active filter after loading ajax ------------------//
check_active_filter();
function check_active_filter(){
    $(".product-container").find(".filter-size, .filter").each(function() {
        if($(this).hasClass('selected')){ 
            $(this).prop('checked', true);
            var parent_ = $(this).closest('.facet-content');
            if(parent_.hasClass('hide-filter')){    
                parent_.removeClass('hide-filter');
                parent_.prev().children('.title-filter').children().removeClass('fa-angle-down').addClass('fa-angle-up');
            }
            if($(this).data('type') == "brand"){
                //$(this).children('i').removeClass('fa-square-o').addClass('fa-check-square-o');
            }
            if($(this).data('type') == "color"){
                $(this).prev('i').removeClass('icon-inactive').addClass('icon-active');
            }
            if($(this).data('type') == "size"){
                //$(this).children('i').removeClass('fa-square-o').addClass('fa-check-square-o');
            }
        }
    });
}
//----------------- supprime tous la selections si on change de categorie
function save_latest_category(type){
    if(type == "category-filter"){
        var parent = $(".category-filter").find(".selected").data('parent-ids');
        var parent_latest = $('#latest_category_selected').attr('data-latest-category');
        var par = new RegExp(parent_latest);
        if(!par.test(parent) || parent == '' || parent == parent_latest){
            //Suppression de tous les classes séléctionner
            remove_selected_filter();
        }
        $('#latest_category_selected').attr('data-latest-category', parent);
        $.ajax({
            url: 'save-latest-category',
            type: 'GET',
            dataType: 'json',
            data: {selected_category: parent},
        })
        .done(function(data) {
            console.log(data);
        })
        .fail(function(xhr) {
            console.log(xhr.responseText);
        })
        .always(function() {
        });  
    }
}

function header_title_category()
{
    var id_catname_current_cat;
    var lists_category_selected = "";
    var parents_category = "";
    var parent_id = "";
    var parent_parent_id = "";
    var parent_parent = "";
    var parent = "";
    var category_parent_content = "";
    var content_category = [];
    
    parents_category = $('.category-filter').find(".selected").data('parent-ids');
    id_cat = $('.category-filter').find(".selected").data('id');
    name_cat = $('.category-filter').find(".selected").html();
    parent = $('.category-filter').find(".selected").data('parent');

    if(typeof parents_category != "undefined"){
        console.log(parents_category);
        var parents_id_lists = [];
        if(/,/.test(parents_category)){
            parents_id_lists = parents_category.split(',');
        }else{
            parents_id_lists.push(parents_category);
        }
        content_category.push('<a data-id="'+id_cat+'" class="list-group-title" href="#" data-toggle="collapse" data-parent-ids="'+parents_category+'" data-parent="'+parent+'" data-type="category-filter">'+name_cat+'</a>')
        for (var i = parents_id_lists.length - 1; i >= 0; i--) {
            category_parent_content = $('a[data-id="'+parents_id_lists[i]+'"]').html();
            parent_id = $('a[data-id="'+parents_id_lists[i]+'"]').data('id');
            parent_parent_id = $('a[data-id="'+parents_id_lists[i]+'"]').data('parent-ids');
            parent_parent = $('a[data-id="'+parents_id_lists[i]+'"]').data('parent');
            content_category.push('<a data-id-selected="'+parent_id+'" class="list-group-title" href="#" data-toggle="collapse" data-parent-ids="'+parent_parent_id+'" data-parent="'+parent_parent_id+'" data-type="category-filter">'+category_parent_content+'</a>&nbsp;&nbsp;<i class="fa fa-caret-right"></i>&nbsp;&nbsp;');
        }
    }

    for (var i = content_category.length - 1; i >= 0; i--) {
        $('#category_selected').append(content_category[i]);
    }
}

$(".product-container").on("click", ".list-group-title", function(event){
    event.preventDefault();
    var id_selected = $(this).data('id-selected');
    $('.category-filter').find('a[data-id="'+id_selected+'"]').trigger('click');
});

function remove_selected_filter(){
    $(".brands-filter").find(".selected").each(function () {
        $(this).removeClass('selected');
    });
    $(".tags-filter").find(".selected").each(function () {
        $(this).removeClass('selected');
    });
    $(".color-filter").find(".selected").each(function () {
        $(this).removeClass('selected');
    });
    $(".size-filter").find(".selected").each(function () {
        $(this).removeClass('selected');
    });
    $(".discount-filter").find(".selected").removeClass('selected');
}
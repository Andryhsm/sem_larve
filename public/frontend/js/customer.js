var map;
function start_map(store_data) {
	
     map = new google.maps.Map(document.getElementById('map'), {
       center: {lat: store_data[0].lat, lng: store_data[0].lng},
       zoom: 8
      });

      for (var i = store_data.length - 1; i >= 0; i--) {
      		var store = store_data[i];
      		var store_position = {lat: store.lat, lng: store.lng};
      		var info_customer = '<div class="info-customer">';
      			info_customer +=  '<div class="row" style="margin:0;">';
      			//info_customer += 		 '<div class="content-image" style="width:240px;height:100px;">';
      			//info_customer +=				 '<img src="'+base_url + 'upload/logo/' + store.store_image+'" alt="'+store.store_name+'" />';
      			//info_customer +=		 '</div>';
      			info_customer +=		 '<div class="content-info">';
      			info_customer +=				 '<span>Nom du magasin : </span><strong>'+ store.store_name +'</strong><br>';
      			info_customer +=				 '<span>Description : </span><strong>'+ store.short_description +'</strong>';
      			info_customer +=		 '</div>';
      			info_customer +=  '</div>';
      			info_customer += '</div>';
      		var infoWindow = new google.maps.InfoWindow({
      			content: info_customer
      		});
	      	var marker = new google.maps.Marker({
	          position: store_position,
	          map: map
	        });
	        marker.addListener('click', function(){
	        	infoWindow.open(map, marker);
	        });
      }

 	$('.show-shop').click(function(event) {
 		event.preventDefault();
 		var lat = parseFloat($(this).data('latitude'));
 		var lng = parseFloat($(this).data('longitude'));
 		map.setCenter(new google.maps.LatLng( lat, lng ));
    $('#merchant_address').html($(this).data('address'));
    $('#merchant_zip_code').html($(this).data('zip_code'));
 	});     
}                                   

jQuery(document).ready(function($) {
  change_header_title();
	$('.nav-menu .list-menu').on('click', '.nav-link', function(event) {
		event.preventDefault();
		var menu_active = $('.nav-menu .list-menu').find('.active');
		menu_active.removeClass('active');
		$(this).addClass('active');
		var url = $(this).data('url');
		change_header_title();
		change_page(url);
	});

    $('.order_reception').click(function(event){
        event.preventDefault();
        var $map = $(this).parents('.order').find('.map');
        var $icon = $(this).find("i");

        get_distance_store();
        if ($icon.hasClass('fa-angle-up')) {
            $icon.removeClass('fa-angle-up').addClass('fa-angle-down');
            $(this).parents('.order').find('.shop').fadeOut("slow");
            $(this).parents('.order').find('#map').remove();        //remove the map element
            $map.html();                                    
        }
        else {
            $icon.removeClass('fa-angle-down').addClass('fa-angle-up');
            $(box).parents('.order').find('.shop').show("slow");
            $map.html('<div id="map"></div>');                      //add the map element
            initMap(-34.397, 150.644);


        }
    });

	order_reception();
	checkbox_for_civility();
	checkbox_for_language();
});



function change_header_title()
{
	var menu_active = $('.nav-menu .list-menu').find('.active');	
	var src_active = menu_active.children('img').attr('src');
	var text_active = menu_active.children('span').html();
	$('.title-active').find('img').attr('src', src_active);
	$('.title-active').find('.text-title-active').html(text_active);
  console.log("Changer : "+ text_active);
}

function change_page(url)
{
	
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'html',
		beforeSend: function () {
            $.LoadingOverlay("show",{'size': "10%",'zIndex': 9999});
        },
        success: function (response, status) {
            $(".ajax-content").html($(response).find(".ajax-content").html());
            history.pushState(null, null, url);
            $.LoadingOverlay("hide");
            order_reception();
            checkbox_for_civility();
            checkbox_for_language();
            add_commentaire_in_tickets();
        },
        error: function(xhr, status, error){
            console.log(xhr.responseText);
        }

	});
}
function activate(ids) {
    var id = $(ids).attr("id");
    $('.panel-default').removeClass('actives');
    $('#' + id).addClass('actives');
}
function checka(box) {
    var id = $(box).attr("id");
    if ($('#' + id + ' i').hasClass('fa-circle-o')) {
        $('#' + id + ' i').removeClass('fa-circle-o');
        $('#' + id + ' i').addClass('fa-dot-circle-o');
    }
    else {
        $('#' + id + ' i').removeClass('fa-dot-circle-o');
        $('#' + id + ' i').addClass('fa-circle-o');
    }
}

function checkbox_for_civility()
{
	$('.login-area').on('click', '.btn-civility', function(event){
		event.preventDefault();
		if($(this).hasClass('checked')){
			$(this).removeClass('checked');
			$('.btn-civility').addClass('checked');
			$(this).removeClass('checked');
		}else{
			$('.btn-civility').removeClass('checked');
			$(this).addClass('checked');
		}
		$('#input_civility').val($('.btn-civility.checked').data('value'));
	});
	$('#input_civility').val($('.btn-civility.checked').data('value'));
}

function checkbox_for_language()
{
	$('.login-area').on('click', '.btn-language', function(event){
		event.preventDefault();
		if($(this).hasClass('checked')){
			$(this).removeClass('checked');
			$('.btn-language').addClass('checked');
			$(this).removeClass('checked');
		}else{
			$('.btn-language').removeClass('checked');
			$(this).addClass('checked');
		}
		$('#input_language').val($('.btn-language.checked').data('value'));
	});
	$('#input_language').val($('.btn-language.checked').data('value'));
}

function iconeyes(icon) {
    var check_id = $(icon).attr("id");
    if ($('#' + check_id).hasClass('fa-eye')) {
        $('#' + check_id).removeClass('fa-eye');
        $('#' + check_id).addClass('fa-eye-slash');
    }
    else {
        $('#' + check_id).removeClass('fa-eye-slash');
        $('#' + check_id).addClass('fa-eye');
    }
    $("#-" + check_id).trigger("click");
}

function togglePassword(pass) {
    var password_id = $(pass).attr("id");
    if ($('#' + password_id).is(':checked')) {
        $("#password" + password_id).attr("type", "text");

        $("#toggleText").text("Hide");
    }
    else {
        $("#password" + password_id).attr("type", "password");

        $("#toggleText").text("Show");
    }
}

function changepassword() {
    var old = $('#password-old').val();
    var news = $('#password-new').val();
    $.ajax({
            url: 'update-password',
            type: 'POST',
            data: { old_password: old, new_password: news },
        })
        .done(function(datas) {
            console.log(datas);
            if (datas.success) {
                toastr.success(datas.message);
            }
            else {
                toastr.error(datas.message);
            }
        })
        .fail(function(xhr) {
            console.log(xhr.responseText);
        });
}

function order_reception() {
	$('.order-reception').click(function(event) {
		event.preventDefault();
	    var $map = $(this).parents('.order').find('.map');
    	var $icon = $(this).find("i");
	    var store_data = [];
	   
	    if ($icon.hasClass('fa-angle-up')) {
	        $icon.removeClass('fa-angle-up').addClass('fa-angle-down');
	     	$(this).parents('.order').find('.shop').fadeOut("slow");
	     	$(this).parents('.order').find('#map').remove(); 		//remove map element
	    	$map.html();									
	    } else {
			/* Close all open order */
			$('.order').each(function(index, order) {
				if($(order).find('fa-angle-up')){
					$(order).find('.shop').fadeOut('slow');		
					$(order).find('#map').remove();
					$(order).find('.fa-angle-up').removeClass('fa-angle-up').addClass('fa-angle-down');
				}				
			});
	      $icon.removeClass('fa-angle-down').addClass('fa-angle-up');
	    	$(this).parents('.order').find('.shop').show("slow");
	    	$map.html('<div id="map"></div>'); 						//add map element
	    	/* Get current customer data */
	   		$(this).parents('.order').find('.store_data').each(function(index, store_element) {
				    var store = {};
				    store.store_name = $(store_element).data('store_name');
				    store.store_image = $(store_element).data('store_name');
	   				store.short_description = $(store_element).data('short_description');
	   				store.registration_number = $(store_element).data('registration_number');
	   				store.lat = $(store_element).data('latitude');
	   				store.lng = $(store_element).data('longitude');
	   				store_data.push(store);
	   		});
	   	 	start_map(store_data);
        get_distance_store();
	    }
	});
}

function activateShop(box){
  $('.show-shop').removeClass('active');
  $(box).addClass('active');
  get_distance_store();
}

function get_distance_store(){
  var $store_active = $('.store-info.active');
  $('#merchant_address').html($store_active.data('address'));
  $('#merchant_zip_code').html($store_active.data('zip_code'));
  $.ajax({
    url: base_url + 'customer/get-distance-merchant',
    type: 'GET',
    dataType: 'json',
    data: {latitude: $store_active.data('latitude'), longitude: $store_active.data('longitude')},
  })
  .done(function(data) {
      $('.store-distance').html('À '+data.distance+' km de chez vous');
  })
  .fail(function(xhr) {
  })
  .always(function() {

  });
  
}

function selectShop()
{
  var $store_active = $('.store-info.active');
  $.ajax({
    url: 'select-merchant',
    type: 'POST',
    data: {customer_id: $store_active.data('customer_id'), merchant_id: $store_active.data('merchant_id'), item_id: $store_active.data('item_id'), store_id: $store_active.data('store_id')},
  })
  .done(function(data) {
      console.log(data);
      change_url = base_url + 'customer/current-coupon/'+data.id;
      change_page(change_url);
  })
  .fail(function(xhr) {
    console.log(xhr.responseText);
  })
  .always(function() {

  });
}
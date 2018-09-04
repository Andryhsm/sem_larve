Array.prototype.uniq = function(){
  return this.filter(
      function(a){return !this[a] ? this[a] = true : false;}, {}
  );
}

var keyword_list = [];
var keyword_duplicate_list = [];

$(document).ready(function(){

  $("form#import-data").submit(function(e) {
      e.preventDefault();    
      var formData = new FormData(this);
      
      $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: formData,
           beforeSend: function() {
                        $.LoadingOverlay("show", { 'size': "10%", 'zIndex': 9999 });
                    },
          success: function (response) {
              if(response.status == 'ok' || response.status == 'not_finish' ) {
                 insert_data(response.data);
                 if(keyword_list.length > 0) {
                   // var uniq_keyword_length = keyword_list.length - Object.keys(keyword_duplicate_list).length;
                   var uniq_keyword_length = keyword_list.uniq().length;
                    $('.keyword_list .number').html(uniq_keyword_length + ' Keywords imported');
                    $('#show_keyword_list').removeAttr('disabled');
                 }
                 else $('.keyword_list .number').html('No keyword imported');
                 var duplicate_length = Object.keys(keyword_duplicate_list).length
                 if(duplicate_length > 0) {
                    $('.duplicate_keyword .number').html(duplicate_length + ' Duplicate found')
                    $('#show_duplicate_keyword_list').removeAttr('disabled');                    
                 } 
                 else $('.duplicate_keyword .number').html('No duplicate found')               
              }
              $('.notification').html('<div class="alert '+response.type_alert+' alert-dismissible show" role="alert">'+
                      ' ' +response.message + ' '+
                      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                      '</button>'+
                    '</div>');
              $.LoadingOverlay("hide");
          },
          cache: false,
          contentType: false,
          processData: false
      });
      
      get_locations();  
  });
  
  $('#show_keyword_list').on('click', function(){
      $('.keywords-list').slideToggle();
      $('.keywords-list').toggleClass('show');
      if($('.keywords-list').hasClass('show'))
        $(this).html('Hide keywords list');
      else $(this).html('Show keywords list');

     /*if($('.keywords-list').hasClass('hidden')) {
         $('.keywords-list').removeClass('hidden');
         $('#delete_keyword_in_list').removeClass('hidden');
         $(this).html('Hide keywords list');
     } else {
         $('.keywords-list').addClass('hidden');
         $('#delete_keyword_in_list').addClass('hidden');
         $(this).html('Show keywords list');
     }*/
     
  });
  
  // $('#delete_keyword_in_list').on('click', function(){
  //     $('.ckeck_keyword:checked').each(function () {
  //       $(this).closest('tr').remove()
  //     });
  // });
  
  if ($('#delete_keyword_in_list').length > 0) {
        $('#delete_keyword_in_list').off('click');
        $('#delete_keyword_in_list').on('click', function (e) {
            e.preventDefault();
            $('#confirm').modal({backdrop: 'static', keyboard: false})
                .one('click', '#delete', function () {
                    $('.ckeck_keyword:checked').each(function () {
                      $(this).closest('tr').remove();
                    });
                });
        });
    }
    
  $('#keyword_trend_form input').on('keyup change', function(e) {
      var valid = true;
      $('.required').each( function(i, el) {
        if( $(el).val() == '' ) valid = false;
      });
     if(valid && keyword_list.length > 0){  
       $('#btn_data_collection').removeAttr('disabled');
     }else{
       $('#btn_data_collection').attr('disabled',true);
     } 
  });
  
  $('.ckeck_all_keyword').click(function(){
        $(this).toggleClass('1');
        if($(this).hasClass('1')){
            $(".ckeck_keyword").each(function(index, element) {
               $(element).prop('checked', true);
            });
        }
        else {
            $(".ckeck_keyword").each(function(index, element) {
               $(element).prop('checked', false);
            })
        }
    });
    
  $('input[name="import_file"]').change(function(e){
      $('.file_name').css('display', 'block');
  		$('.file_name').html(e.target.files[0].name);
  		$('button.import_files').css('display', 'block');
  });
  
  $(document).on('click', '#btn_data_collection', function() {
     if(!$(this).hasClass('request_done')){
        launch_request();
        $(this).addClass('request_done');
     }  
  });
  
  $('#import_help').click(function(){
    $('.import_help').slideToggle();
  });
  
  $(document).on('change', '.select-location', function(){
    var url = $(this).data('url');
    var type = $(this).data('type');
    $this = $(this);
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: {id: $(this).val()},
    })
    .done(function(response) {
      var states = response.data;
      var selector = '';
      if(type == 'country') {
          $('.select-province').html('');
          var selected_province = 'selected';
          $('.select-province').append('<option disabled="">Select a value</option>');
          for (var i = 0; i < states.length; i++) {
             if(i > 0) 
                          selected_province = '';
             $('.select-province').append('<option value="'+states[i].criteria_id+'" '+selected_province+'>'+states[i].location_name+'</option>');
          }
      } else {
        if(states.length > 0) { 

            var content = '<label class="col-sm-4 control-label">Area</label>'+
                                              '<div class="col-sm-8">' +
                                                  '<select name="area" class="form-control required select-state">';
                content +=                        '<option disabled="">Select a value</option>';
                var selected = 'selected';
                for (var i = 0; i < states.length; i++) {
                       if(i > 0) 
                          selected = '';

                      content +=                   '<option value="'+states[i].criteria_id+'" '+selected+'>'+states[i].location_name+'</option>';
                }

                content +=                      '</select>'+
                                                  '</div>';
          $('.content-select-state').html(content);
        }
      }
    })
    .fail(function() {
      console.log("error");
    });
    
  });
  
  $('#show_duplicate_keyword_list').click(function() {
    $('.keywords-duplicate-list').slideToggle();
    $('.keywords-duplicate-list').toggleClass('show');
    if($('.keywords-duplicate-list').hasClass('show'))
      $(this).html('Hide keywords list');
    else $(this).html('Show keywords list');
  });
  
  
  
});


function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
}

function insert_data(data) {
    $('.keywords-list tbody').html('');
    keyword_list = data;
    var sorted_arr = keyword_list.slice().sort();
    
    var list_unique = keyword_list.uniq();
    for(var j = 0; j < list_unique.length; j++) {
        $('.keywords-list tbody').append('<tr>'+
                                            '<td style="width: 8%;"><input class="ckeck_keyword" type="checkbox" /></td>'+
                                            '<td class="one_keyword">'+list_unique[j]+'</td>'+
                                            '<td style="width: 5%;" class="edit_keyword">'+
                                            '<a style="cursor:pointer;" onclick="edit_keyword(this);">'+
                                            '<i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 20px;"></i></a></td>' +
                                         '</tr>');
    }
    get_duplicate(data);
    post_duplicate(keyword_duplicate_list);
}

function get_duplicate(data) {
    counts = {};
    list_duplicate = {};
    jQuery.each(data, function(key,value) {
      if (!counts.hasOwnProperty(value)) {
        counts[value] = 1;
      } else {
        counts[value]++;
        list_duplicate[value] = counts[value];
      }
    });
    keyword_duplicate_list = list_duplicate;
}

function post_duplicate(keyword_duplicate_list) {
    $('.keywords-duplicate-list tbody').html('');
    if(Object.keys(keyword_duplicate_list).length > 0) {
       $.each(keyword_duplicate_list, function(key, value) {
          $('.keywords-duplicate-list tbody').append('<tr>'+
                                             '<td>'+key+'</td>' +
                                            '<td> '+value+' times</td>'+
                                         '</tr>');
       });
    } else {
          $('.keywords-duplicate-list tbody').append('<div class="no-duplicate"><span>No duplicate entry found!</span></div>');
    }
}   

function launch_request() { 
  var params = {
    language_id: $('select[name="language_code"]').val(),
    monthly_searches: $('input[name="monthly_searches"]').is( ":checked" ) ? 1 : 0,
    country_id: $('select[name="country"]').val(),
    province_id: $('select[name="province"]').val(),
    area_id: $('select[name="area"]').val(),
    convert_null_to_zero: $('input[name="convert_null_to_zero"]').is( ":checked" ) ? 1 : 0,
    campaign_name: $('input[name="campaign_name"]').val(),
  };

  /*var last_list_of_keyword = [];
  $('.one_keyword').each(function(index, el){
        last_list_of_keyword.push($(el).text());
  });*/
  var incr = 0;
  function recursive() {
    setTimeout(function(){
       var total = keyword_list.uniq().length;
      // var item = para.res[i];
       var percent = (incr/parseInt(total))*100;
       console.log(percent);
       $('.bar').css({'width': percent + '%',
                                      'text-align': 'center'
                                  });
       // do something
       incr++;        
       if (incr < total) recursive()
    }, 200)
  }

  $.ajax({
    xhr: function() {
        var total = keyword_list.uniq().length;
        //for(var i=0; i<total; i++) {
          var xhr = new window.XMLHttpRequest();
          
          recursive();

          $('.tab_form:last').removeClass('hidden');
          $('.tab_form:last').slideDown('slow');
          
          // Upload progress
          xhr.onprogress = function (evt) {
              if (evt.lengthComputable) {
                var percentComplete = (evt.loaded / evt.total) * 100;
                console.log(percentComplete);

                    var loaded = (total * percentComplete) / 100;
                    $('.bar').css({'width': percentComplete + '%',
                                    'text-align': 'center'
                                });
                    $('.bar').html(percentComplete + ' %');
                    $('.progress_stat').html(parseInt(loaded) + ' keywords / ' + total + ' done');
                }
                
                //  $('.data_collect_notification').html(' Data collection saved.');
            
          }
            
          return xhr;
        //}
        
      },
      type: 'GET',
      url: "make-request-adwords",
      data: {
              params: params,
              keywords: JSON.stringify(keyword_list.uniq())
            },
      dataType: 'json',
      beforeSend: function() {
                    $.LoadingOverlay("show", { 'size': "10%", 'zIndex': 9999 });
                },
      success: function(response){
        //save_data_collection(data);
        console.log(response);
        var campaign = response.campaign;
        var link = $('.link_result').attr('href');
        var full_link = link +'?campaign_id='+campaign.campaign_id;
        $('.link_result').attr('href', full_link);
      },
      fail: function(xhr) {
          console.log(xhr.responseText);
      }
  }).always(function(){
        $.LoadingOverlay("hide");
  });
}

function paste_param() {
  $('.campaign_name').html($('input[name="campaign_name"]').val());
  $('.language_code').html($('select[name="language_code"] option:selected').text());
  $('.monthly_searches').html($('input[name="monthly_searches"]').is( ":checked" ) ? 'yes' : 'no');
  $('.convert_null_to_zero').html($('input[name="convert_null_to_zero"]').is( ":checked" ) ? 'yes' : 'no');
  $('.location').html($('select[name="area"] option:selected').text());
}
 
/*function save_data_collection(response) {
  var params = {
    language_id: $('select[name="language_code"]').val(),
    monthly_searches: $('input[name="monthly_searches"]').is( ":checked" ) ? 1 : 0,
    country_id: $('select[name="country"]').val(),
    province_id: $('select[name="province"]').val(),
    area_id: $('select[name="area"]').val(),
    convert_null_to_zero: $('input[name="convert_null_to_zero"]').is( ":checked" ) ? 1 : 0,
    campaign_name: $('input[name="campaign_name"]').val(),
  };
  
  var data = {
    params: params,
    keywords_result: JSON.stringify(response)
  };
  
  $.ajax({ 
      url: 'save-data-collection',
      type: 'POST',
      dataType: 'json',
      data: data,
  })
  .done(function(response) {
    console.log(response);
    var campaign = response.campaign;
    var link = $('.link_result').attr('href');
    var full_link = link +'?campaign_id='+campaign.campaign_id;
    $('.link_result').attr('href', full_link);
  })
  .fail(function() {
  });
}*/

function edit_keyword(box){
  $(box).closest('tr').find('.one_keyword').attr('contenteditable','true');
}

function get_locations() {
  //console.log("request"); 
  // $.ajax({
  //     url: 'get-locations',
  //     type: 'GET',
  //     dataType: 'json',
  // })
  // .done(function(response) {
  //   var locations = response.data
  //   $('input[name="location"]').html('');
  //   for(var i = 0; i < locations.length; i++){
  //     $('input[name="location"]').append('<option value='+locations[i].criteria_id+'>'+locations[i].location_name+'</option>');
  //   }
  //   console.log("The location must to be append");
  //   console.log(locations);
  // })
  // .fail(function() {
  //     console.log("error");
  // });
}
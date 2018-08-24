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
          success: function (response) {
              if(response.status == 'ok' || response.status == 'not_finish' ) {
                 insert_data(response.data);
                 $('.next-button').removeClass('disabled');
              }
              $('.notification').html('<div class="alert '+response.type_alert+' alert-dismissible show" role="alert">'+
                      ' ' +response.message + ' '+
                      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                      '</button>'+
                    '</div>');
          },
          cache: false,
          contentType: false,
          processData: false
      });
      
      get_locations();  
  });
  
  $('#show_keyword_list').on('click', function(){
     if($('.keywords-list').hasClass('hidden')) {
         $('.keywords-list').removeClass('hidden');
         $('#delete_keyword_in_list').removeClass('hidden');
         $(this).html('Hide keywords list');
     } else {
         $('.keywords-list').addClass('hidden');
         $('#delete_keyword_in_list').addClass('hidden');
         $(this).html('Show keywords list');
     }
     
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
  		//$('.file_name').html();
  		$('.file_name').attr('data-content',e.target.files[0].name)
      $('.file_name').popover();
  });
});
    
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  // if (n == (x.length - 1)) {
  //   document.getElementById("nextBtn").innerHTML = "Submit";
  // } else {
  //   document.getElementById("nextBtn").innerHTML = "Next";
  // }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
    if(!$('.next-button').hasClass('disabled')) { 
      var x = document.getElementsByClassName("tab");
     
      x[currentTab].style.display = "none";
      currentTab = currentTab + n;
      if(currentTab == 1) {
      } else if (currentTab == 2) {
        $('.next-button').html('Create a new data Collection');
      } else if (currentTab == 3) {
        lanch_request();
        paste_param();
        $('.next-button').html('Launch');
      } else {
        $('.next-button').html('Next');
      }
      
      if (currentTab >= x.length) {
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function get_locations() {
  console.log("request"); 
  $.ajax({
      url: 'get-locations',
      type: 'GET',
      dataType: 'json',
  })
  .done(function(response) {
    var locations = response.data
    $('input[name="location"]').html('');
    for(var i = 0; i < locations.length; i++){
      $('input[name="location"]').append('<option value='+locations[i].criteria_id+'>'+locations[i].location_name+'</option>');
    }
    console.log("The location must to be append");
    console.log(locations);
  })
  .fail(function() {
      console.log("error");
  });
}

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
                                            '<td><input class="ckeck_keyword" type="checkbox" /></td>'+
                                            '<td>'+list_unique[j]+'</td>' +
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
                                            '<td>'+value+'</td>'+
                                         '</tr>');
       });
    } else {
          $('.keywords-duplicate-list tbody').append('<span>No duplicate entry found!</span>');
    }
}

function lanch_request() { 
  var params = {
    'monthly_searches': $('input[name="monthly_searches"]').is( ":checked" ) ? 1 : 0,
    'location_id': $('select[name="location"]').val(),
    'convert_null_to_zero': $('input[name="convert_null_to_zero"]').is( ":checked" ) ? 1 : 0,
  };
  var data = keyword_list.uniq();
  $.ajax({
      url: 'make-request-adwords',
      type: 'POST',
      dataType: 'json',
      data: {keywords: data, params: params},
  })
  .done(function(data) {
      console.log(data);
  })
  .fail(function() {
      console.log("error");
  });
}

function paste_param() {
  console.log("paste param");
  $('.campaign_name').html($('input[name="campaign_name"]').val());
  $('.language_code').html($('input[name="language_code"]').val());
  $('.monthly_searches').html($('input[name="monthly_searches"]').val());
  $('.convert_null_to_zero').html($('input[name="convert_null_to_zero"]').val());
  $('.location').html($('input[name="location"]').val());
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}



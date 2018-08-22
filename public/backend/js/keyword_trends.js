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
  });
  
  $('#show_keyword_list').on('click', function(){
     if($('.keywords-list').hasClass('hidden')) {
         $('.keywords-list').removeClass('hidden');
         $(this).html('Hide keywords list');
     } else {
         $('.keywords-list').addClass('hidden');
         $(this).html('Show keywords list');
     }
     
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
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
    if(!$('.next-button').hasClass('disabled')) { 
      var x = document.getElementsByClassName("tab");
     
      x[currentTab].style.display = "none";
      currentTab = currentTab + n;
     
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
                                            '<td>'+list_unique[j]+'</td>' +
                                            '<td><a href="#" data-id='+j+'><i class="fa fa-times"></i></a></td>'+
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

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
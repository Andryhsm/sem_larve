$(document).ready(function(){
    var currentTab = 0; 
    showTab(0); 
    
    function showTab(n) {
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
    }
    // $('#keyword_number').on('click', '.fa-angle-down', function() {
    //   var index = $(this).parents('tr').index();
    //   $('#keyword_number tr').eq(index + 2).slideToggle();
    //   if($(this).hasClass('fa-angle-down')) {
    //     $(this).removeClass('fa-angle-down');
    //     $(this).addClass('fa-angle-up');
    //   }
    //   else {
    //     $(this).removeClass('fa-angle-up');
    //     $(this).addClass('fa-angle-down');
    //   }
    // })
    
    $('#keyword_number').on('click', '.show-monthly', function() {
        console.log("click");
        var $icon = $(this).find('i');
        var $content_monthly_searches = $(this).parent().find('.content-monthly-searches');
        if($icon.hasClass('fa-angle-down')) {
          $icon.removeClass('fa-angle-down');
          $icon.addClass('fa-angle-up');
          $content_monthly_searches.removeClass('hidden');
        } else {
          $icon.removeClass('fa-angle-up');
          $icon.addClass('fa-angle-down');
          $content_monthly_searches.addClass('hidden');
        }
        
    })
    
    $('#campaign_list .show_keyword_number').click(function() {
      var campaign_id = $(this).attr('data-id');
      
      $.ajax({
				url: $(this).attr('action'),
				type: 'GET',
				data: {campaign_id: campaign_id},
			})
			.done(function(datas) {
				var months = [ "january", "february", "march", "april", "may", "june", 
               "july", "august", "september", "october", "november", "december" ];
				
				$('#keyword_number tbody').html('');
				
				if(datas.length !=0)
        {
          
           $.each(datas, function( index, value ) {
            var html = '<tr>';
    				  html += '<td>'+ value.keyword_name +'</td><td>'+ value.search_volume +'</td>';
    				  html += '<td>' + value.cpc + '</td><td>' + value.competition  + '</td>';
    				  
    				  if(value.target_monthly_search != null) 
    				    html += '<td style="width:25%;">';
    				      html += '<a class="btn btn-default show-monthly"><i class="fa fa-angle-down"></i></a>';
    				        if(value.target_monthly_search.length > 0) {
            				    html += '<div class="content-monthly-searches hidden">'+
            				              '<ul>';
                        				    var target_monthly_search = value.target_monthly_search.split('||');
                        				    $.each(target_monthly_search, function(i, val) {
                        				      var tab = val.split(';')
                        				      if(tab[2] != null) {
                            				    html += '<li>'+tab[0] + ' - ' + months[tab[1] - 1] + ' : ' + tab[2]+',</li>';
                            				    
                        				      }
                        				    });
              				  html +=   '</ul>';
              				          '</div></div>';
            				  }
    				    html += '</td>';
  				  html += '</tr>';
  				  
  				  $('#keyword_number tbody').append(html);
          });
        }
        else
        {
           $('#keyword_number tbody').append('<tr><td colspan="5">No record found</td></tr>');
        }
				
				var x = document.getElementsByClassName("tab");
        x[0].style.display = "none";
        showTab(1);
			})
			.fail(function(xhr) {
				//console.log(xhr.responseText);
			});
      
    });
    
      if ($('.delete-campaign').length > 0) {
        $('.delete-campaign').off('click');
        $('.delete-campaign').on('click', function (e) {
            e.preventDefault();
            var campaign_id = $(this).attr('data-id');
            var url = $(this).attr('action');
            var tr_table = $(this).closest('tr');
            
            $('#confirm').modal({backdrop: 'static', keyboard: false})
                .one('click', '#delete', function () {
                    $.ajax({
              				url: url,
              				type: 'POST',
              				data: {campaign_id: campaign_id},
              			})
              			.done(function(response) {
              				
              				console.log(response.status);
              				$('.notification').html('<div class="alert '+response.status+' alert-dismissible show" role="alert">'+
                      ' ' +response.message + ' '+
                      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                      '</button>'+
                    '</div>');
                    if(response.status == "alert-success"){
                      tr_table.remove();
                    }
              				
              			})
              			.fail(function(xhr) {
              				//console.log(xhr.responseText);
              			});
                });
        });
        
        
    }
    
  
    
    $('#previous').click(function(){
        var x = document.getElementsByClassName("tab");
        x[1].style.display = "none";
        showTab(0);
    })
    
    /***  Progress bar  
    var progressbar = $("#progressbar"),
	      progressLabel = $(".progress-label");

	  progressbar.progressbar({
	     value: false,
	     change: function () {
	        progressLabel.text(progressbar.progressbar("value") + "%");
	     },
	     complete: function () {
	        progressLabel.text("Complete!");
	     }
	  });

    function progress() {
        var val = progressbar.progressbar("value") || 0;

        progressbar.progressbar("value", val + 1);

        if (val < 99) {
            setTimeout(progress, 100);
        }
    }

    setTimeout(progress, 3000);
	    
	   /*** end progress bar ***/
});

function exportTo(type) {
  $('.content-monthly-searches').removeClass('hidden');
  $('#keyword_number').tableExport({
    filename: 'Keywords_%DD%-%MM%-%YY%',
    format: type,
  });
  $('.content-monthly-searches').addClass('hidden');
}

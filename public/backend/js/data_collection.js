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
    
    /*$('#keyword_number').on('click', '.show-monthly', function() {
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
        
    })*/
    
    $('#campaign_list .show_keyword_number').click(function() {
      var campaign_id = $(this).attr('data-id');
      
      $.ajax({
				url: $(this).attr('action'),
				type: 'GET',
				data: {campaign_id: campaign_id},
			})
			.done(function(datas) {
        
				var months = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
				var heads = ["Keyword", "Curency", "Avg. monthly searches", "Competition", "Top of page bid (low range)", "Top of page bid (high range)", "Ad impression share", "Organic impression share", "Organic average position", "In account?", "In plan?"];
        
        $('#keyword_number_tab').html('<table id="keyword_number" class="table table-bordered table-hover"><thead><tr class="keyword_number_tr"></tr></thead><tbody></tbody></table>');
        
				if(datas.length > 0)
        {
          // Affiche les entêtes des dates en fonction de la colonne target_monthly_search
          if(datas[0].target_monthly_search != null) {
            var html1 = '';
            var html2 = '';

            $.each(heads, function(i, head) {
              html1 += '<th>' + head + '</th>';
              html2 += '<div class="checkbox"><label><input class="col'+ (i+1) +'" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" value="'+ i +'">'+ head +'</input></label></div>';
            });
            
            var j = 12;
            $.each(datas[0].target_monthly_search.split('||'), function(key, item) {
              if(item != '') {
                var dates = item.split(';')
                html1 += '<th>Searches: ' + months[dates[1] - 1] +  ' ' + dates[0] + '</th>';
                html2 += '<div class="checkbox"><label><input class="col'+j+'" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" value="'+(j-1)+'">Searches: '+months[dates[1] - 1] +  ' ' + dates[0]+'</input></label></div>';
                j++;
              }
            });
            $('.keyword_number_tr').html(html1);
            //console.log($('.keyword_number_tr').html())
            $('#showKeywordColumnModal .modal-body').html(html2);
          }
           $.each(datas, function( index, value ) {
            var html = '<tr>';
    				  html += '<td>'+ value.keyword_name +'</td><td>'+ value.currency +'</td>';
    				  html += '<td>' + value.avg_monthly_searches + '</td><td>' + value.competition  + '</td>';
              html += '<td>' + value.low_range_top_of_page_bid + '</td><td>' + value.high_range_top_of_page_bid  + '</td>';
              html += '<td>' + value.ad_impression_share + '</td><td>' + value.organic_impression_share  + '</td>';
              html += '<td>' + value.organic_average_position + '</td><td>' + value.in_account  + '</td>';
              html += '<td>' + value.in_plan + '</td>';
    				  
			        if(value.target_monthly_search != null) {
      				    var target_monthly_search = value.target_monthly_search.split('||');
      				    $.each(target_monthly_search, function(i, val) {
                    if(val != '') {
        				      var tab = val.split(';')
        				      if(tab[2] != '') 
            				    html += '<td>' + tab[2]+ '</td>';
            				  else  
        				        html += '<td></td>';
                    }
      				    });
        				  
      				  }
    				    
  				    html += '</tr>';
  				  
  				  $('#keyword_number tbody').append(html);
          });
        }
        else
        {
           $('#keyword_number tbody').html('<tr><td colspan="11">No record found</td></tr>');
        }
        
				var x = document.getElementsByClassName("tab");
        x[0].style.display = "none";
        showTab(1);

        /****  Option de dataTable qui affiche seulement les 5 premiers colonnes  ****/
        var columns = [{searchable: true, sortable: true}];
        var nb = $('#keyword_number thead tr').children().length;
        $('#showKeywordColumnModal .modal-body .col' + 1).prop('checked', true);
        for( var i = 1 ; i < nb ; i++ ) {
          if(i<5) {
            columns.push({searchable: false, sortable: true});
            $('#showKeywordColumnModal .modal-body .col' + (i+1)).prop('checked', true);
          }
          else columns.push({searchable: false, sortable: true, visible: false});
        };

        var date = new Date();
                
        $('#keyword_number').DataTable({
          "dom": 'lBfrtip',
            buttons: [
            {
                extend: 'excelHtml5',
                title: 'Keywords_'+date
            },
            {
                extend: 'csvHtml5',
                title: 'Keywords_'+date
            }
            ],
            "destroy":true,
            "paging": true,
            "searching": true,
            "responsive": true,
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true,
            "bAutoWidth": false,
            "order": [[5, "desc"]],
            "lengthMenu": [20, 40, 60, 80, 100],
            "pageLength": 20,
            "scrollX": true,
            columns: columns,
            fnDrawCallback: function () {
                var $paginate = this.siblings('.dataTables_paginate');
                if (this.api().data().length <= this.fnSettings()._iDisplayLength) {
                    $paginate.hide();
                }
                else {
                    $paginate.show();
                }
            }
        });

        //$('.dt-buttons').addClass('hidden');

        $('#keyword_number_length .btn-small').remove();
        $('#keyword_number_length').append('<div class="btn btn-small">'+
            '<div class="btn-group" data-toggle="modal" data-target="#showKeywordColumnModal">'+
              '<a href="#" class="btn btn-default">Select column to show</a>'+
              '<a href="#" class="btn btn-default"><span class="caret"></span></a>'+
            '</div>'+
        '</div>');


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
  //$('.content-monthly-searches').removeClass('hidden');
  $('#keyword_number').tableExport({
    filename: 'Keywords_%DD%-%MM%-%YY%',
    format: type,
  });
  //$('.content-monthly-searches').addClass('hidden');
}

function exportTo() {
  $('.buttons-excel').trigger('click');
}


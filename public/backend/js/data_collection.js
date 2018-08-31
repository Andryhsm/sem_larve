$(document).ready(function(){
    var currentTab = 0; 
    showTab(0); 
    
    function showTab(n) {
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
    }
    
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
   

    if($('#keyword_number').length > 0) {
        var campaign_id = $('.campaign_id').val();
        console.log(campaign_id + ' +++')  
        $.ajax({
            url: $('#keyword_number').attr('data-route'),
            type: 'GET',
            data: {campaign_id: campaign_id},
        })
        .done(function(datas) {
            console.log(datas);

            $(".research_name span").html(datas.campaign.campaign_name);
            $(".country_name span").html(datas.country);
            $(".state_name span").html(datas.state);
            $(".area_name span").html(datas.area);
            $(".language span").html(datas.language);
            $(".mounthly_research span").html((datas.campaign.monthly_searches != null || datas.campaign.monthly_searches != 0)? " oui" : " non");
            $(".search_partner span").html(" non");
            $(".null_to_zero span").html((datas.campaign.convert_null_to_zero != null || datas.campaign.convert_null_to_zero != 0)? " oui" : " non");
            var months = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
            
            if(datas.datas.length > 0) {
                // Affiche les entêtes des dates en fonction de la colonne target_monthly_search
                if(datas.datas[0].target_monthly_search != null) {
                    var html1 = '';
                    var html2 = '';
                    var j = 12;
                    $.each(datas.datas[0].target_monthly_search.split('||'), function(key, item) {
                        if(item != '') {
                            var dates = item.split(';')
                            html1 += '<th>Searches: ' + months[dates[1] - 1] +  ' ' + dates[0] + '</th>';
                            html2 += '<div class="checkbox"><label><input class="col'+j+'" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" value="'+(j-1)+'">Searches: '+months[dates[1] - 1] +  ' ' + dates[0]+'</input></label></div>';
                            j++;
                        }
                    });
                    console.log(html1)
                    $('.keyword_number_tr').append(html1);
                  
                    $('#showKeywordColumnModal .modal-body').append(html2);
                }
                $.each(datas.datas, function( index, value ) {
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
            else {
                $('#keyword_number tbody').html('<tr><td colspan="11">No record found</td></tr>');
            }
            

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
            }
            
            /***  Create dataTable  ***/
            var date = new Date();
            

            $('#keyword_number').DataTable({
                "dom": 'lBfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: 'Keywords_'+date
                },
                {
                   extend: 'csvHtml5',
                   title: 'Keywords_'+date
                }],
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
        
    }
});



function exportTo() {
  $('.buttons-excel').trigger('click');
}


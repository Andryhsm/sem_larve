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
            				
            			//	console.log(response.status);
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
        //console.log(campaign_id + ' +++')  
        $.ajax({
            url: $('#keyword_number').attr('data-route'),
            type: 'GET',
            data: {campaign_id: campaign_id},
            beforeSend: function() {
                        $.LoadingOverlay("show", { 'size': "10%", 'zIndex': 9999 });
                    },
        })
        .done(function(datas) {
           // console.log(datas.state)
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
                // var v0 = -1;
                // var nb0 = 0;
                // $.each(datas.datas, function(k, v) {
                //     if(v.target_monthly_search != null) v0 = k;
                // });
                if(datas.datas[0].target_monthly_search != '') {
                    var html1 = '';
                    var html2 = '';
                    var j = 5;
                    var inc = 0;
                    $.each(datas.datas[0].target_monthly_search.split('||'), function(key, item) {
                        if(item != '') {
                            var dates = item.split(';')
                            html1 += '<th>Searches: ' + months[dates[1] - 1] +  ' ' + dates[0] + '</th>';
                            html2 += '<div class="checkbox"><label><input class="col'+j+'" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" value="'+(j-1)+'">Searches: '+months[dates[1] - 1] +  ' ' + dates[0]+'</input></label></div>';
                            j++;
                            inc++;
                            //nb0++;
                        }

                    });
                    //console.log(html1)
                    $('.keyword_number_tr').append(html1);
                  
                    $('#showKeywordColumnModal .modal-body').append(html2);
                }
                $.each(datas.datas, function( index, value ) {
                    var cpc_arrondi = value.cpc / 1000000;
                    cpc_arrondi  = cpc_arrondi.toFixed(2);
                    var html = '<tr>';

                            competitionArrondi = value.competition.toFixed(3);
                            var bg = "";
                            if(competitionArrondi >= 0 && competitionArrondi < 0.2){
                                bg = "bgred";
                            }
                            else if (competitionArrondi >= 0.2 && competitionArrondi < 0.4){
                                bg = "bgorange";
                            }
                            else if (competitionArrondi >= 0.4 && competitionArrondi < 0.6){
                                bg = "bgyellow";
                            }
                            else if (competitionArrondi >= 0.6 && competitionArrondi < 0.8){
                                bg = "bggreenyellow";
                            }
                            else {
                                bg = "bggreen";
                            }



                            html += '<td>'+ value.keyword_name +'</td>'
                            html += '<td>' + value.avg_monthly_searches + '</td>';
<<<<<<< HEAD
                            html += '<td class="'+bg+'">' + competitionArrondi + '</td>';
                            html += '<td>'+ value.cpc +'</td>';
=======
                            html += '<td>' + value.competition  + '</td>';
                            html += '<td>'+ cpc_arrondi +'</td>';
>>>>>>> bb55be6eea2b9944ecd51040047a8671f975100e
                            // html += '<td>' + value.low_range_top_of_page_bid + '</td>';
                            // html += '<td>' + value.high_range_top_of_page_bid  + '</td>';
                            // html += '<td>' + value.ad_impression_share + '</td>';
                            // html += '<td>' + value.organic_impression_share  + '</td>';
                            // html += '<td>' + value.organic_average_position + '</td>';
                            // html += '<td>' + value.in_account  + '</td>';
                            // html += '<td>' + value.in_plan + '</td>';
                    var jinc = 0;
                    if(value.target_monthly_search != null) {
                        var target_monthly_search = value.target_monthly_search.split('||');
                        
                        for (var i = 0; i <= 11; i++) {
                            if(typeof(target_monthly_search[i]) != "undefined") {
                                var tab = target_monthly_search[i].split(';');
                                if(tab[2] != '') 
                                    html += '<td>'+ tab[2] +'</td>';
                                else  
                                    html += '<td>0</td>';
                            } else {
                                html += '<td>0</td>';
                            }
                            jinc ++;
                        }


                        // $.each(target_monthly_search, function(i, val) {
                        //     if(val != '' || val != null) {
                        //         var tab = val.split(';');
                        //         if(tab[2] != '') 
                        //             html += '<td>' + tab[2]+ '</td>';
                        //         else  
                        //             html += '<td></td>';
                        //     } else 
                        //          html += '<td></td>';
                        // });
                              
                     }
                    // else 
                    //     if(v0 != -1 && nb0 >0) 
                    //         for(var i=0 ; i< nb0 ; i++) html += '<td></td>';
                            
                    html += '</tr>';
                    
                    $('#keyword_number tbody').append(html);
                    // console.log(10);
                    // $('.keyword_number tr').each(function(){
                    //     console.log("each");
                    //     var ligne = $(this);
                    //     ligne.children("td").each(function(index, elt){
                    //        console.log($(elt).html());
                    //        console.log(1000);
                    //     });
                        // var $cell1 = $cell[2];
                        // console.log()
                        // if($cell1.val() > 0 && $cell1.val() < 0,2){
                        //      $cell1.css('background','#F00');
                        // }
                        // else{
                        //     $cell1.css('background','#0F0');
                        // }
                    });

                
            }
            else {
                $('#keyword_number tbody').html('<tr><td colspan="11">No record found</td></tr>');
            }
            
           // console.log($('#keyword_number').html())
            /****  Option de dataTable qui affiche seulement les 5 premiers colonnes  ****/
            var columns = [{searchable: true, sortable: true}];
            var nb = $('#keyword_number thead tr').children().length;
            $('#showKeywordColumnModal .modal-body .col' + 1).prop('checked', true);
              
            for( var i = 1 ; i < nb ; i++ ) {
                if(i<4) {
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

            $.LoadingOverlay("hide");
        })
        .fail(function(xhr) {
            //console.log(xhr.responseText);
        });
        
        
    }
});



function exportTo() {
  $('.buttons-excel').trigger('click');
}


    

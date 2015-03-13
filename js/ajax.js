


/*******************************************************************************************************************
This is for getting the event info from the table 
It needs to be passed to booking.php to be loaded into the webhook for gocardless
********************************************************************************************************************/
var MyRows = $('table#htmlTable').find('tbody').find('tr');
for (var i = 0; i < MyRows.length; i++) {
var MyIndexValue = $(MyRows[0]).find('td:eq(1)').text();
}

//alert(MyIndexValue);



/*******************************************************************************************************************
This is for posting info to  booking.php  
********************************************************************************************************************/


        $("#booking").submit(function(evt) {
            evt.preventDefault();
            
            var url = $(this).attr('action');
           
            var postData = $(this).serialize();
            var form= $(this) ;
            var bla = $('#first-name').val();


/*******************************************************************************************************************
Heres the post method loaded up with the url data and callback function which either returns a redirect url to payment 
gateway or an error message outputted to the .info div at the top of the modal.
********************************************************************************************************************/

            $.post(url, postData, function(o) {

            if(o.result == 1){


/*******************************************************************************************************************
If there no errors returned by booking.php this is what happens
********************************************************************************************************************/

            var nicestring = '';
            /* nicestring +=  '<table  border="1">';
           	 	for( key in o ) {
               
                nicestring +=   '<tr>';
                nicestring  +=   '<td>';
                nicestring +=     [key] ;
                nicestring +=    '</td><td>';
                nicestring +=  o[key]  ;
                nicestring +=   '</tr>';
                // alert( " " + [ key ] + ", " + o[ key ] );
                }
                nicestring += '</table>' ;*/
                    
            		  
                    window.location.href = o.url ;



       /* $(".info").append(nicestring);
              $(function() {
                            $('.info').delay(5000).fadeOut('.info', function() {
                                    $('.info').empty();
                                    $('.info').show();
                                                                             });
                            });*/


            	 	
            	 }
/*******************************************************************************************************************
If errors are returned by booking.php we output them here
********************************************************************************************************************/
     else{
                  delete o['result'];
                     var errorString = '<div class="alert alert-danger">';

                     errorString  +=    '<table >';
                     for( key in o) {
                        errorString +=   '<tr>';
                errorString  +=   '<td>';
               
                errorString +=  o[key]  ;
                errorString +=   '</tr>';
                // alert( " " + [ key ] + ", " + o[ key ] );
                }
                errorString += '</table>' ;
                errorString += '</div>' ;


            		$(".info").append(errorString);
                    
                
                     //   $(function() {
                                $('.info').delay(10000).fadeOut('.info', function() {
                                $('.info').empty();
                                $('.info').show();
  //  });
});

               
            	
               
                
                }
                
            }, 'json');
        });
   
 
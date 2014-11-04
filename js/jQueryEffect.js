/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
            
        
          $("#searchBox").focus();
          $("#datepicker").datepicker();
          $("#project_tab").tabs();
          $("#tabs").tabs();
          
          
           $(".numberFilter").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        
					var code = event.which;
					var foo = 0;
					// prevent if already dot
					if (code != 8 && code != 46) {
						if ((foo == 0) && (code != 190) && (event.which < 46 || event.which > 59)) {
							event.preventDefault();
						} // prevent if not number/dot
					}
					if ($(this).val().indexOf('.') > -1) {
						foo = 1;
						if (code == 190)
							event.preventDefault();
					 }
				 /*       
						if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
							 // Allow: Ctrl+A
							(event.keyCode == 65 && event.ctrlKey === true) || event.which == 46
							 // Allow: home, end, left, right
							(event.keyCode >= 35 && event.keyCode <= 39)) {
								 // let it happen, don't do anything
								 return;
						}
						else {
							// Ensure that it is a number and stop the keypress
							if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
								event.preventDefault(); 
							}   
						}
						*/
    });
    
    $( ".date" ).attr({
        placeholder: "dd/mm/yyyy"
    });
    
     $(".fourlength").attr('maxlength',4);
     $(".tenlength").attr('maxlength',10);
     
     
     
        function saveajax(url,id,fieldname,fieldvalue){
             //var savefieldurl = '<?php echo $this->createUrl("quoh/savefield"); ?>';
              $.ajax({
                                    url: url,
                                    data: {id:id,fieldname:fieldname,fieldvalue:fieldvalue},
                                    type: 'get',
                                    dataType: 'html',
                                    success:function(data){
                                        
                                    },
                                    error: function() { // if error occured
                                          alert("Error: Save Field  occured.please try again");    
                                     }
                }); 
            
        }
          
            
});
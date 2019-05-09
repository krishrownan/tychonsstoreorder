require(["jquery"], function($){
    $(document).ready(function() {

    	//slide open

    	$(".add-to-store-order").on("click",function(e){

    		e.preventDefault();

    		$(".storeorder-items-wrapper").show();

    	});  

    	//slide close

    	$("#btn-store-close").on("click",function(){

    		$(".storeorder-items-wrapper").hide();
    	}); 

    	//delete product 
    });
});
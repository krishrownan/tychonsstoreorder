require(["jquery","Magento_Ui/js/modal/modal"], function($){
    $(document).ready(function() {
       $("#addto-store").on("click",function(e){

       	e.preventDefault();

       	$(this).addClass("disabled");

       	$("button#addto-store span").text("Adding");

       	var product_id = $(this).attr("product_id");

       	var product_name = $(this).attr("product_name");

       	var product_sku = $(this).attr("product_sku");

       	var product_price = $(this).attr("product_price");

       	var product_url = $(this).attr("product_url");

       	var product_desc = $(this).attr("product_desc");

       	var product_image = $(".fotorama__img").first().attr("src");

       	var qty = $("#qty").val();

       	var total_price = qty*product_price;

       	var owner = "krishna";

       	var url = $(this).attr("url");

        $.ajax({
            url: url,
            type: "POST",
            data: {
            	product_id:product_id,
            	product_name:product_name,
            	product_price:product_price,
            	product_url:product_url,
            	qty:qty,
            	total_price:total_price,
            	product_image:product_image,
            	owner:owner,
            	sku:product_sku,
            	desc:product_desc

            },
            cache: false,
            success: function(response){

              $(".no-store-products").remove();

            	$("button#addto-store span").text("Added");

            	setTimeout(function(){
            	
            	$("button#addto-store").removeClass("disabled");

            	$("button#addto-store span").text("Add to Store Order");

            	}, 1000);

              //console.log(response);

            	$(".storeorder-counter-number").text(response.count);
                
                //update html content after product added

                $("#storeorder-cart").empty();

                $.each(response, function(key, product) {

                if (product.product_id != null && product.product_id != undefined){

                $("#storeorder-cart").append('<li class="store-product-item" data-role="store-product-item">'+
                            '<div class="store-product">'+
                                '<a tabindex="-1" class="store-product-item-photo" href="'+product.product_url+'"'+ 
                                    'title="'+product.product_name+'">'+
                                    '<span class="store-product-image-container" >'+
                                    '<span class="store-product-image-wrapper">'+
                                    '<img class="store-product-image-photo" src="'+product.product_image+'"'+ 
                                    'alt="'+product.product_name+'">'+
                                    '</span>'+
                                    '</span>'+
                                '</a>'+
                                '<div class="store-product-item-details">'+
                                    '<strong class="store-product-item-name">'+
                                    '<a href="'+product.product_url+'">'+product.product_name+'</a>'+
                                    '</strong>'+
                                        '<div class="store-product-item-pricing">'+
                                            '<div class="store-price-container">'+
                                                '<span class="store-price-wrapper">'+
                                                    '<span class="store-price-excluding-tax">'+
                                                    '<span class="store-minicart-price">'+
                                                    '<span class="store-price">'+product.product_price+'</span>'+        
                                                    '</span>'+
                                                    '</span>'+
                                                '</span>'+
                                            '</div>'+
                                            '<div class="store-details-qty store-qty">'+
                                                '<label class="label">Qty</label>'+
                                                '<input type="number" size="4" value="'+product.qty+'" class="store-item-qty store-cart-item-qty" id="">'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="store-product actions">'+
                                        '<div class="store-primary">'+
                                            '<a class="store-action store-edit" href="'+product.product_url+'" title="Edit item">'+
                                            '<span>Edit</span>'+
                                            '</a>'+
                                        '</div>'+
                                        '<div class="store-secondary">'+
                                            '<a href="#" id="remove-product-'+product.product_id+'" class="store-action store-delete"'+
                                            'data-trigger="store-trigger-delete"'+ 
                                            'store-product-id="'+product.product_id+'"'+ 
                                            'store-customer-id="'+product.customer_id+'" title="Remove item">'+
                                            '<span>Remove</span>'+
                                            '</a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</li>');
              }
              });

              $(".store-delete").on('click',function(){
                $("#popup-mpdal").modal("openModal");

                var id_product = $(this).attr("store-product-id");

                var id_customer = $(this).attr("store-customer-id");

                $('#popup-mpdal').attr('id_product',id_product).attr('id_customer',id_customer);
            });
                
            }
        });
        return false;

       });
    });
});
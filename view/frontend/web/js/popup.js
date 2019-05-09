require(
        [
            'jquery',
            'Magento_Ui/js/modal/modal'
        ],
        function(
            $,
            modal
        ) {
            var options = {
            	modalClass: "store-popup",
                type: 'popup',
                responsive: true,
                innerScroll: true,
                buttons: [{
                    text: $.mage.__('Cancel'),
                    class: 'action-dismiss',
                    click: function () {
                        this.closeModal();
                    }
                },
                {
                    text: $.mage.__('OK'),
                    class: 'action-primary action-accept del-store-pro',
                    click: function () {
                        this.closeModal();
                        //delete posted store product using ajax

                        var id_product = $('#popup-mpdal').attr('id_product');

                        var id_customer = $('#popup-mpdal').attr('id_customer');

                        //alert(id_customer+id_product);

				        $.ajax({
				            url: "http://192.168.1.26:81/magento23/storeorder/index/deleteproduct",
				            type: "POST",
				            data: {
				            	product_id:id_product,
				            	customer_id:id_customer
				            },
				            cache: false,
				            success: function(response){

				            $(".storeorder-counter-number").text(response.count);

				            $("#remove-product-"+id_product).closest("li").remove();

/*							$.each(response, function(key, product) {
								//alert(key + ' ' + value.product_name);

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
				                                    '<a href="#" class="store-action store-delete"'+
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

							});*/
				                
				                console.log(response);
				            }
				        });

                    }
                }]
            };

            var popup = modal(options, $('#popup-mpdal'));
            $(".store-delete").on('click',function(){
                $("#popup-mpdal").modal("openModal");

                var id_product = $(this).attr("store-product-id");

                var id_customer = $(this).attr("store-customer-id");

                $('#popup-mpdal').attr('id_product',id_product).attr('id_customer',id_customer);
            });
        }
    );
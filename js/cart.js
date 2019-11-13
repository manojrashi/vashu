/** Add To Cart *****/

$('.add-to-cart').on('click',function(){
	var element =$(this);
	var data_one=element.data('one');
	var data_two=element.data('two');
	var itemImg = $(this).parents('.item').find('figure img');
	console.log('image---'+itemImg);
	flyToElement($(itemImg), $('.cart_anchor'));
	addToCart(data_one,data_two) ;
});	




function flyToElement(flyer, flyingTo) {
    var $func = $(this);
    var divider = 3;
    var flyerClone = $(flyer).clone();
    $(flyerClone).css({position: 'absolute', top: $(flyer).offset().top + "px", left: $(flyer).offset().left + "px", opacity: 1, 'z-index': 1000});
    $('body').append($(flyerClone));
    var gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 2) - ($(flyer).width()/divider)/2;
    var gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 2) - ($(flyer).height()/divider)/2;
     
    $(flyerClone).animate({
        opacity: 0.4,
        left: gotoX,
        top: gotoY,
        width: $(flyer).width()/divider,
        height: $(flyer).height()/divider
    }, 700,
    function () {
        $(flyingTo).fadeOut('fast', function () {
            $(flyingTo).fadeIn('fast', function () {
                $(flyerClone).fadeOut('fast', function () {
                    $(flyerClone).remove();
                });
            });
        });
    });
}


function addToCart(product_id,product_price_id){
        var cart = $('.cart');
     	var qty=$('#qty_'+product_price_id).val();
		var prodname=$("#prodname_"+product_price_id).val();
        
		if(product_id){
		$.ajax({
			url:"ajax-process.php",
			data:{product_id:product_id,product_price_id:product_price_id,qty:qty,action:"add_cart"},
			success:function(data){
				$("#c_itmes").html(data);
				$("#c_itmes").reload();
			}
			
			})	
			
		}
  
	}
	function addToCartSearch(product_id,product_price_id){
   
        var cart = $('.cart');
        var imgtodrag = $('#imgsearch_'+product_price_id).eq(0);
		var qty=$('#qtysearch_'+product_price_id).val();
		var prodname=$("#searchprodname_"+product_price_id).val();
        
		if(product_id){
		$.ajax({
			url:"ajax-process.php",
			data:{product_id:product_id,product_price_id:product_price_id,qty:qty,action:"add_cart"},
			success:function(data){
				$("#c_itmes").html(data);
				$("#chackout").html("<img src='images/loading.gif'>");
				$("#chackout").load("getCart.php");
				$("#addedprod").html(prodname+" to the basket");
				$("#cartmsg").show();
					setTimeout(function () {
						$("#cartmsg").fadeOut();
					},2000)
				}
			
			})	
			
		}
  
	}





	/************************************** UPDATE CART *************************************************/
	function UpdateMyCart(product_price_id){
        var qty=$("#p_"+product_price_id).val();
        var cart = $('.cart');
	   	if(qty=='' || qty==0){
		var qty=1;	
		}else{
		qty=qty;		
		}
	    if(product_price_id && qty >0){
			window.location.href='process.php?pid='+product_price_id+'&qty='+qty+'&action=edit_cart';
			}  
	}
	
	/************************************** Delete CART Item *************************************************/
	function deleteCart(product_price_id){
   	
	    if(product_price_id){
			window.location.href='process.php?pid='+product_price_id+'&action=del_cart';
			}  
	}

	/******************************************** Increse/dercrese quantity *******************************/
	function IncQty(pid){
		var qty=$("#p_"+pid).val();
		var newqty=parseInt(qty)+1;
		$("#p_"+pid).val(newqty)
		UpdateMyCart(pid);   
	   }
       function DescQty(pid){
		var qty=$("#p_"+pid).val();
		var newqty=parseInt(qty)-1;
		$("#p_"+pid).val(newqty)
		UpdateMyCart(pid);   
	   }
	/******************************************** Increse/dercrese Precart quantity *******************************/
	function IncpreQty(pid){
		var qty=$("#pre_"+pid).val();
		var newqty=parseInt(qty)+1;
		$("#pre_"+pid).val(newqty)
		UpdateMyCart(pid);   
	   }
       function DescpreQty(pid){
		var qty=$("#pre_"+pid).val();
		var newqty=parseInt(qty)-1;
		$("#pre_"+pid).val(newqty)
		UpdateMyCart(pid);   
	   }
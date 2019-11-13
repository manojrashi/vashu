/******************************************************GET LISTING PRICE*****************************/
function getListingPrice(id,product_price_id){
	//var divid="#pricecaption_"+id;
	var divclass=".pricecaption_"+id;
	//alert(divid);
	$.ajax({
		url:"getListingPrice.php",
		data:{product_id:id,product_price_id:product_price_id},
		success:function(data){
			//alert(data);
			//$(divid).html(data);
			$(divclass).html(data);
			}
		
		})
	
}
/***************************************Change Product Size********************************************/
function changePsize(product_price_id){
	var fldid="#pdesc_"+product_price_id;
	var chkid="#sizechk_"+product_price_id+"_"+i;
	//alert(chkid);
	$(".product-detail-box").hide();
	$(fldid).show();
	$(".sizechk").removeAttr("checked");
	$('input:radio[value='+product_price_id+']').prop('checked', true);
	
}
/**************************************** Do Listing Searching ****************************************/
function doListingSearch(){
	$("#mypage").val(1);
	$.ajax({
		url:"ajax-listing-search.php",
		data:$('#leftsearchfrm').serialize(),
		beforeSend:function(){
		$(".fade-main-page").show();	
		},
		success:function(data){
			//alert(data);		
		$("#listing_search_result").html(data);	
		var thisqty=$("#search_rs_qty").val();
		$("#num-products").html(thisqty);
		$(".fade-main-page").hide();	
		}
		
		
		})
	
}
/**************************************** Do Sorting****************************************/
function doSorting(val){
	$("#dosorting").val(val);
	$.ajax({
		url:"ajax-listing-search.php",
		data:$('#leftsearchfrm').serialize(),
		beforeSend:function(){
		$(".fade-main-page").show();	
		},
		success:function(data){
			//alert(data);		
		$("#listing_search_result").html(data);	
		$(".fade-main-page").hide();	
		}
		
		
		})
	
}
/**************************************** Do Listing Searching By PAging ****************************************/
function doPagingSearch(page){
	//alert(page);
	$("#mypage").val(page);
	$.ajax({
		url:"ajax-listing-search.php",
		data:$('#leftsearchfrm').serialize(),
		beforeSend:function(){
		$(".fade-main-page").show();	
		},
		success:function(data){
			//alert(data);		
		$("#listing_search_result").html(data);	
		$(".fade-main-page").hide();	
		}
		
		
		})
	
}
/******************************************* getAllBrand*************************************************/
function getAllBrand(q){
	//alert(q);
	$.ajax({
		url:"getAllBrand.php",
		data:{"q":q},
		
		success:function(data){
			//alert(data);		
		$("#resultbrands").html(data);	
		}
		
		
		})
}
/****************************************** Add to WishList ************************************************/
function addWishlist(pid){
	$.ajax({
		url:"addToWishList.php",
		data:{pid:pid},
		success:function(data){
			//alert(data);
	    $("#addedprod").html(data);
		$("#cartmsg").show();
		$("#wishlist").hide();	
		setTimeout(function () {
						$("#cartmsg").fadeOut();
					},2000)
		}
				
		})	
}

jQuery.fn.prodGallery = function() {

  return this.each(function() {

    var gallery    = $(this);
    var images     = gallery.find('.product-gallery__images');
    var thumbs     = gallery.find('.product-gallery__thumbs');
    var thumb      = thumbs.find('.product-gallery__thumb');
    var thumb_numb = 4; // количество миниатюр



    images.owlCarousel({
      margin: 0,
      nav: true,
      dots: true,
      items : 1,
      navText: [ , ]
    });

	// ЕСЛИ ФОТО БОЛЬШЕ 4 НАВИГАЦИЯ СТАНОВИТСЯ СЛАЙДЕРОМ
	if (thumb.length > thumb_numb) {
		thumbs.addClass('owl-carousel').owlCarousel({
			margin: 20,
			nav: true,
			navText: [ , ],
			dots: true,
			items : thumb_numb,
			responsive : {
				0: {
					margin: 6
				},
				768 : {
					margin: 20
				}
			}
		});
	}

	//НАВИГАЦИЯ К СЛАЙДЕРУ 
	// от навигации к изображениям
	thumb.on('click', function(event) {
		var index;
		// ПРОВЕРЯЕМ ЯВЛЯЕТСЯ ЛИ НАВИГАЦИЯ OWL КАРУСЕЛЬЮ
		if($(this).parent().hasClass("owl-item")) {
			index = $(this).parent().index();
		}
		else {
			index = $(this).index();
		}
		images.trigger('to.owl.carousel', index);
		thumb.removeClass('is-active');
		$(this).addClass('is-active');
	});


	// от изображений к навигации
	images.on('changed.owl.carousel', function (e) {
		
   thumb.removeClass('is-active');
   thumb.eq(e.item.index).addClass('is-active');


   if (thumbs) {
    var arr = [], min_arr, max_arr;

    thumbs.find('.active > .product-gallery__thumb').each(function() {
     arr.push($(this).parent().index())
   })

    min_arr=arr[0];
    max_arr=arr[thumb_numb - 1];

    if (e.item.index > max_arr ) {
     thumb.trigger('next.owl.carousel');
   }
   if (e.item.index < min_arr ) {
     thumb.trigger('prev.owl.carousel');
   }
 }
});
  return $(this);
});

};

$('.product-gallery').prodGallery();







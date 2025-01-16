jQuery(document).ready(function($) {

		$(function(){
		  
		  // vars
		  var slider, btn, tabC, prevIndex, objTab = {};
		  
		  btn = $(".dn-slider-button");
		  tabC = $(".tabContent");
		  
		  prevIndex = 2;
		  
		  btn.on("click", function() {
		    
		    var th, thIndex;
		    
		    th = $(this);
		    thIndex = th.index();
		       
		    if(!th.hasClass("active")) {
		      /*if(prevIndex != thIndex && prevIndex !== 'undefined') {
		        btn.eq(prevIndex).removeClass("active");
		        tabC.eq(prevIndex).removeClass("show");
		      }*/

			btn.removeClass("active");
			tabC.removeClass("show");

		      btn.eq(thIndex).addClass("active");
		      tabC.eq(thIndex).addClass("show");
		      if(prevIndex == 1){
		        $('.dn-slider-outer').removeClass("day-black");
		      }else{
		        $('.dn-slider-outer').addClass("day-black");
		      }
		      prevIndex = thIndex;
		      
		      //slick position filter
		      //if you have problem with slick in tabs, use next option
		      //magic option
		      tabC.eq(thIndex).find(".day-night-slider").slick('setPosition');
		    }
		  });
		  
		  slider = $(".day-night-slider");
		  
		  slider.slick({      
		        slidesToShow: 3,
						infinite: true,
		        slidesToScroll: 1,
		        arrows: true,
		        speed: 900,
		        dots: false,
						centerMode: false,
						variableWidth: false,
						useTransform: true,
						lazyLoad: false,
						prevArrow:"<button type='button' class='slick-arrow slick-prev'><i class='fa-solid fa-angle-left'></i></button>",
            nextArrow:"<button type='button' class='slick-arrow slick-next'><i class='fa-solid fa-angle-right'></i></button>",
		        responsive: [
		        {
		          breakpoint: 991,
		          settings: {
		            slidesToShow: 2,
		          }
		        },
		        {
		          breakpoint: 767,
		          settings: {
		            slidesToShow: 2,
		          }
		        },
						{
		          breakpoint: 640,
		          settings: {
		            variableWidth: false,
								slidesToShow: 1,
								centerMode: false,
		          }
		        }
		      ]
		    });

		  	slider.slick('setPosition');
		});
      

});
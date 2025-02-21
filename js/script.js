/*Topbar*/
jQuery(document).ready(function() { 
    // Close the popup and overlay when the close button is clicked
    jQuery('.btn-close').click(function() {
      jQuery('.top-bar').slideUp();
    });


    jQuery("li:has(ul)").click(function(event){

      event.preventDefault();
      //console.log('clickme');
      //jQuery(this).children("ul").slideToggle('fast');
      //jQuery(this).find('span').toggleClass('open');
      jQuery(this).children("ul").slideDown('fast');
      jQuery(this).find('span').addClass('open');


    });


    jQuery("li:has(ul) span").click(function(event){
        event.preventDefault();
        //console.log('clickme_ic');
        jQuery(this).parent().parent().children("ul").slideToggle('fast');
        jQuery(this).parent().find('span').toggleClass('open');
    });

    jQuery("li:has(ul) ul li a").click(function(event){        
        var url = jQuery(this).attr('href');
        var target =  jQuery(this).attr('target');       
        console.log(target);
        if(typeof url === "undefined"){ 
          //console.log(undefined);
          event.preventDefault();
        }else if(target === '_blank'){
          window.open(url, '_blank');
        }else{
          window.location.href=jQuery(this).attr('href');
        }
    });

    jQuery(".smooth-scroll a").click(function(event){
        event.preventDefault();
        //console.log('sm');
        var hrf = jQuery(this).attr('href');
        
        jQuery('html, body').animate({
            scrollTop: jQuery(hrf).offset().top
        }, 2000);
    });
    

});


 if( jQuery('.section-parallax').length )         // use this if you are using id to check
{


      //Parallax-Custom
      const section = jQuery('.section-parallax');
      const shapes = jQuery('.shape-1, .shape-2, .shape-3, .shape-4');
      const parallaxMultipliers = [0.05, -0.1, 0.15, 0.0001];



      let shapeOffsets = [];
      let isSectionInView = false;

      shapes.each(function(index, shape) {
        shapeOffsets[index] = 0;
      });

      jQuery(window).on('scroll', function() {
        const sectionTop = section.offset().top;
        const viewportTop = jQuery(window).scrollTop();

        if (viewportTop < sectionTop + section.outerHeight() && viewportTop > sectionTop) {
          isSectionInView = true;
        } else {
          isSectionInView = false;
        }

        if (isSectionInView) {
          shapes.each(function(index, shape) {
            const parallaxOffset = (viewportTop - sectionTop) * parallaxMultipliers[index];
            shapeOffsets[index] = parallaxOffset;
            jQuery(shape).css('transform', `translateY(${parallaxOffset}px)`);
          });
        } else {
          shapes.each(function(index, shape) {
            jQuery(shape).css('transform', `translateY(${shapeOffsets[index]}px)`);
          });
        }
      });

}
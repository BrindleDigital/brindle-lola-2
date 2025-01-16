/*Topbar*/
jQuery(document).ready(function() { 
    // Close the popup and overlay when the close button is clicked
    jQuery('.btn-close').click(function() {
      //alert('closeme');              
      jQuery('.top-bar').slideUp();
    });


    jQuery("li:has(ul)").click(function(event){

      event.preventDefault();
      //console.log('clickme');
      jQuery(this).children("ul").slideToggle('fast');
      jQuery(this).find('span').toggleClass('open');


    });


    jQuery("li:has(ul) span").click(function(event){
        event.preventDefault();
        //console.log('clickme_ic');
        jQuery(this).parent().parent().children("ul").slideToggle('fast');
        jQuery(this).parent().find('span').toggleClass('open');
    });

    jQuery("li:has(ul) ul li a").click(function(event){
        //console.log('clickme_li');
         window.location.href=jQuery(this).attr('href');
    });

    jQuery(".smooth-scroll a").click(function(event){
        event.preventDefault();
        console.log('sm');
        var hrf = jQuery(this).attr('href');
        
        jQuery('html, body').animate({
            scrollTop: jQuery(hrf).offset().top
        }, 2000);
    });




    

});



/*window.addEventListener('scroll', throttle(parallax, 14));

function throttle(fn, wait) {
  var time = Date.now();
  return function() {
    if ((time + wait - Date.now()) < 0) {
      fn();
      time = Date.now();
    }
  }
};

function parallax() {
  var scrolled = window.pageYOffset;
  var parallax = document.querySelector(".parallax");
  // You can adjust the 0.4 to change the speed
    var coords = (scrolled * 0.4) + 'px'
  parallax.style.transform = 'translateY(' + coords + ')';
};*/

//Parallax-Custom
const section = jQuery('.section-parallax');
const shapes = jQuery('.shape-1, .shape-2, .shape-3, .shape-4');
const parallaxMultipliers = [0.05, -0.1, 0.15, 0.0001];

/*let isSectionInView = false;

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
      jQuery(shape).css('transform', `translateY(${parallaxOffset}px)`);
    });
  } else {
    shapes.each(function(index, shape) {
      jQuery(shape).css('transform', `translateY(0)`);
    });
  }
});*/

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


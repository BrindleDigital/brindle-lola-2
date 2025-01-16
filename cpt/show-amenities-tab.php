<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

<div class="amenities-tab-desktop">
  <div class="amenities-tab">
    <div class="tab-content">
          <?php if( have_rows('list', 'option') ): ?>
              <?php $t=1;while( have_rows('list', 'option') ) : the_row(); ?>
                  <div class="tab-pane <?php if($t==1){?> active <?php }?>" id="tab-<?php echo $t;?>">
                  <figure><img src="<?php the_sub_field('photo'); ?>" alt="<?php the_sub_field('title'); ?>"></figure>
                  </div>
              <?php $t++; endwhile; ?>
          <?php endif; ?>
      


      


    </div>
    <div class="tab-nav-wrapper">
      <ul class="nav-tab">
          <?php if( have_rows('list', 'option') ): ?>
              <?php $t=1;while( have_rows('list', 'option') ) : the_row(); ?>
                  <li><a href="#tab-<?php echo $t;?>" id="id_<?php echo $t;?>" <?php if($t==1){?> class="active" <?php }?>><?php the_sub_field('title'); ?></a></li>
              <?php $t++; endwhile; ?>
          <?php endif; ?>
      </ul>
      
              <?php
              $button = get_field('button', 'option');            
              ?>  
              <?php  if (isset($button['title'])){ ?>    
                <div class="wp-block-button">
                  <a <?php if (isset($button['target'])){ if ($button['target']){ echo 'target="_blank"'; }}?>  <?php  if (isset($button['url'])){ if($button['url']){?>  href="<?echo $button['url'];?>" <?php }}?>  class="wp-block-button__link wp-element-button"><?php  if (isset($button['title'])){ if($button['title']){?><?php echo $button['title'];?><?php }}?>
                    
                  </a>
                </div>
              <?php }?>
          
    


    </div>
  </div>  
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const tabs = document.querySelectorAll('.nav-tab a');
  const panes = document.querySelectorAll('.tab-pane');

  tabs.forEach((tab) => {
    tab.addEventListener('click', (e) => {
      e.preventDefault();

      // Remove active class from all tabs and panes
      tabs.forEach((tab) => tab.classList.remove('active'));
      panes.forEach((pane) => pane.classList.remove('active'));

      // Add active class to the clicked tab and corresponding pane      
      tab.classList.add('active');
      curTabIndex = tab.getAttribute('href');
      const array = curTabIndex.split('-');
      var lastEl = array[array.length-1];
      console.log(lastEl);
      var justAboveTab = lastEl - 1;
      
      jQuery(".amenities-tab ul.nav-tab li a").css("border-bottom", "3px solid var(--base-3)");


      if(justAboveTab>0){
        jQuery("#id_"+justAboveTab).css("border-bottom", "none");
      }

      const targetPane = document.querySelector(tab.getAttribute('href'));

      targetPane.classList.add('active');
    });
  });
});
</script>

<div class="amenities-tab-mobile">
  <div class="slider">

    <?php if( have_rows('list', 'option') ): ?>
        <?php $t=1;while( have_rows('list', 'option') ) : the_row(); ?>
    <div class="slider-item">
      <figure>
        <img src="<?php the_sub_field('photo'); ?>" alt="<?php the_sub_field('title'); ?>">
      <figcaption>
        <span class="slider-thumb">
          <img src="<?php the_sub_field('photo'); ?>" alt="<?php the_sub_field('title'); ?>">
        </span>
        <h4><?php the_sub_field('title'); ?></h4></figcaption>
      </figure>
    </div>
        <?php $t++; endwhile; ?>
    <?php endif; ?>

    

    

  </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<script>
  jQuery('.amenities-tab-mobile .slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    speed: 600,
    arrows: true,
    prevArrow:"<button type='button' class='slick-arrow slick-prev'><i class='fa-solid fa-angle-left'></i></button>",
    nextArrow:"<button type='button' class='slick-arrow slick-next'><i class='fa-solid fa-angle-right'></i></button>",
  });
</script>


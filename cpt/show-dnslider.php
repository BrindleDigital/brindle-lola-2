<?php
    $perPage =3;
?>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/brindle-lola-2/cpt/dnslider.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">



<section class="regular-content section--interactive-slider " id="interactive-slider">
  <div class="regular-content__wrap regular-content--white">
    <div class="regular-content__main">
            <div class="container">
                <div class="row">




                    <?php
                    $default_photo = '/wp-content/uploads/2023/12/clu00071_hdr_1_-4.webp';                    
                    ?>
                    <!-- Tab Start-->

                    <div class="wrapper">  
                      <div class="tab">    
                        <div class="dn-slider-button day-btn active">By Day</div>
                        <div class="dn-slider-button night-btn ">By Night</div>    
                      </div>  
                      <div class="tabContentWrap">    
                        <div class="tabContent show">
                              <!-- slider start -->
                              <div class="col col-12 col-lg-12 col--slider">
                                  <div class="col__wrap">
                                      <div class="day-night-slider">
                                          <?php                                              
                                          wp_reset_query();
                                          $perPage = $perPage;                                        
                                          $args = array(
                                                'post_type' => 'local_attraction', 
                                                'post_status' => 'publish',
                                                'meta_query'    => array(
                                                    'relation'      => 'AND',
                                                    array(
                                                        'key'       => 'opening_time',
                                                        'value'     => array('all', 'day'),
                                                        'compare'   => 'IN',
                                                    ),
                                                    array(
                                                        'key'       => 'display_in_day_night_slider',
                                                        'value'     => 'yes',
                                                        'compare'   => 'LIKE',
                                                    )
                                                ),
                                                'posts_per_page' => -1
                                          ); 



                                            $loop = query_posts($args);
                                            if(have_posts()){
                                                while (have_posts()) : the_post();   
                                                  $post_id      = get_the_ID();  
                                                  

                                                  $post_image   = wp_get_attachment_url( get_post_thumbnail_id($post_id) );  
                                                  if($post_image ==''){
                                                    $post_image = $default_photo;
                                                  } 


                                                  ?>
                                                <div class="image-slider--slide">
                                                    <div class="image-slider--slide-wrap">
                                                        <img src="<?php echo $post_image;?>" alt="<?php echo get_the_title();?>">
                                                    </div>
                                                    <div class="image-slider--content-wrap">
                                                      <span><?php echo get_field('distance_to_walk');?></span>
                                                      <h6><?php echo get_the_title();?></h6>
                                                      <?php the_content();?>
                                                    </div>
                                                </div>                                              
                                            <?php endwhile; } wp_reset_query(); ?>
                                      </div>
                                  </div>
                              </div>
                              <!-- slider end -->
                        </div>
                        
                        <div class="tabContent ">      
                              <!-- slider start -->
                              <div class="col col-12 col-lg-12 col--slider">
                                  <div class="col__wrap">
                                      <div class="day-night-slider">
                                          <?php                                              
                                          wp_reset_query();
                                          $perPage = $perPage;                                        
                                          $args = array(
                                                'post_type' => 'local_attraction', 
                                                'post_status' => 'publish',
                                                'meta_query'    => array(
                                                    'relation'      => 'AND',
                                                    array(
                                                        'key'       => 'opening_time',
                                                        'value'     => array('all', 'night'),
                                                        'compare'   => 'IN',
                                                    ),
                                                    array(
                                                        'key'       => 'display_in_day_night_slider',
                                                        'value'     => 'yes',
                                                        'compare'   => 'LIKE',
                                                    )
                                                ),
                                                'posts_per_page' => -1
                                          ); 

                                            $loop = query_posts($args);
                                            if(have_posts()){
                                                while (have_posts()) : the_post();

                                                  $post_id      = get_the_ID();  
                                                  

                                                  $post_image   = wp_get_attachment_url( get_post_thumbnail_id($post_id) );  
                                                  if($post_image ==''){
                                                    $post_image = $default_photo;
                                                  }                                                
                                                  ?>
                                                <div class="image-slider--slide">
                                                    <div class="image-slider--slide-wrap">
                                                        <img src="<?php echo $post_image;?>" alt="<?php echo get_the_title();?>">
                                                    </div>
                                                    <div class="image-slider--content-wrap">
                                                      <p class="font-change"><?php echo get_field('distance_to_walk');?></p>
                                                      <h6><?php echo get_the_title();?></h6>
                                                      <?php the_content();?>
                                                    </div>
                                                </div>                                              
                                            <?php endwhile; } wp_reset_query(); ?>
                                      </div>
                                  </div>
                              </div>
                              <!-- slider end -->
                        </div>    
                        
                        
                      </div>  
                    </div>
                    <!-- Tab End-->


                </div>
            </div>
        </div>
  </div>
</section>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script type="text/javascript" src="/wp-content/themes/brindle-lola-2/cpt/dnslider.js"></script>
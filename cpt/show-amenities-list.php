<?php if( have_rows('features', 'option') ): ?>
<?php $t=1;while( have_rows('features', 'option') ) : the_row(); ?>
      <div class="amenties-block" id="<?php the_sub_field('link_id'); ?>">
        <div class="block-head">
          <h2><?php the_sub_field('heading'); ?></h2>
        </div>
        <div class="amenities-list">
        <?php 
        // check for rows (sub repeater)
        if( have_rows('items') ): ?>
          <ul>
            <?php 
            // loop through rows (sub repeater)
            while( have_rows('items') ): the_row();
            // display each item as a list - with a class of completed ( if completed )
            ?>
            <li><?php the_sub_field('title'); ?>
                 <?php if( get_sub_field('photo')) {?>
                   <span class="trigger-img"><a data-fslightbox="gallery" href="<?php the_sub_field('photo');?>" ><img src="/wp-content/uploads/2023/12/icon-camera.svg" alt=""></a></span>
                 <?php }?>             
            </li> 
            <?php endwhile; ?>
          </ul>
          <?php endif; //if( get_sub_field('items') ): ?>
        </div>
      </div>
<?php $t++; endwhile; ?>
<?php endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.min.js" integrity="sha512-03Ucfdj4I8Afv+9P/c9zkF4sBBGlf68zzr/MV+ClrqVCBXWAsTEjIoGCMqxhUxv1DGivK7Bm1IQd8iC4v7X2bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
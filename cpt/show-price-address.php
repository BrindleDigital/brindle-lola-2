<?php
//get your custom posts ids as an array
$posts = get_posts(array(
    'post_type'   => 'floorplans',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'fields' => 'ids'
    )
);
//loop over each post
$minimum_rent_array = array();
$maximum_rent_array = array();
foreach($posts as $p){
    $minimum_rent = get_post_meta($p,"minimum_rent",true);    
    if($minimum_rent > 0){
    	$minimum_rent_array[] = $minimum_rent;
	}  
	$maximum_rent = get_post_meta($p,"maximum_rent",true); 
	if($maximum_rent > 0){
    	$maximum_rent_array[] = $maximum_rent;
	}  
}

$minimum_rent_array_new = ($minimum_rent_array);
sort($minimum_rent_array_new);
$show_minimum_rent = 0;
if(count($minimum_rent_array_new)){
	$show_minimum_rent = number_format($minimum_rent_array_new[0]);	
}
//print_r($minimum_rent_array_new);

$maximum_rent_array_new = ($maximum_rent_array);
rsort($maximum_rent_array_new);
$show_maximum_rent = 0;
if(count($maximum_rent_array_new)){
	$show_maximum_rent = number_format($maximum_rent_array_new[0]);	
}
//print_r($maximum_rent_array_new);
?>
<ul class="info-apartment">
<li class="location-info"><?php the_field('address','option'); ?></li>
<li class="price-info"><?php the_field('price_label','option'); ?> <strong>$<?php echo $show_minimum_rent;?> - $<?php echo $show_maximum_rent;?></strong></li>
</ul>
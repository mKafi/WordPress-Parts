<?php 
	$items = !empty(get_option('front_page_elements')) ? esc_attr(get_option('front_page_elements')) : 10;
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;	
	$args = array(
		'post_type' => 'package', 'paged' => $paged , 'posts_per_page' => $items
	);
	$post_data = new WP_Query($args);
	$counter = 1;
	if($post_data->have_posts()){
		?>
		<div class="container">
			<div class="row">
				<?php 
				while($post_data->have_posts()){
					if($counter%3 == 0){
						?><div class="prod-grid row"><?php 
					}
					$post_data->the_post();
					$post_id = get_the_ID();
					$post_title = get_the_title();
					$post_excerpt = get_the_excerpt();
					$thumbnail = get_the_post_thumbnail_url();
					?>
					<div class="col-md-4 col-sm-6 col-xs-12 package-cont">
						<img src="<?php echo $thumbnail; ?>" alt="post-thumb"/>
						<a class="package-title" href="<?php echo get_permalink($post_id); ?>"><?php echo $post_title; ?></a>
						<p class="prod-excerpt"><?php echo $post_excerpt; ?></p>
						<a href="<?php echo get_permalink($post_id); ?>" class="package-learn-more"> Learn More >> </a>
					</div>
					<?php 
					if($counter%3 == 0){
						?></div><?php 
					}
					$counter++;
				}
				?>
			</div>
		</div>
		<?php 
	}
	else{
		?> <h3>Not found.</h3> <?php 
	}		
	if($post_data->max_num_pages > 1){ ?>
		<p class="navrechts">
			<?php
			for($i=1;$i<=$post_data->max_num_pages;$i++){?>
				<a href="<?php echo '?page='.$i; ?>" <?php echo ($paged==$i)? 'class="selected"':''; ?>><?php echo $i; ?></a>
				<?php
			}			
			?>
		</p>
		<?php 
	}
	wp_reset_postdata(); 
	?>
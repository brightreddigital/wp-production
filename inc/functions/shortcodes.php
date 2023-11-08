<?php

/* ------- Check ACF -------- */ 
add_action( 'acf/init', 'checkACFsc' );

function checkACFsc() {

	// Social shortcode
	function social() {
		
		ob_start();

		if( have_rows('platforms' , 'option') ):
			echo '<ul class="social-icons">';
			while( have_rows('platforms' , 'option') ) : the_row();
				echo '<li>'; ?>
					
					<a href="<?php the_sub_field('link'); ?>"></a>
					
					<object data="<?php the_sub_field('icon'); ?>" type="image/svg+xml" ></object>
					
				<?php echo '</li>';
			endwhile;
			echo '</ul>';
		endif;

		$content = ob_get_clean();
	    return $content;

	}

	add_shortcode('social', 'social');

	// Phone shortcode
	function phone() {
		
		ob_start(); ?>

			<a class="icon-text-inline" href="tel:<?php the_field('phone','option'); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z"/>
				</svg>
				<?php the_field('phone','option'); ?>
			</a>

		<?php $content = ob_get_clean();
	    return $content;

	}

	add_shortcode('phone', 'phone');

	// Email shortcode
	function email() {
		
		ob_start(); ?>

			<a class="icon-text-inline" href="mailto:<?php the_field('email_address','option'); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path d="M207.8 20.73c-93.45 18.32-168.7 93.66-187 187.1c-27.64 140.9 68.65 266.2 199.1 285.1c19.01 2.888 36.17-12.26 36.17-31.49l.0001-.6631c0-15.74-11.44-28.88-26.84-31.24c-84.35-12.98-149.2-86.13-149.2-174.2c0-102.9 88.61-185.5 193.4-175.4c91.54 8.869 158.6 91.25 158.6 183.2l0 16.16c0 22.09-17.94 40.05-40 40.05s-40.01-17.96-40.01-40.05v-120.1c0-8.847-7.161-16.02-16.01-16.02l-31.98 .0036c-7.299 0-13.2 4.992-15.12 11.68c-24.85-12.15-54.24-16.38-86.06-5.106c-38.75 13.73-68.12 48.91-73.72 89.64c-9.483 69.01 43.81 128 110.9 128c26.44 0 50.43-9.544 69.59-24.88c24 31.3 65.23 48.69 109.4 37.49C465.2 369.3 496 324.1 495.1 277.2V256.3C495.1 107.1 361.2-9.332 207.8 20.73zM239.1 304.3c-26.47 0-48-21.56-48-48.05s21.53-48.05 48-48.05s48 21.56 48 48.05S266.5 304.3 239.1 304.3z"/>
				</svg>
				<?php the_field('email_address','option'); ?>
			</a>

		<?php $content = ob_get_clean();
	    return $content;

	}

	add_shortcode('email', 'email');

	// Sitewide offers shortcode
	function sitewideoffers() {
		
		ob_start();

		if( have_rows('sitewideoffers' , 'option') ):
			echo '<ul class="sitewideoffers-icons">';
			while( have_rows('sitewideoffers' , 'option') ) : the_row();
				echo '<li>'; ?>
					
					<object data="<?php the_sub_field('icon'); ?>" type="image/svg+xml" ></object>
					<span><?php the_sub_field('label'); ?></span>
					
				<?php echo '</li>';
			endwhile;
			echo '</ul>';
		endif;

		$content = ob_get_clean();
	    return $content;

	}

	add_shortcode('sitewideoffers', 'sitewideoffers');

	// Conditional cards
	// Add ACF field name to acf_field and post type and number of pages in shortcode eg [cond_cards acf_field="event_date" post_type="events" posts_per_page="3"]

	function cond_cards($attributes) {

		$args = shortcode_atts(array(
			'acf_field' => '',
			'post_type' => '',
    		'posts_per_page' => ''

	    ), $attributes);

		$acfStr = $args['acf_field'];
		$acfGet = the_field($acfStr);

		$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) :

					while ( $the_query->have_posts() ) : $the_query->the_post();

							if (get_field($acfStr)) :
    				
    						 	the_title(); 

    						endif; 

				endwhile;

				wp_reset_postdata();

		endif;

	};

	add_shortcode('cond_cards', 'cond_cards');

	// Repeater list

	// Add class name to shortcode for custom CSS (found in theme CSS) eg [repeater_list class="previous-performances"]

	function repeater_list($attributes) {

		$args = shortcode_atts(array(
			'class' => '',
	    ), $attributes);

 
		if( have_rows('repeater_list') ): ?>

			<ul class="repeater-list <?php $args['class']; ?>">
	 
	    		<?php while( have_rows('repeater_list') ) : the_row();
	 
	        	$itemOne = get_sub_field('repeater_list_item_one');
	        	$itemTwo = get_sub_field('repeater_list_item_two');
	        	$itemThree = get_sub_field('repeater_list_item_three'); ?>

	        	<li>
	        		<span class="repeater-item-one"><?php if($itemOne): echo $itemOne; endif; ?></span>
	        		<span class="repeater-item-two"><?php if($itemTwo): echo $itemTwo; endif; ?></span>
	        		<span class="repeater-item-three"><?php if($itemThree): echo $itemThree; endif; ?></span>
	        	</li>
	    
	    		<?php endwhile; ?>

	    	</ul>	
	 
		<?php endif;

	};

	add_shortcode('repeater_list', 'repeater_list');


/* Check ACF END */ 
};




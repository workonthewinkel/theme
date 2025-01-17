<?php

$terms = get_field( 'faq_taxonomy' ); 
$header_text = get_field( 'faq_header_text' ); 
if( !is_array( $terms ) ){
	return;
}

// Get term ids:
$term_ids = [];
foreach( $terms as $term ){
	$term_ids[] = $term->term_id;
}

// Run query
$query = new WP_Query([
    'post_type' => 'faq',
    'tax_query' => [[
		'taxonomy' => 'faq-category',
		'field' => 'term_id',           // term_id, slug or name
		'terms' => $term_ids,  
	]],
]);

// Output the block:
echo '<h3>' . $header_text .'</h3>';

while ( $query->have_posts() ) :
    $query->the_post();

	echo '<details class="faq-item">';
	
		echo '<summary class="faq--question">' .  get_the_title() . '</summary>';
    	echo '<span class="faq--answer">';
			the_field( 'faq_answer' );
		echo '</span>';

	echo '</details>';
endwhile;

/* Restore original Post Data 
 * NB: Because we are using new WP_Query we aren't stomping on the 
 * original $wp_query and it does not need to be reset.
*/
wp_reset_postdata();?>

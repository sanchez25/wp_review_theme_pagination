<?php
	$paged = max( 1, (int) get_query_var('paged'), (int) get_query_var('page') );

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => '15',
        'orderby' => 'date',
        'order' => 'DESC',
		'paged' => $paged 
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :
        echo '<div class="news">';
        while($query->have_posts()) : $query->the_post();
    ?>
        <a href="<?php echo get_permalink(); ?>" class="news__item"> 
            <div class="news__item-text">
                <span class="news__item-title">
                    <?php echo get_the_title(); ?>
                </span>
                <?php 
                    $content = apply_filters('the_content', get_the_content());
                    preg_match('/<p>(.*?)<\/p>/is', $content, $matches);
                    $first_paragraph = isset($matches[1]) ? wp_strip_all_tags($matches[1]) : '';
                    $excerpt = mb_strimwidth($first_paragraph, 0, 100, '...');
                    echo '<p>' . esc_html($excerpt) . '</p>';
                ?>
                <div class="public__date">
                    <div class="public__date-icon"></div>
                    <span class="public__date-text"><?php echo get_the_date(); ?></span>
                </div>
            </div>
    </a>
        <?php
            endwhile;
        ?>
    </div>
	<?php
		$big = 999999999;
		echo '<div class="pagination">';
			echo paginate_links( array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => max( 1, $paged ),
				'total'     => $query->max_num_pages,
				'prev_text' => '&laquo;',
				'next_text' => '&raquo;',
			) );
		echo '</div>';
	?>
    <?php endif; ?>
    <?php wp_reset_postdata();?>
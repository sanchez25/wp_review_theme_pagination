<?php get_header(); ?>

<div id="content-block" class="content-block" itemid="/<?php echo get_page_uri(); ?>" itemscope itemtype="https://schema.org/Article">
    <meta itemprop="author" content="<?php the_author(); ?>">   
	<meta itemprop="datePublished" content="<?php echo get_the_date('Y-n-j'); ?>">
	<meta itemprop="dateModified" content="<?php echo get_the_modified_date('Y-n-j'); ?>">
	<meta itemprop="image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2024/02/logo.webp">
	<div class="text-first wrapper">
        <h1 itemprop="headline">قائمة أفضل شركات المراهنات والكازينوهات في الوقت الحالي</h1>
    </div>
    <div class="cards">
        <?php get_template_part('templates/posts'); ?>
    </div> 
    <div class="content_page wrapper" itemprop="articleBody">
		<?php 
			if ( have_posts() ) : 
				if ( is_category() ) {
				echo category_description( $category );
			}
			endif;
		?>
    </div>
	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
		<meta itemprop="name" content="<?php echo get_bloginfo(); ?>">
		<meta itemprop="description" content="<?php echo get_bloginfo(); ?>">
		<div itemprop="logo" itemscope="" itemtype="https://www.schema.org/ImageObject">
			<link itemprop="url" href="<?php echo get_home_url(); ?>/wp-content/uploads/2024/02/logo.webp">
			<link itemprop="contentUrl" href="<?php echo get_home_url(); ?>/wp-content/uploads/2024/02/logo.webp">
		</div>
	</div>
</div>

<?php get_footer(); ?>
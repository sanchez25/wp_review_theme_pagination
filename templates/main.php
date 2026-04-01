<?php
    /* Template name: Main */
?>

<?php get_header(); ?>

<div id="content-block" class="content-block" itemid="/" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="author" content="<?php the_author(); ?>">
	<meta itemprop="datePublished" content="<?php echo get_the_date('Y-n-j'); ?>">
	<meta itemprop="dateModified" content="<?php echo get_the_modified_date('Y-n-j'); ?>">
	<meta itemprop="image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2025/09/logo.webp">
	<div class="content_page wrapper" itemprop="articleBody">
		<h1 itemprop="headline"><?php the_title(); ?></h1>
		<?php get_template_part('templates/posts'); ?>
		<?php the_content(); ?>
	</div>
	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
		<meta itemprop="name" content="<?php echo get_bloginfo(); ?>">
		<meta itemprop="description" content="<?php echo get_bloginfo(); ?>">
		<div itemprop="logo" itemscope="" itemtype="https://www.schema.org/ImageObject">
			<link itemprop="url" href="<?php echo get_home_url(); ?>/wp-content/uploads/2025/09/logo.webp">
			<link itemprop="contentUrl" href="<?php echo get_home_url(); ?>/wp-content/uploads/2025/09/logo.webp">
		</div>
	</div>
</div>

<?php get_footer(); ?>
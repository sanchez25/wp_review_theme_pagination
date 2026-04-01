<?php get_header(); ?>

<div class="content-block" itemid="/<?php echo get_page_uri(); ?>" itemscope itemtype="https://schema.org/Article">
    <div class="single wrapper">
        <div class="single__content">
			<meta itemprop="author" content="<?php the_author(); ?>">
			<meta itemprop="datePublished" content="<?php echo get_the_date('Y-n-j'); ?>">
			<meta itemprop="dateModified" content="<?php echo get_the_modified_date('Y-n-j'); ?>">
			<meta itemprop="image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2025/09/logo.webp">
			<nav aria-label="breadcrumbs" class="breadcrumbs">
				<a href="/">رئيسي</a>
				<span class="separator"> » </span>
				<span class="last"><?php the_title(); ?></span>
			</nav>
            <div class="content_page" itemprop="articleBody">
				<h1 itemprop="headline"><?php the_title(); ?></h1>
                <div class="text-content">
                    <?php the_content();?>
                </div>
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
    </div>
</div>

<?php get_footer(); ?>
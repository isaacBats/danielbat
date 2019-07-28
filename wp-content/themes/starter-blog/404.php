<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Starter Blog
 */
get_header();?>

	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div id="primary" class="content-area col-md-12">
				<main id="main" class="site-main" role="main">
					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can not be found.', 'starter-blog' ); ?></h1>
						</header><!-- .page-header -->
						<div class="page-content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'starter-blog' ); ?></p>
							<div class="error-404-searchbox clearfix"><?php get_search_form(); ?></div>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</main><!-- #main -->
			</div><!-- #primary -->
			<div class="col-md-2"></div>
		</div>
	</div>

<?php get_footer(); ?>

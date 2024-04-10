<?php
global $wp_query;
get_header();
?>
	<main>
		<section class="products">
			<h2><?php _e('Search results', 'esimerkki'); ?></h2>
			<?php
			generate_article( $wp_query );
			?>
		</section>
	</main>
<?php
get_footer();
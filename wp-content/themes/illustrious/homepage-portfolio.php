<?php $query = new WP_Query('post_type=cpo_portfolio&order=ASC&orderby=menu_order&meta_key=portfolio_featured&meta_value=1&posts_per_page=-1'); ?>
<?php if($query->posts): ?>
<div id="portfolio" class="portfolio">
	<div class="container">
		<?php cpotheme_block('home_portfolio', 'portfolio-heading fancy-heading heading', 'fancy-heading-content'); ?>
		<?php cpotheme_grid($query->posts, 'element', 'portfolio', 3, array('class' => 'column-narrow')); ?>
	</div>
</div>
<?php endif; ?>
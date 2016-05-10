<?php $query = new WP_Query('post_type=cpo_feature&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>
<?php if($query->posts): $feature_count = 0; ?>
<div id="features" class="features">
	<div class="container">		
		<?php cpotheme_block('home_features', 'features-heading fancy-heading heading', 'fancy-heading-content'); ?>
		<?php cpotheme_grid($query->posts, 'element', 'feature', 3, array('class' => 'column-narrow')); ?>
	</div>
</div>
<?php endif; ?>
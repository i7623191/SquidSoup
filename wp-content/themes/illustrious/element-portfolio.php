<div class="portfolio-item">
	<div class="portfolio-item-image">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('portfolio', array('title' => '')); ?>
		</a>
	</div>
	<div class="portfolio-item-body">
		<h3 class="portfolio-item-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<?php if(has_excerpt()): ?>
		<div class="portfolio-item-description">
			<?php the_excerpt(); ?>
		</div>
		<?php endif; ?>
		<?php cpotheme_edit(); ?>
	</div>
</div>
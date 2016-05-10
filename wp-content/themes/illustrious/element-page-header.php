<?php wp_reset_query(); ?>

<?php if(cpotheme_show_title()): ?>

<?php $image_url = cpotheme_header_image(); ?>
<?php $pagetitle_class = ''; ?>
<?php if($image_url != false){ $image_url = ' style="background-image:url('.esc_url($image_url).');"'; $pagetitle_class = 'pagetitle-background dark'; } ?>
<?php do_action('cpotheme_before_title'); ?>
<section id="pagetitle" class="pagetitle">
	<div class="container">
		<div class="pagetitle-body <?php echo $pagetitle_class; ?>" <?php echo $image_url; ?>>
			<?php do_action('cpotheme_title'); ?>
		</div>
	</div>
</section>
<?php do_action('cpotheme_after_title'); ?>

<?php endif; ?>
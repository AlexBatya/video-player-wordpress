<?php get_header(); ?>
<section class="footer-menu">
    <div>
		<div class="cat-title">Результаты поиска : <?php echo $_GET['s']; ?></div>
	</div>
</section>
<section class="video video-category">
<?php while (have_posts()) { the_post(); ?>
    <!-- item --><?php $durationlink_value = get_post_meta($post->ID, 'durationlink', true); ?>
    <div class="video-item">
        <div class="video-item-img">
			<a href="<?php the_permalink(); ?>">
				<video poster = '<?php the_post_thumbnail_url(); ?>' onended="this.currentTime=0; this.play()" muted onmouseover="this.play()" onmouseout="this.pause();this.currentTime=0;" id = 'video' src="<?php CFS()->get('dopvid4') ?>"  ></video>
				<?php if($durationlink_value != '') {
  					echo ' <div class="drn1">', $durationlink_value, '</div>'; }
				?>
			</a>
        </div>
        <div class="video-desc">
            <a href="<?php the_permalink(); ?>" class="video-item-title"><?php the_title(); ?></a>
        </div>
    </div>
    <!-- item -->
<?php } ?>
</section>
<div class="pagenav"><?php wp_pagenavi(); ?></div>
<?php get_footer(); ?>
<?php //get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <div class="page-header">
      <h1 class="section-title"><?php _e('Sorry, no results were found.', 'roots'); ?></h1>
      <hr class="title-divider">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8 col-sm-offset-4"><?php get_search_form(); ?></div>
  </div>
<?php endif; ?>

<?php if (have_posts()) : ?>
<?php $search_term = trim(esc_html($s));?>
  <div class="page-header">
    <h1 class="section-title"><?php _e('Search results', 'roots'); ?></h1>
    <h2 class="search-term"><?php _e($search_term, 'roots'); ?></h2>
  </div>

<?php endif ?>

<?php if (have_posts()) : ?>
  <div class="row">
    <div class="col-sm-10 col-sm-offset-3">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content', 'search'); ?>
      <?php endwhile; ?>
    </div>
  </div>
<?php endif ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>

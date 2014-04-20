<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-feature-img">
      <?php 
        if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
          the_post_thumbnail();
          if (get_post(get_post_thumbnail_id())->post_excerpt){
            echo "<small>";
            echo get_post(get_post_thumbnail_id())->post_excerpt;
            echo "</small>";
          }
        } 
      ?>
    </div>
    <div class="entry-content">
      <?php the_content(); ?>
      <p class="tags"> <?php the_tags('<strong>Tags:</strong> ', ', ', ''); ?> </p>
    </div>
    <footer>
      <ul class="links">
        <li><a href="#comments">Comment</a></li>
        <li class="separator">&middot;</li>
        <li>
          <!-- AddToAny BEGIN -->
          <div class="a2a_kit a2a_default_style">
          <a class="a2a_dd" href="http://www.addtoany.com/share_save">Share</a>
          </div>
          <script type="text/javascript">
            a2a_config = {
              onclick: 1
            };
          </script>
          <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
          <!-- AddToAny END -->        
        </li>
      </ul>      
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>

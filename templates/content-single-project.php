<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-sub-title">Project Profile</h2>
    <h1 class="entry-title"><?php the_title(); ?></h1>
  </header>
  <div class="row">
    <div class="col-md-7">
      <div class="entry-content">
        <h3 class="sub-title">Project Profile</h3>
        <?php remove_filter ('the_content', 'wpautop'); ?>
        <h2><?php the_content(); ?></h2>
        <div class="sub-content">
          <?php the_field('sub_copy');?>
        </div>
      </div>
      <div class="row project-details">
        <div class="col-md-5">
          <div class="detail-column">
            <?php if (get_field('project_pdf')) : ?>
              <div class="detail-block pdf">
                <div class="detail-content">
                    <p>Download this Project Profile as PDF</p>
                    <a class="btn download" href="<?php the_field('project_pdf');?>">Download</a>
                </div>
              </div>
            <?php endif ?>
            <?php if (get_field('estimator')) : ?>
              <?php $term_id = get_field('estimator'); $estimator = get_term( $term_id[0], 'estimator' ); ?>
              <div class="detail-block estimator">
                <div class="detail-content">
                  <p>Speak with <strong><?php echo $estimator->name; ?></strong> about our solutions for you project</p>
                  <a class="btn speak" data-toggle="popover" data-placement="top" data-content="<div class='estimator-popover'><div class='phone'><span><?php the_field('estimator_phone','estimator_'.$estimator->term_id.'');?></span></div><div class='email'><span><?php the_field('estimator_email','estimator_'.$estimator->term_id.'');?></span></div></div>" href="#">Speak with <?php echo strtok($estimator->name, " ");?></a>
                </div>
              </div>
            <?php endif; ?>   
          </div>     
        </div>
        <div class="col-md-7">
          <div class="detail-column">
            <h3 class="sub-title">Solutions Highlights</h3>
            <?php if(get_field('solution_highlights')): ?>
              <ul class="project-highlights">
                <?php while(has_sub_field('solution_highlights')): ?>
                  <li><strong><?php the_sub_field('solution');?>:</strong> <?php the_sub_field('solution_description');?></li>
                <?php endwhile; ?>
              </ul>
            <?php endif; ?>  
          </div>        
        </div>
      </div>
    </div>
    <div class="col-md-4 col-md-push-1">
      <div class="project-sidebar">
        <h3 class="sub-title">At-A-Glance</h3>
        <ul class="meta-details">
          <li>
            <span class="title">Location</span>
            <span class="detail"><?php the_field('location_city');?>, <?php the_field('location_state');?></span>
          <li>
            <span class="title">Groundbreaking</span>
            <span class="detail"><?php $date = DateTime::createFromFormat('Ymd', get_field('groundbreaking_date')); echo $date->format('M Y');?></span>
          <li>
            <span class="title">Opening</span>
            <span class="detail"><?php $date = DateTime::createFromFormat('Ymd', get_field('opening_date')); echo $date->format('M Y');?></span>
          <li>
            <span class="title">Full Completion</span> 
            <span class="detail"><?php the_field('full_completion_date');?></span>
          <li>
            <span class="title">Owner</span>
            <span class="detail"><?php the_field('building_owner');?></span>
          <li>
            <span class="title">Architect</span>
            <span class="detail"><?php $term_id = get_field('architect'); $architect = get_term( $term_id[0], 'architect' ); echo $architect->name; ?></span>
          </li>
          <?php if (get_field('estimator')) : ?>
            <li>
              <span class="title">Snyder Estimator</span>
              <span class="detail estimator">
                  <?php $term_id = get_field('estimator'); $estimator = get_term( $term_id[0], 'estimator' ); echo $estimator->name; ?>
                  <a class="speak" data-toggle="popover" data-placement="top" data-content="<div class='estimator-popover'><div class='phone'><span><?php the_field('estimator_phone','estimator_'.$estimator->term_id.'');?></span></div><div class='email'><span><?php the_field('estimator_email','estimator_'.$estimator->term_id.'');?></span></div></div>" href="#">Speak with <?php echo strtok($estimator->name, " ");?></a>
              </span>
            </li>
          <?php endif ?>
        </ul>
        <div class="row">
          <div class="col-md-6">
            <div class="list-terms">
              <h3 class="sub-title">Services</h3>
              <ul>
              <?php 
                $terms = get_terms('service', array( 'parent' => 0 ));
                $termID = $terms[0]->term_id;
                $args = array('child_of' => $termID, 'parent' => $termID,'orderby' => 'term_order' );
                $termchildren = get_terms( 'service', $args);
                $term_list = "";

                $count = count($termchildren); $i=0;
                if ($count > 0) {
                  foreach ($termchildren as $term) {
                    $i++;
                    if ($term->parent !== 0){
                      $term_list .= '<li><a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';
                    }
                  }
                  echo $term_list;
                }
              ?>
              </ul>
            </div>
          </div>
          <div class="col-md-6">
            <div class="list-terms">
              <h3 class="sub-title">Industry</h3>
              <ul>
                <?php 
                  $taxonomy_name = 'industry';
                  $terms = get_terms( $taxonomy_name, array( 'parent' => 0 )); 
                  $top_term_id = $terms[0]->term_id;             
                  $term_list = "";

                  $count = count($terms); $i=0;
                  if ($count > 0) {
                    foreach ($terms as $term) {
                      $i++;
                      $term_list .= '<li><a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';
                    }
                    echo $term_list;
                  }
                ?>     
              </ul>
            </div>
            <div class="list-terms">
              <h3 class="sub-title">Building Type</h3>
              <ul>
                <?php 
                  $term_list = "";
                  $args = array('child_of' => $termID, 'parent' => $top_term_id,'orderby' => 'term_order' );
                  $termchildren = get_terms( $taxonomy_name, $args);

                  $count = count($termchildren); $i=0;
                  if ($count > 0) {
                    foreach ($termchildren as $term) {
                      $i++;
                      $term_list .= '<li><a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';
                    }
                    echo $term_list;
                  }
                ?>     
              </ul>
            </div>          
          </div>
        </div>
        <?php if(get_field('enable_testimonial')) : ?> 
          <div class="project-testimonial">
            <h3 class="sub-title">A Word from our Customer</h3>
            <blockquote>
              <p>&ldquo;<?php the_field('testimonial_quote');?>&rdquo</p>
              <footer>
                <span class="attribution"><?php the_field('testimonial_attribution');?></span>
                <span class="location"><?php the_field('testimonial_location');?></span>
              </footer>
            </blockquote>  
          </div>
        <?php endif; ?> 
      </div>  
    </div>
  </div>
  <footer>
    <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
  </footer>
  <?php comments_template('/templates/comments.php'); ?>
</article>
<?php endwhile; ?>

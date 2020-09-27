    <?php get_header();
    while(have_posts()) {
    the_post();
    ?>
      <h2 class="page-heading"><?php the_title();?></h2>
      <div id="post-container">
          <section id="blogpost">
              <div class="card">
                  <div class="card-meta-blogpost">
                  Posted by <?php the_author();?> on <?php the_time('F j, Y')?> 
                  <?php if(get_post_type() == 'post') { ?>
                  in <a href="#"><?php echo get_the_category_list(', ') ?></a>
                  <?php }?>
                  </div>
                  <div class="card-image">
                      <img src="<?php echo get_the_post_thumbnail_url(get_the_ID());?>" alt="Card Image">
                  </div>
                  <div class="card-description">
                    <?php the_content(); ?>
                  </div>
              </div>

              <div id="comments-section"><?php
              
              $fields = array(
                'author' => 
                    sprintf(
                        '<input placeholder="Name" id="author" name="author" type="text" value="%s" size="30" maxlength="245"%s />',
                        esc_attr( $commenter['comment_author'] ),
                        $html_req
                    ),

                'email'  => 
                    sprintf(
                        '<input placeholder="Email" id="email" name="email" %s value="%s" size="30" maxlength="100" aria-describedby="email-notes"%s />',
                        ( $html5 ? 'type="email"' : 'type="text"' ),
                        esc_attr( $commenter['comment_author_email'] ),
                        $html_req
                    )
            );

            $args = array(
                'title_reply' => "Share Your Thoughts",
                'fields' => $fields,
                'comment_field' => '<textarea placeholder= "Your Comment" id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>',
                'comment_notes_before' => sprintf(
                    '<p class="comment-notes">Your email address will not be published. All fields are required</p>'),
                );
              
              comment_form($args);
              $comments_number = get_comments_number();
              if($comments_number != 0) {
                  ?>

                <div class="comments">
                    <h3>What others say</h3>
                    <ol class="all-comments">
                        <?php
                        $comments = get_comments(array(
                            'post_id' => $post->ID,
                            'status' => 'approve'
                        ));
                        wp_list_comments(array(
                            'per_page' => 15
                        ), $comments);
                        ?>
                    </ol>
                </div>

                  <?php 
              }
              ?></div>
          </section>

          <?php } ?>

          <aside id="sidebar">
              <?php dynamic_sidebar('main_sidebar')?>
          </aside>
      </div>
    <?php get_footer() ?>
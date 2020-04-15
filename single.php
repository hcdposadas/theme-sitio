<?php get_header(); ?>
    <main role="main">
        <!-- Articulo Principal -->

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header>

				<?php if ( get_post_type() == 'concejal' ): ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="title-description">
									<?php the_title( '<h1>', '</h1>' ); ?>

                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php else: ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="title-description">
									<?php the_title( '<h1>', '</h1>' ); ?>

                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php endif ?>


            </header>

            <section class="content_format">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
							<?php while ( have_posts() ) :
								the_post();
								/*
								 * Include the post format-specific template for the content. If you want to
								 * use this in a child theme, then include a file called content-___.php
								 * (where ___ is the post format) and that will be used instead.
								 */
//                                get_template_part( 'content', get_post_format() );
								// Previous/next post navigation.
								the_content();

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							endwhile;

							if ( get_post_type() == 'concejal' ) :
								?>

                                <div class="row">
                                    <div class="col-md-6">
										<?php

										$fb = get_post_meta( get_the_ID(), 'facebook_concejal', true );
										if ( $fb ):
											?>
                                            <div class="fb-page"
                                                 data-href="<?php echo $fb; ?>"
                                                 data-tabs="timeline" data-height="340" data-small-header="false"
                                                 data-adapt-container-width="true" data-hide-cover="false"
                                                 data-show-facepile="true">
                                                <blockquote cite="<?php echo $fb; ?>"
                                                            class="fb-xfbml-parse-ignore"><a
                                                            href="<?php echo $fb; ?>">Facebook</a></blockquote>
                                            </div>
										<?php
										endif;

										?>

                                    </div>
                                    <div class="col-md-6">
										<?php

										$tw = get_post_meta( get_the_ID(), 'twitter_concejal', true );
										if ( $tw ):
											?>
                                            <a class="twitter-timeline"
                                               data-height="360"
                                               data-link-color="<?php echo get_theme_mod( 'primary_color' ); ?>"
                                               href="<?php echo $tw; ?>?ref_src=twsrc%5Etfw">Tweets</a>
                                            <script async src="https://platform.twitter.com/widgets.js"
                                                    charset="utf-8"></script>
										<?php
										endif;

										?>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <h5>Redes sociales</h5>

	                                    <?php $ig = get_post_meta( get_the_ID(), 'instagram_concejal', true ); ?>
	                                    <?php $yt = get_post_meta( get_the_ID(), 'youtube_concejal', true ); ?>


                                        <div>
                                            <ul class="list-inline">
                                                <li><a target="_blank" href="<?php echo $fb; ?>"><i
                                                                class="fa fa-facebook"></i></a></li>
                                                <li><a target="_blank" href="<?php echo $tw; ?>"><i
                                                                class="fa fa-twitter "></i></a></li>
                                                <li><a target="_blank" href="<?php echo $ig; ?>"><i
                                                                class="fa fa-instagram"></i></a></li>
                                                <li><a target="_blank" href="<?php echo $yt; ?>"><i
                                                                class="fa fa-youtube"></i></a></li>
                                            </ul>
                                        </div>

                                    </div>

                                </div>

							<?php
							endif;

							// check if the repeater field has rows of data
							if ( have_rows( 'archivos' ) ):

								// loop through the rows of data
								while ( have_rows( 'archivos' ) ) : the_row();

									// display a sub field value
									$file = get_sub_field( 'archivo' );

									$url     = $file['url'];
									$title   = $file['title'];
									$caption = $file['caption'];

									?>
                                    <li>
										<?php
										// $url = $file['url'];
										// $title = $file['title'];
										// $caption = $file['caption'];
										// $text = get_sub_field('list_item');
										// $url = get_sub_field('item_url');
										if ( $url ) {
											$text = '<a href="' . $url . '" target="_blank">' . $title . '</a>';
										}
										echo $text;
										?>
                                    </li>
								<?php

								endwhile;

							else :

								// no rows found

							endif;

							?>
                        </div>

                    </div>
                </div>
            </section>
        </article>

        <!-- Noticias Relacionadas/Ultimas -->

        <section class="container related-news">
            <div class="row">
                <div class="col-md-12">
					<?php
					$post_id     = get_the_ID();
					$category_id = get_cat_ID( 'Noticias' );
					if ( get_post_type() == 'concejal' || get_post_type() == 'comision' ) {
						$queryArg['s'] = get_the_title();
					}
					$titulo = 'Artículos relacionados';
					?>

                    <h2 class="h3 section-title"><?php echo $titulo; ?></h2>

                    <div class="row panels-row">

						<?php

						// $categories = get_the_category( $post_id );
						if ( $category_id ) {
//							$category_ids = array();
//							foreach ( $categories as $individual_category ) {
//								$category_ids[] = $individual_category->term_id;
//							}

							$args = [
								'category__in'     => [ $category_id ],
								'post__not_in'     => [ $post_id ],
								'posts_per_page'   => 4, // Number of related posts that will be shown.
								'caller_get_posts' => 1
							];

							if ( isset( $queryArg ) ) {
								$args['s'] = $queryArg['s'];
							}

							$my_query = new wp_query( $args );
							if ( $my_query->have_posts() ) {

								while ( $my_query->have_posts() ) {
									$my_query->the_post();
									?>

                                    <div class="col-md-3">
                                        <a href="<?php the_permalink() ?>" rel="bookmark"
                                           title="<?php the_title(); ?>"
                                           class="panel panel-default">
											<?php if ( has_post_thumbnail() ) { ?>
                                                <div class="panel-heading"
                                                     style="background-image:url('<?php the_post_thumbnail_url( 'medium_large' ); ?>');"></div>
											<?php } else { ?>
                                                <div class="panel-heading"
                                                     style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/images/placeholder.png');"></div>
											<?php } ?>

                                            <header class="panel-body">
                                                <time class="text-muted"><?php the_time( 'd/m/Y' ) ?></time>
                                                <h3><?php the_title(); ?></h3>
                                            </header>
                                        </a>
                                    </div>

									<?php
								}

							}
						}
						wp_reset_query();

						?>
                    </div>
                </div>
            </div>
        </section>

        <!-- tipos de post relacionados (concejales/comisiones) -->
		<?php if ( get_post_type() == 'concejal' || get_post_type() == 'comision' ) : ?>
            <section class="container related-news">

				<?php

				$titulo      = ucfirst( get_post_type() ) . 'es';
				$argConcejal = get_posts( array(
					'category__in' => get_post_type(),
					'numberposts'  => 5,
					'post_type'    => 'concejal',
					'post__not_in' => array( get_the_ID() )
				) );

				?>

                <h2 class="h3 section-title"><?php echo $titulo; ?></h2>

                <div class="row panels-row">
					<?php
					$related = get_posts( array(
						'category__in' => wp_get_post_categories( get_the_ID() ),
						'numberposts'  => 4,
						'post_type'    => get_post_type(),
						'post__not_in' => array( get_the_ID() )
					) );
					if ( $related ) {
						foreach ( $related as $post ) {
							setup_postdata( $post ); ?>

                            <div class="col-md-3">
                                <a href="<?php the_permalink() ?>" rel="bookmark"
                                   title="<?php the_title(); ?>"
                                   class="panel panel-default">
									<?php if ( has_post_thumbnail() ) { ?>
                                        <div class="panel-heading"
                                             style="background-image:url('<?php the_post_thumbnail_url( 'medium_large' ); ?>');"></div>
									<?php } else { ?>
                                        <div class="panel-heading"
                                             style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/images/placeholder.png');"></div>
									<?php } ?>

                                    <header class="panel-body">
                                        <time class="text-muted"><?php the_time( 'd/m/Y' ) ?></time>
                                        <h3><?php the_title(); ?></h3>
                                    </header>
                                </a>
                            </div>

						<?php }
					}
					wp_reset_postdata();
					?>
                </div>
            </section>
		<?php endif; ?>
    </main>
<?php get_footer(); ?>
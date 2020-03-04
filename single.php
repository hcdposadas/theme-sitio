<?php get_header(); ?>
    <main role="main">
        <!-- Articulo Principal -->

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header>

				<?php if ( get_post_type() == 'concejal' ): ?>
                    <section class="jumbotron jumboarticle"
                             style="background-image: url('https://hcdposadas.gob.ar/wp-content/uploads/2018/05/BANNER-ONCEJALES.png');">

                    </section>
				<?php else: ?>
                    <section class="jumbotron jumboarticle"
                             style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/portada.jpg');">

                    </section>
				<?php endif ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 overlap">
                            <div class="title-description">
								<?php the_title( '<h1>', '</h1>' ); ?>

                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
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
							
							// check if the repeater field has rows of data
							if( have_rows('archivos') ):

								// loop through the rows of data
								while ( have_rows('archivos') ) : the_row();

									// display a sub field value
									$file = get_sub_field('archivo');

									$url = $file['url'];
									$title = $file['title'];
									$caption = $file['caption'];

									?>
									<li>
									  <?php 
										// $url = $file['url'];
										// $title = $file['title'];
										// $caption = $file['caption'];
										// $text = get_sub_field('list_item');
										// $url = get_sub_field('item_url');
										if ($url) {
										  $text = '<a href="'.$url.'" target="_blank">'.$title.'</a>';
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
					$titulo = 'Artículos relacionados';
					if ( get_post_type() == 'concejal' || get_post_type() == 'comision' ) {
						$titulo      = 'Relacionados';
						$argConcejal = get_posts( array(
							'category__in' => get_post_type(),
							'numberposts'  => 5,
							'post_type'    => 'concejal',
							'post__not_in' => array( get_the_ID() )
						) );
					}
					?>

                    <h2 class="h3 section-title"><?php echo $titulo; ?></h2>

                    <div class="row panels-row">

						<?php
						//Si es Concejal o comision
						if ( get_post_type() == 'concejal' || get_post_type() == 'comision' ) {

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

						} else {
							$categories = get_the_category( get_the_ID() );
							if ( $categories ) {
								$category_ids = array();
								foreach ( $categories as $individual_category ) {
									$category_ids[] = $individual_category->term_id;
								}

								$args = array(
									'category__in'     => $category_ids,
									'post__not_in'     => array( get_the_ID() ),
									'posts_per_page'   => 4, // Number of related posts that will be shown.
									'caller_get_posts' => 1
								);


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
							$post = $orig_post;
							wp_reset_query();
						}


						?>
                    </div>
                </div>
            </div>
        </section>

    </main>
<?php get_footer(); ?>
<?php get_header(); ?>

    <main role="main">
		<?php $seccion_header_imagen_fondo = get_theme_mod( 'seccion_header_imagen_fondo' ); ?>
		<?php $seccion_header_titulo = get_theme_mod( 'seccion_header_titulo' ); ?>
		<?php $seccion_header_descripcion = get_theme_mod( 'seccion_header_descripcion' ); ?>
		<?php $seccion_header_boton_texto = get_theme_mod( 'seccion_header_boton_texto' ); ?>
		<?php $seccion_header_boton_url = get_theme_mod( 'seccion_header_boton_url' ); ?>
		<?php if ( $seccion_header_imagen_fondo ): ?>
        <section class="jumbotron" style="background-image: url('<?php echo $seccion_header_imagen_fondo; ?>');">
			<?php else: ?>
            <section class="jumbotron"
                     style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/portada.jpg');">
				<?php endif ?>
				<?php if ( wp_get_nav_menu_items( "Secundario" ) ): ?>
                    <div class="jumbotron_bar">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">

                                    <ul class="list-inline pull-right">
										<?php


										// wordpress does not group child menu items with parent menu items
										$navbar_items = wp_get_nav_menu_items( "Secundario" );
										$child_items  = [];
										// pull all child menu items into separate object
										foreach ( $navbar_items as $key => $item ) {
											if ( $item->menu_item_parent ) {
												array_push( $child_items, $item );
												unset( $navbar_items[ $key ] );
											}
										}
										// push child items into their parent item in the original object
										foreach ( $navbar_items as $item ) {
											foreach ( $child_items as $key => $child ) {
												if ( $child->menu_item_parent == $item->ID ) {
													if ( ! $item->child_items ) {
														$item->child_items = [];
													}
													array_push( $item->child_items, $child );
													unset( $child_items[ $key ] );
												}
											}
										}
										// return navbar object where child items are grouped with parents


										foreach ( $navbar_items as $item ) {

											if ( $item->child_items ) {
												print '<li>';
												print '<div class="dropdown">';
												print '<a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> ' . $item->title;
												print '<span class="caret"></span>';
												print '</a>';
												echo '<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">';
												foreach ( $item->child_items as $child_item ) {


													$cssClass = '';
													foreach ( $child_item->classes as $class ) {
														$cssClass .= " " . $class;
													}
													echo '<li><a class="' . $cssClass . '" href="' . $child_item->url . '" title="">' . $child_item->title . '</a></li>';


												}
												print '</ul>';
												print '</div>';
												print '</li>';
											} else {

												$cssClass = '';
												foreach ( $item->classes as $class ) {
													$cssClass .= " " . $class;
												}
												echo '<li><a class="' . $cssClass . '" href="' . $item->url . '" title="">' . $item->title . '</a></li>';
											}


										}

										?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php endif ?>
                <div class="jumbotron_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
                                <h1><?php echo $seccion_header_titulo; ?></h1>
                                <p><?php echo $seccion_header_descripcion; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
                                <a href="<?php echo $seccion_header_boton_url; ?>" target="_blank"
                                   class="btn btn-primary btn-lg"><?php echo $seccion_header_boton_texto; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay"></div>
            </section>

			<?php $seccion_acercade_activo = get_theme_mod( 'seccion_acercade_activo' ); ?>
			<?php $seccion_acercade_titulo = get_theme_mod( 'seccion_acercade_titulo' ); ?>
			<?php $seccion_acercade_descripcion = get_theme_mod( 'seccion_acercade_descripcion' ); ?>

			<?php if ( $seccion_acercade_activo ) { ?>
                <section>
                    <article class="container content_format">
                        <div class="col-md-8 col-md-offset-2">


                            <h2><?php echo $seccion_acercade_titulo; ?></h2>

							<?php echo $seccion_acercade_descripcion; ?>

							<?php $seccion_que_hacemos_activo = get_theme_mod( 'seccion_que_hacemos_activo' ); ?>
							<?php $seccion_que_hacemos_titulo = get_theme_mod( 'seccion_que_hacemos_titulo' ); ?>
							<?php $seccion_que_hacemos_descripcion = get_theme_mod( 'seccion_que_hacemos_descripcion' ); ?>

							<?php if ( $seccion_que_hacemos_activo ) { ?>
                                <h2><?php echo $seccion_que_hacemos_titulo; ?></h2>

								<?php echo $seccion_que_hacemos_descripcion; ?>

							<?php } ?>

                        </div>
                    </article>
                </section>
			<?php } ?>

			<?php $seccion_servicios_activo = get_theme_mod( 'seccion_servicios_activo' ); ?>
			<?php $seccion_servicios_titulo_seccion = get_theme_mod( 'seccion_servicios_titulo_seccion' ); ?>
			<?php $seccion_servicios_titulo = get_theme_mod( 'seccion_servicios_titulo' ); ?>

			<?php if ( $seccion_servicios_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="col-md-8 col-md-offset-2">
                            <h2><?php echo $seccion_servicios_titulo_seccion; ?></h2>
                            <div class="row">
								<?php for ( $i = 1; $i <= 3; $i ++ ) { ?>
									<?php $seccion_servicios_widget_icono_ = get_theme_mod( "seccion_servicios_widget_icono_$i" ); ?>
									<?php $seccion_servicios_widget_titulo_ = get_theme_mod( "seccion_servicios_widget_titulo_$i" ); ?>
									<?php $seccion_servicios_widget_descripcion_ = get_theme_mod( "seccion_servicios_widget_descripcion_$i" ); ?>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="icon-item">
                                            <i class="<?php echo $seccion_servicios_widget_icono_; ?>"></i>
                                            <h3><?php echo $seccion_servicios_widget_titulo_; ?></h3>
                                            <p><?php echo $seccion_servicios_widget_descripcion_; ?></p>
                                        </div>
                                    </div>
								<?php } ?>
                            </div>
                        </div>

                    </div>
                </section>
			<?php } ?>

            <!--   ÚLTIMAS NOVEDADES-->

			<?php $seccion_noticias_activo = get_theme_mod( 'seccion_noticias_activo' ); ?>
			<?php $seccion_noticias_titulo_seccion = get_theme_mod( 'seccion_noticias_titulo_seccion' ); ?>


			<?php if ( $seccion_noticias_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <h2 class="h3 section-title"><?php echo $seccion_noticias_titulo_seccion; ?></h2>
                            </div>
                        </div>
                        <div class="row panels-row">

							<?php
							$category_id = get_cat_ID( 'Noticias' );

							// Get the URL of this category
							$category_link = get_category_link( $category_id );

							$args         = array( 'numberposts' => '4', 'category' => $category_id );
							$recent_posts = wp_get_recent_posts( $args );
							foreach ( $recent_posts as $recent ) {
								?>
                                <div class="col-sm-6 col-md-3">
                                    <a class="panel panel-default panel-md"
                                       href="<?php echo get_permalink( $recent["ID"] ); ?>">
										<?php
										if ( has_post_thumbnail( $recent["ID"] ) ) {
											?>
                                            <div style="background-image:url('<?php echo get_the_post_thumbnail_url( $recent["ID"],
												'medium_large' ); ?>');"
                                                 class="panel-heading"></div>
											<?php
										} else {
											?>
                                            <div style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/images/placeholder.png');"
                                                 class="panel-heading"></div>
											<?php
										}
										?>

                                        <div class="panel-body">
                                            <time><?php echo date( get_option( 'date_format' ),
													strtotime( $recent['post_date'] ) ); ?></time>
                                            <h3><?php echo $recent["post_title"]; ?></h3>
                                        </div>
                                    </a>
                                </div>
								<?php
							}
							wp_reset_query();
							?>


                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="btn btn-primary" href="<?php echo $category_link; ?>">Ver todas las
                                    noticias</a>
                            </div>
                        </div>
                    </div>
                </section>
			<?php } ?>

            <!--   /ÚLTIMAS NOVEDADES-->

            <!-- CONCEJALES-->

            <section>
                <div class="container">
                    <div class="row ">
                        <div class="col-md-12">
                            <h2 class="h3 section-title">Conocé a Nuestros Concejales</h2>
                        </div>
                    </div>
					<?php get_template_part( 'template-parts/content', 'slide-concejales' ); ?>
                </div>
            </section>

            <!-- CONCEJALES-->


            <!-- COMISIONES-->
            <section>
                <div class="container">
                    <div class="row ">
                        <div class="col-md-12">
                            <h2 class="h3 section-title">Comisiones</h2>
                        </div>
                    </div>
                    <div class="carousel slide" id="myCarouselComisiones">
                        <div class="row">
                            <div class="carousel-inner">

								<?php

								$args            = array(
									'numberposts' => '10',
									'post_type'   => 'comision',
									'orderby'     => 'post_date',
									'order'       => 'ASC',
								);
								$recent_posts    = wp_get_recent_posts( $args );
								$countComisiones = 0;
								foreach ( $recent_posts as $recent ) {
									if ( $countComisiones == 0 ) {
										print '<div class="item active">';
										$countComisiones = 1;
									} elseif ( $countComisiones == 1 ) {
										print '<div class="item">';
									}

									?>
                                    <div class="col-sm-6 col-md-3">
                                        <a class="panel panel-default panel-md"
                                           href="<?php echo get_permalink( $recent["ID"] ); ?>">
											<?php
											if ( has_post_thumbnail( $recent["ID"] ) ) {
												?>
                                                <div style="background-image:url('<?php echo get_the_post_thumbnail_url( $recent["ID"],
													'thumbnail' ); ?>'); background-repeat: no-repeat;"
                                                     class="panel-heading"></div>
												<?php
											} else {
												?>
                                                <div style="background-image:url('https://hcdposadas.gob.ar/wp-content/uploads/2018/05/avatar-concejal.png');
                                                    background-size: contain; background-repeat: no-repeat;"
                                                     class="panel-heading"></div>
												<?php
											}
											?>

                                            <div class="panel-body">

                                                <h3 class="text-center"><?php echo $recent["post_title"]; ?></h3>

                                            </div>
                                        </a>
                                    </div>
									<?php
									if ( $countComisiones % 4 == 0 ) {
										print '</div>';
										$countComisiones = 1;
									} else {

										$countComisiones ++;
									}
								}
								wp_reset_query();
								?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <nav>
                                <ul class="control-box pager">
                                    <li>
                                        <a data-slide="prev" href="#myCarouselComisiones" class="">
                                            <i class="glyphicon glyphicon-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-slide="next" href="#myCarouselComisiones" class="">
                                            <i class="glyphicon glyphicon-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- /.control-box -->
                        </div>
                    </div><!-- /#myCarousel -->
                </div>
            </section>
            <!-- COMISIONES-->


			<?php $seccion_links_no_destacados_activo = get_theme_mod( 'seccion_links_no_destacados_activo' ); ?>
			<?php $seccion_links_no_destacados_titulo_seccion = get_theme_mod( 'seccion_links_no_destacados_titulo_seccion' ); ?>


			<?php if ( $seccion_links_no_destacados_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <h2 class="h3 section-title"><?php echo $seccion_links_no_destacados_titulo_seccion; ?></h2>
                            </div>
                        </div>
                        <div class="row panels-row">
							<?php


							$category_id_links_no_destacados = get_theme_mod( 'seccion_links_no_destacados_categoria' );

							// Get the URL of this category
							$category_link_links_no_destacados = get_category_link( $category_id_links_no_destacados );

							$args         = array(
								'numberposts' => '4',
								'category'    => $category_id_links_no_destacados
							);
							$recent_posts = wp_get_recent_posts( $args );
							foreach ( $recent_posts as $recent ) {
								?>
                                <div class="col-sm-6 col-md-3">
                                    <a class="panel panel-default"
                                       href="<?php echo get_permalink( $recent["ID"] ); ?>">

                                        <div class="panel-body">

                                            <h3><?php echo $recent["post_title"]; ?></h3>
                                        </div>
                                    </a>
                                </div>
								<?php
							}
							wp_reset_query();
							?>

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="btn btn-primary" href="<?php echo $category_link_links_no_destacados; ?>">Ver
                                    Todo</a>
                            </div>
                        </div>
                </section>
			<?php } ?>

			<?php $seccion_links_no_destacados_con_descripcion_activo = get_theme_mod( 'seccion_links_no_destacados_con_descripcion_activo' ); ?>
			<?php $seccion_links_no_destacados_con_descripcion_titulo_seccion = get_theme_mod( 'seccion_links_no_destacados_con_descripcion_titulo_seccion' ); ?>


			<?php if ( $seccion_links_no_destacados_con_descripcion_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <h2 class="h3 section-title"><?php echo $seccion_links_no_destacados_con_descripcion_titulo_seccion; ?></h2>
                            </div>
                        </div>
                        <div class="row panels-row">
							<?php

							$category_id_links_no_destacados_con_descripcion = get_theme_mod( 'seccion_links_no_destacados_con_descripcion_categoria' );

							// Get the URL of this category
							$category_link_links_no_destacados_con_descripcion = get_category_link( $category_id_links_no_destacados_con_descripcion );

							$args         = array(
								'numberposts' => '4',
								'category'    => $category_id_links_no_destacados_con_descripcion
							);
							$recent_posts = wp_get_recent_posts( $args );
							foreach ( $recent_posts as $recent ) {
								?>
                                <div class="col-sm-6 col-md-3">
                                    <a class="panel panel-default"
                                       href="<?php echo get_permalink( $recent["ID"] ); ?>">

                                        <div class="panel-body">

                                            <h3><?php echo $recent["post_title"]; ?></h3>
                                            <p class="text-muted">
												<?php
												$text           = strip_shortcodes( $recent["post_content"] );
												$text           = apply_filters( 'the_content', $text );
												$text           = str_replace( ']]>', ']]&gt;', $text );
												$excerpt_length = apply_filters( 'excerpt_length', 10 );
												$excerpt_more   = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
												$text           = wp_trim_words( $text,
													$excerpt_length,
													$excerpt_more );
												echo $text;
												?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
								<?php
							}
							wp_reset_query();
							?>

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="<?php echo $category_link_links_no_destacados_con_descripcion; ?>"
                                   class="btn btn-primary">Ver Todo</a>
                            </div>
                        </div>
                </section>
			<?php } ?>

			<?php $seccion_links_destacados_con_icono_descripcion_activo = get_theme_mod( 'seccion_links_destacados_con_icono_descripcion_activo' ); ?>
			<?php $seccion_links_destacados_con_icono_descripcion_titulo_seccion = get_theme_mod( 'seccion_links_destacados_con_icono_descripcion_titulo_seccion' ); ?>


			<?php if ( $seccion_links_destacados_con_icono_descripcion_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <h2 class="h3 section-title"><?php echo $seccion_links_destacados_con_icono_descripcion_titulo_seccion; ?></h2>
                            </div>
                        </div>
                        <div class="row panels-row">

							<?php

							$category_id_links_destacados_con_icono_descripcion = get_theme_mod( 'seccion_links_destacados_con_icono_descripcion_categoria' );

							// Get the URL of this category
							$category_link_links_destacados_con_icono_descripcion = get_category_link( $category_id_links_destacados_con_icono_descripcion );

							$args         = array(
								'numberposts' => '4',
								'category'    => $category_id_links_destacados_con_icono_descripcion
							);
							$recent_posts = wp_get_recent_posts( $args );
							foreach ( $recent_posts as $recent ) {
								?>
                                <div class="col-sm-6 col-md-3">
                                    <a class="panel panel-default panel-icon"
                                       href="<?php echo get_permalink( $recent["ID"] ); ?>">
                                        <div class="panel-heading"><i class="fa fa-file"></i></div>
                                        <div class="panel-body">

                                            <h3><?php echo $recent["post_title"]; ?></h3>
                                            <p class="text-muted">
												<?php
												$text           = strip_shortcodes( $recent["post_content"] );
												$text           = apply_filters( 'the_content', $text );
												$text           = str_replace( ']]>', ']]&gt;', $text );
												$excerpt_length = apply_filters( 'excerpt_length', 10 );
												$excerpt_more   = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
												$text           = wp_trim_words( $text,
													$excerpt_length,
													$excerpt_more );
												echo $text;
												?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
								<?php
							}
							wp_reset_query();
							?>


                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="<?php echo $category_link_links_destacados_con_icono_descripcion; ?>"
                                   class="btn btn-primary">Ver Todo</a>
                            </div>
                        </div>
                </section>
			<?php } ?>

			<?php $seccion_links_destacados_con_fotos_activo = get_theme_mod( 'seccion_links_destacados_con_fotos_activo' ); ?>
			<?php $seccion_links_destacados_con_fotos_titulo_seccion = get_theme_mod( 'seccion_links_destacados_con_fotos_titulo_seccion' ); ?>


			<?php if ( $seccion_links_destacados_con_fotos_activo ) { ?>
                <section>
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <h2 class="h3 section-title"><?php echo $seccion_links_destacados_con_fotos_titulo_seccion; ?></h2>
                            </div>
                        </div>
                        <div class="row panels-row">
							<?php

							$category_id_links_destacados_con_icono_descripcion = get_theme_mod( 'seccion_links_destacados_con_icono_descripcion_categoria' );

							// Get the URL of this category
							$category_link_links_destacados_con_icono_descripcion = get_category_link( $category_id_links_destacados_con_icono_descripcion );

							$args         = array(
								'numberposts' => '4',
								'category'    => $category_id_links_destacados_con_icono_descripcion
							);
							$recent_posts = wp_get_recent_posts( $args );
							foreach ( $recent_posts as $recent ) {
								?>
                                <div class="col-sm-6 col-md-3">
                                    <a class="panel panel-default"
                                       href="<?php echo get_permalink( $recent["ID"] ); ?>">
										<?php
										if ( has_post_thumbnail( $recent["ID"] ) ) {
											?>
                                            <div style="background-image:url('<?php echo get_the_post_thumbnail_url( $recent["ID"],
												'thumbnail' ); ?>');"
                                                 class="panel-heading"></div>
											<?php
										} else {
											?>
                                            <div style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/images/placeholder.png');"
                                                 class="panel-heading"></div>
											<?php
										}
										?>
                                        <div class="panel-body">

                                            <h3><?php echo $recent["post_title"]; ?></h3>

                                        </div>
                                    </a>
                                </div>
								<?php
							}
							wp_reset_query();
							?>
                        </div>
                    </div>
                </section>
			<?php } ?>

            <!-- PLACAS-->
			<?php $seccion_contacto_activo = get_theme_mod( 'seccion_contacto_activo' ); ?>
			<?php $seccion_contacto_titulo_seccion = get_theme_mod( 'seccion_contacto_titulo_seccion' ); ?>
			<?php $seccion_contacto_titulo_formulario = get_theme_mod( 'seccion_contacto_titulo_formulario' ); ?>

            <!--Sección Social Widgets-->
            <section>
                <div class="container">
					<?php if ( is_active_sidebar( 'poncho-social' ) ) : ?>
                        <div class="row text-center">
							<?php dynamic_sidebar( 'poncho-social' ); ?>
                        </div>
					<?php endif; ?>
                </div>
            </section>
            <!--Sección Social Widgets-->


    </main>

    <!-- SECCION WIDGETS-->
    <section>
        <div class="container">
			<?php if ( is_active_sidebar( 'poncho-placas' ) ) : ?>
                <div class="row text-center">
					<?php dynamic_sidebar( 'poncho-placas' ); ?>
                </div>
			<?php endif; ?>
        </div>
    </section>
    <!-- SECCION WIDGETS-->


<?php get_footer(); ?>
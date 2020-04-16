<div class="carousel slide" id="myCarouselConcejales">
	<div class="row">
		<div class="carousel-inner">

			<?php
			//                                $category_id = get_cat_ID( 'Concejales' );
			//
			//                                // Get the URL of this category
			//                                $category_link = get_category_link( $category_id );

			$args            = array(
				'numberposts' => '15',
				'post_type'   => [ 'concejal', 'defensor' ],
				'orderby'     => 'post_date',
				'order'       => 'ASC',
			);
			$recent_posts    = wp_get_recent_posts( $args );
			$countConcejales = 0;
			foreach ( $recent_posts as $recent ) {
				if ( $countConcejales == 0 ) {
					print '<div class="item active">';
					$countConcejales = 1;
				} elseif ( $countConcejales == 1 ) {
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
								'thumbnail' ); ?>'); background-size: auto; background-repeat: no-repeat;"
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
							<div class="text-center">
                                                    <span><?php echo get_post_meta( $recent["ID"],
		                                                    'Cargo',
		                                                    true ); ?></span><br>
								<span><?php echo get_post_meta( $recent["ID"],
										'Bloque',
										true ); ?></span>
							</div>
						</div>
					</a>
				</div>
				<?php
				if ( $countConcejales % 4 == 0 ) {
					print '</div>';
					$countConcejales = 1;
				} else {

					$countConcejales ++;
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
					<a data-slide="prev" href="#myCarouselConcejales" class="">
						<i class="glyphicon glyphicon-chevron-left"></i>
					</a>
				</li>
				<li>
					<a data-slide="next" href="#myCarouselConcejales" class="">
						<i class="glyphicon glyphicon-chevron-right"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.control-box -->
	</div>
</div><!-- /#myCarousel -->
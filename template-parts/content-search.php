<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
								<?php if ( has_post_thumbnail() ) { ?>
                                    <img class="media-object" src="<?php the_post_thumbnail_url( [ 100, 100 ] ); ?>"
                                         alt="...">
								<?php } else { ?>
                                    <img class="media-object" src="http://placehold.it/100x100" alt="...">
								<?php } ?>
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
								<?php the_title( sprintf( '<a href="%s" rel="bookmark">',
									esc_url( get_permalink() ) ),
									'</a>' ); ?>
                                <span>
                    <!--                        enlace editar-->
									<?php
									edit_post_link( '<i class="fa fa-edit"></i>' );
									?>
                                    <!--                        enlace editar-->
                        </span>

                            </h4>

							<?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</article><!-- #post-## -->


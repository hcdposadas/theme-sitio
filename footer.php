<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
				<?php if ( has_custom_logo( 0 ) ) {
					echo get_custom_logo( 0 );
				} else {
					?>
                    <img class="image-responsive" alt="Argentina.gob.ar - Presidencia de la Nación"
                         src="<?php echo get_stylesheet_directory_uri(); ?>/images/argentinagob.svg">
				<?php } ?>
                <br>
                <p class="text-muted small">Los contenidos de <?php bloginfo( 'title' ); ?> están licenciados bajo <a
                            href="https://creativecommons.org/licenses/by/2.5/ar/">Creative Commons Reconocimiento
                        2.5 Argentina License</a></p>
            </div>
            <div class="col-md-4">
                <p>
                    <a target="_blank" href="http://posadas.gob.ar/">Municipalidad de Posadas</a>
                </p>
                <p>
                    <ul>
                    <li> <a href="https://hcdposadas.gob.ar/audiencias-publicas">Audiencia Pública</a> </li>
                    <li><a href="https://hcdposadas.gob.ar/mesa-de-informes">Mesa de Informes</a></li>
                    <li><a href="https://hcdposadas.gob.ar/manual-de-marca-con-los-logos-y-mas/">Recursos Gráficos</a></li>
                    <li><a href="https://hcdposadas.gob.ar/category/plandelabor/">Plan de Labor</a></li>
                </ul>
                </p>
            </div>
            <div class="col-md-4">

                <div class="row">
                    <h5>Redes sociales</h5>
	                <?php $poncho_facebook_text = get_theme_mod( 'poncho_facebook_text' ); ?>
	                <?php $poncho_twitter_text = get_theme_mod( 'poncho_twitter_text' ); ?>
	                <?php $poncho_instagram_text = get_theme_mod( 'poncho_instagram_text' ); ?>
	                <?php $poncho_youtube_text = get_theme_mod( 'poncho_youtube_text' ); ?>
	                <?php $poncho_ver_sesion_en_vivo = get_theme_mod( 'poncho_ver_sesion_en_vivo' ); ?>

                    <div class="social-share">
                        <ul class="list-inline">
                            <li><a target="_blank" href="<?php echo $poncho_facebook_text; ?>"><i
                                            class="fa fa-facebook"></i></a></li>
                            <li><a target="_blank" href="<?php echo $poncho_twitter_text; ?>"><i
                                            class="fa fa-twitter "></i></a></li>
                            <li><a target="_blank" href="<?php echo $poncho_instagram_text; ?>"><i
                                            class="fa fa-instagram"></i></a></li>
                            <li><a target="_blank" href="<?php echo $poncho_youtube_text; ?>"><i
                                            class="fa fa-youtube"></i></a></li>
                            <li><a target="_blank" href="<?php echo $poncho_ver_sesion_en_vivo; ?>" data-toggle="tooltip" title="VER SESIÓN EN VIVO"><i
                                            class="fa fa-video-camera"></i></a></li>
                        </ul>
                    </div>
                </div>

				<div class="row">
					<?php $seccion_contacto_titulo_seccion = get_theme_mod( 'seccion_contacto_titulo_seccion' ); ?>
                    <h2 class="h3 section-title"><?php echo $seccion_contacto_titulo_seccion; ?></h2>
                    <div>

                        <p class="margin-40">
							<?php $poncho_telefono = get_theme_mod( 'poncho_telefono' ); ?>
							<?php $poncho_celular = get_theme_mod( 'poncho_celular' ); ?>
							<?php $poncho_mail = get_theme_mod( 'poncho_mail' ); ?>
							<?php $poncho_direccion = get_theme_mod( 'poncho_direccion' ); ?>
                            <strong>Dirección:</strong> <?php echo $poncho_direccion ?><br>
							<?php if ( $poncho_celular ) : ?>
                                <strong>Celular:</strong> <?php echo $poncho_celular ?><br>
							<?php endif; ?>
                            <strong>Correo electrónico:</strong> <a
                                    href="mailto:<?php echo $poncho_mail ?>"><?php echo $poncho_mail ?></a>
                        </p>
                        <p>
	                        <?php echo get_theme_mod( 'seccion_footer_descripcion_3' ); ?>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php wp_footer(); ?>

<!--<script src="./node_modules/jquery/dist/jquery.min.js"></script>-->
<!--<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>-->


</body>
</html>
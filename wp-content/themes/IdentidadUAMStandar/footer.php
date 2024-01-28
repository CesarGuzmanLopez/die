<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @author CesarGuzmanLopez
 * @package IdentidadUAMStandar
 */
?>
</main><!-- #site-content -->

<footer class="credits">
    <?php if (is_active_sidebar('pie-de-pagina')) : ?>
        <div id="secondary-sidebar" class="pie-de-pagina">
            <?php dynamic_sidebar('pie-de-pagina'); ?>
        </div>
    <?php endif; ?>
    <div class="section-inner">
        <a href="#" class="to-the-top">
            <div class=""><h1>↑</h1></div>
        </a>
        <p class="copyright">&copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo wp_kses_post(get_bloginfo('title')); ?></a></p>
    </div><!-- .section-inner -->
</footer><!-- .credits -->

<?php wp_footer(); ?>

</body>

</html>

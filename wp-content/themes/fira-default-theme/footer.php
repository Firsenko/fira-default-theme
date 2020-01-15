</main>
<footer class="footer">
	<div class="container">
         <div class="row">
         <a href="#" class="totop">
<!--             <i class="fas fa-chevron-up"></i>-->
         </a>
            <div class="col-12">
                <div class="logo-footer">
                    <?php if (!(get_theme_mod( 'fira_footer_logo' ))): ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                    <?php else: ?>
                        <a href='<?php echo esc_url( home_url( '/' ) ); ?>'>
                            <img src="<?php echo esc_url( get_theme_mod( 'fira_footer_logo' ) ); ?>"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
                    <?php endif ?>
                </div>
            </div>

			<div class="col-12">
				<div class="copyright text-center">
					 &copy; <?= date('Y');?> <?= get_theme_mod('fira_footer_copyright_text');?>
				</div>
			</div>
		</div>
	</div>
</footer>
</div>

<?php wp_footer();?>
</body>
</html>

<footer>
    <div class="footer wrapper">
		<div class="footer__contacts">
			<span>جهات الاتصال الخاصة بنا</span>
			<a href="mailto:contact@arabicbookmakers.com">contact@arabicbookmakers.com</a>
		</div>
        <?php 
			if (has_nav_menu('footer')) { ?>
                <div class="footer__menu">
                    <?php 
                        wp_nav_menu( array(
                            'menu_class'=>'menu',
                            'theme_location'=>'footer'
                        ));
                    ?>
                </div>
        <?php } ?>
        <div class="footer__bga">
            <div class="eighteen">18+</div>
            <img class="bga-img" src="<?php echo get_home_url(); ?>/wp-content/uploads/2025/09/begamble-icon.webp" width="488" height="50" alt="BGA">
			<a href="//www.dmca.com/Protection/Status.aspx?ID=229f78c2-775a-4928-bad4-873553e8fa8f" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/DMCA_badge_grn_60w.png?ID=229f78c2-775a-4928-bad4-873553e8fa8f"  alt="DMCA.com Protection Status" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
        </div>
        <div class="footer__copyright">
            <span><?php echo date('Y');?> © حقوق الطبع والنشر</span>
        </div>
        <?php if (is_amp()):?>
            <div class="scroll-top <?php echo $amp_class; ?>" on="tap:scroll.scrollTo(duration=200)">
                <div class="scroll-top-bg">    
                    <img src="<?php echo get_template_directory_uri() ?>/img/up-icon.svg" alt="scroll to top">
                </div>
            </div>
        <?php else: ?>
            <div class="scroll-top">
                <div class="scroll-top-bg"> 
                    <img src="<?php echo get_template_directory_uri() ?>/img/up-icon.svg" alt="scroll to top">
                </div>
            </div>
        <?php endif; ?>
    </div>
</footer>
<div id="cookie-block">
    <p class="cookie__block-text">
    حن نستخدم ملفات تعريف الارتباط والتقنيات المماثلة لضمان التشغيل السليم لموقعنا، وتحسين تجربتك، وتحليل حركة المرور. من خلال النقر على "قبول"، فإنك توافق على استخدامنا لملفات تعريف الارتباط. لمزيد من المعلومات، يُرجى الاطلاع على سياسة ملفات تعريف الارتباط الخاصة بنا.
    </p>
    <div class="cookie__block-buttons">
        <button class="btn cookie__block-accept">
            <span>قبول</span>
        </button>
        <a href="/سياسة-ملفات-تعريف-الارتباط" class="cookie__block-reject">
            <span>سياسة ملفات تعريف الارتباط</span>
        </a>
    </div>
</div>

<?php wp_footer(); ?>

<script src="<?php echo get_template_directory_uri() ?>/js/main.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/cookie.js"></script>

</body>
</html>

        </div><!-- end content -->

    </div><!-- end wrap -->
    

    <!--[if lt IE 9]>
  <div class="footer container" role="contentinfo">
<![endif]-->

<footer class="container">
  <div class="row">
    <h1 class="invisible-but-readable">Website-Fußzeile</h1>
    <div class="span12 legal">
      <div class="inner">
        <small>Copyright © 2013 Deutsche Digitale Bibliothek</small>
        <ul>
          <li><a href="https://www.deutsche-digitale-bibliothek.de/content/terms">Nutzungsbedingungen</a></li>
          <li><a href="https://www.deutsche-digitale-bibliothek.de/content/privacy">Datenschutzerklärung</a></li>
          <li><a href="https://www.deutsche-digitale-bibliothek.de/content/publisher">Impressum</a></li>
          <li><a href="https://www.deutsche-digitale-bibliothek.de/content/sitemap">Sitemap</a></li>
          <li><a href="https://www.deutsche-digitale-bibliothek.de/content/contact">Kontakt</a></li>
        </ul>
        <!-- <div class="build">4.2.1 / 2.5.2</div> -->
      </div>
    </div>
  </div>
          <div id="footer-text">
            <?php echo get_theme_option('Footer Text'); ?>
            <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
                <p><?php echo $copyright; ?></p>
            <?php endif; ?>
            <!-- <p><?php echo __('Proudly powered by <a href="http://omeka.org">Omeka</a>.'); ?></p> -->
        </div>
        <?php fire_plugin_hook('public_footer'); ?>
</footer>
<!--[if lt IE 9]>
  </div>
<![endif]-->
<!-- end footer -->
</body>
</html>

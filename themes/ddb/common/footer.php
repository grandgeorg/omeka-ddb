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

    <script type="text/javascript">
    var offsetX = 80;
    var offsetY = 90;
    var winW = 0;
    var winH = 0;
    $(document).ready(function() {
        /* Toottip - JQueryUI */
        $('nav').tooltip({ 
            tooltipClass: "ddb-omeka-tooltip-styling",
            position: {
                my: "center top+9",
                at: "center bottom",
                using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                    .addClass( "arrow" )
                    .addClass( feedback.vertical )
                    .addClass( feedback.horizontal )
                    .appendTo( this );
                }
            }
        });

        /* Omeka core js */
        // Omeka.showAdvancedForm();   ---------enable again?     
        // Omeka.moveNavOnResize();        
        // Omeka.mobileMenu();   

        /* Carousel Page Navigation 
         * @see : http://docs.dev7studios.com/jquery-plugins/caroufredsel-advanced
         */
        $('#nav-carousel').carouFredSel({
            circular: false,
            infinite: false,
            auto    : {play : false},
            width: '100%',
            prev    : { 
                button  : "#ddb-omeka-carousel_prev",
                key     : "left"
            },
            next    : { 
                button  : "#ddb-omeka-carousel_next",
                key     : "right",
            },
            cookie: true,
        });

        /*  Lightbox - ColorBox  */
        $(".ddb-omeka-gallery a").colorbox({
            rel:'ddb-omake-colorbox', 
                // inline:true, 
                maxWidth:"100%", 
                maxHeight:"100%",
                // onComplete:function(){ console.log(this); },
                title: function(){
                    var title = '';
                    var copyright = '';
                    var link = '';
                    if (typeof(this.dataset.copyright) != 'undefined' && this.dataset.copyright.length > 0) {
                        copyright = '<div class="ddb-omkea-colorbox-copyright">&copy; ' + this.dataset.copyright + '</div>';
                    }
                    if (typeof(this.dataset.linktext) != 'undefined' && this.dataset.linktext.length > 0) {
                        link = this.dataset.linktext;
                    }
                    if (typeof(this.dataset.linkurl) != 'undefined' && this.dataset.linkurl.length > 0) {
                        if (link.length == 0) {
                            if (typeof(this.dataset.linktitle) != 'undefined' && this.dataset.linktitle.length > 0) {
                                link = '<i class="icon-globe"></i> <a href="' + this.dataset.linkurl + '" title="' + this.dataset.linktitle + '">' + this.dataset.linkurl + '</a>';
                            } else {
                                link = '<i class="icon-globe"></i> <a href="' + this.dataset.linkurl + '">' + this.dataset.linkurl + '</a>';
                            }
                        } else {
                            if (typeof(this.dataset.linktitle) != 'undefined' && this.dataset.linktitle.length > 0) {
                                link = '<i class="icon-globe"></i> <a href="' + this.dataset.linkurl + '" title="' + this.dataset.linktitle + '">' + link + '</a>';
                            } else {
                                link = '<i class="icon-globe"></i> <a href="' + this.dataset.linkurl + '">' + link + '</a>';
                            }
                        }
                    }
                    if (link.length > 0) {
                        link = '<div class="ddb-omkea-colorbox-link">' + link + '</div>';
                    }
                    if (typeof(this.dataset.title) != 'undefined' && this.dataset.title.length > 0) {
                        title =  '<div class="ddb-omkea-colorbox-title">' + link + this.dataset.title + '</div>';
                    } else {
                        title = link
                    }
                    return copyright + title;
                }
        });

        winW = $(window).innerWidth();
        winH = $(window).innerHeight();
        if (winH < $(window).height() && winW < $(window).width()) {
            winW = $(window).width();
            winH = $(window).height();
        }
        winW = winW - offsetX;
        winH = winH - offsetY;

    });
    </script>

</body>
</html>

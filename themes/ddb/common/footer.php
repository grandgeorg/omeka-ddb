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
    $(document).ready(function() {

        /* GINA Grandgeorg Internet Application object */
        if ($.Gina) {
            $.Gina = $.Gina;
        } else {
            $.Gina = {
                offsetX: 63, /*63*/
                offsetY: 95, /*95*/
                winW: 0,
                winH: 0,
                setWindowSizes: function(loaded) {
                    this.winW = $(window).innerWidth();
                    this.winH = $(window).innerHeight();
                    if (this.winH < $(window).height() && this.winW < $(window).width()) {
                        this.winW = $(window).width();
                        this.winH = $(window).height();
                    }
                    this.winW = this.winW - this.offsetX;
                    this.winH = this.winH - this.offsetY;
                    // if(!loaded) {
                    //     $(window).resize(function() {
                    //         $.Gina.setWindowSizes(!loaded);
                    //     });
                    // }
                }


            }
        }
        $.Gina.setWindowSizes();


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
            maxWidth:"100%", 
            maxHeight:"100%",
            title: function(){
                var title = '';
                var titleTrigger = '';
                var copyright = '';
                var copyrightTrigger = '';
                var link = '';
                var linkIcon = '<i class="icon-earth"></i> ';
                //  copyright
                if (typeof(this.dataset.copyright) != 'undefined' && this.dataset.copyright.length > 0) {
                    copyright = '<div class="ddb-omkea-colorbox-copyright">' + this.dataset.copyright + '</div>';
                    copyrightTrigger = '<div class="ddb-omkea-colorbox-copyright-trigger">&copy;</div>';
                }
                //  link
                if (typeof(this.dataset.linktext) != 'undefined' && this.dataset.linktext.length > 0) {
                    link = this.dataset.linktext;
                }
                if (typeof(this.dataset.linkurl) != 'undefined' && this.dataset.linkurl.length > 0) {
                    if (link.length == 0) {
                        if (typeof(this.dataset.linktitle) != 'undefined' && this.dataset.linktitle.length > 0) {
                            link = '<a href="' + this.dataset.linkurl + '" title="' + this.dataset.linktitle + '">' + linkIcon + '</a>';
                        } else {
                            link = '<a href="' + this.dataset.linkurl + '" title="' + this.dataset.linkurl + '">' + linkIcon + '</a>';
                        }
                    } else {
                        if (typeof(this.dataset.linktitle) != 'undefined' && this.dataset.linktitle.length > 0) {
                            link = '<a href="' + this.dataset.linkurl + '" title="' + this.dataset.linktitle + ' - ' + link + '">' + linkIcon + '</a>';
                        } else {
                            link = '<a href="' + this.dataset.linkurl + '" title="' + link + '">' + linkIcon * '</a>';
                        }
                    }
                } else if (link.length > 0) {
                    link = '<i class="icon-earth" title="' + link + '"></i> ';
                }
                if (link.length > 0) {
                    link = '<div class="ddb-omkea-colorbox-link">' + link + '</div>';
                }
                // title
                if (typeof(this.dataset.title) != 'undefined' && this.dataset.title.length > 0) {
                    title =  '<div class="ddb-omkea-colorbox-title"> ' + this.dataset.title + '</div>';
                    titleTrigger =  '<div class="ddb-omkea-colorbox-title-trigger"><i class="icon-info2"></i> </div>';
                }
                return title + copyright + '<div class="ddb-omkea-colorbox-info-triggers">' + titleTrigger + copyrightTrigger + link + '</div>';
            },
            onComplete: function() {
                $('.ddb-omkea-colorbox-copyright-trigger').click(function() {
                    $('.ddb-omkea-colorbox-title').filter(':visible').toggle();
                    $('.ddb-omkea-colorbox-copyright').toggle();
                });
                $('.ddb-omkea-colorbox-title-trigger').click(function() {
                    $('.ddb-omkea-colorbox-copyright').filter(':visible').toggle();
                    $('.ddb-omkea-colorbox-title').toggle();
                });
                $('#cboxLoadedContent').css('overflow-x', 'hidden');
            }
        });


    });
    </script>
</body>
</html>

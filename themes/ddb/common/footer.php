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
                    if(!loaded) {
                        $(window).resize(function() {
                            $.Gina.setWindowSizes(!loaded);
                        });
                    }
                },

                setThumbGallerImageSizes: function(loaded) {
                    var thumbnailGalleryClass = '#thumbnail-gallery-carousel-wrapper';
                    var offset = 94;
                    if ($(thumbnailGalleryClass).get(0)) {
                        var colWidth = $('.secondary').width();
                        var imgWidth = Math.round((colWidth - offset) / 3);
                        var prevnextHeight = 31;
                        var prevnextMargin = 0;
                        $(thumbnailGalleryClass + ' div.exhibit-item').css({'width' : imgWidth + 'px', 'height' : imgWidth + 'px'});
                        if ($('.external-thumbnail').get(0)) {
                            $('.external-thumbnail').css({'width' : imgWidth + 'px', 'height' : imgWidth + 'px'});
                        }
                        $('#thumbnail-gallery-carousel-container').css({'height' : imgWidth + 'px'});
                        $('#thumbnail-gallery-carousel-container .caroufredsel_wrapper').css({
                            'height' : imgWidth + 'px', 
                            'width' : ((imgWidth * 3) + 30) + 'px'});
                        $(thumbnailGalleryClass).css({'height' : imgWidth + 'px'});
                        prevnextMargin = Math.round((imgWidth - prevnextHeight) / 2);
                        if (prevnextMargin > 0) {
                            $('.ddb-omeka-carousel-gallery-controlls').css('margin', 
                                prevnextMargin + 'px 0');
                        }
                        if(!loaded) {
                            $(window).resize(function() {
                                $.Gina.setThumbGallerImageSizes(!loaded);
                            });
                        }
                    } 
                    // else if($('.external-thumbnail').get(0)) {
                        // $('.etxernal-thumbnail').css({'width' : imgWidth + 'px', 'height' : imgWidth + 'px'});
                    // }
                }

            }
        }
        $.Gina.setWindowSizes();
        $.Gina.setThumbGallerImageSizes();


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
        if ($('#nav-carousel').get(0)) {
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
                // cookie: false,
                // items: {start: $('#nav-carousel .current')},
                scroll: {
                    duration : 1500, // 0.2,
                    // easing: 'linear'
                }
            });
            if ($('#nav-carousel .current').is('#nav-carusel-item-1')) {
                // alert('ja');
                $('#nav-carousel').trigger('slideTo', [$('#nav-carousel .current')]);
            } else {
                $('#nav-carousel').trigger('slideTo', [$('#nav-carousel .current'), -1]);
            }
        }

        /* Carousel Thubnail Gallery 
         */
        if ($('#thumbnail-gallery-carousel-wrapper').get(0)) {
            $('#thumbnail-gallery-carousel-wrapper').carouFredSel({
                circular: false,
                infinite: false,
                auto    : {play : false},
                resposive    : true,
                // width: '100%',
                items   : {
                    visible: 3,
                    minimum: 4,
                },
                scroll : {
                    items           : 3
                },
                // items: 3,
                // direction: "left",
                prev    : { 
                    button  : "#ddb-omeka-carousel-gallery_prev",
                    // key     : "left"
                },
                next    : { 
                    button  : "#ddb-omeka-carousel-gallery_next",
                    // key     : "right",
                },
                cookie: false,
            });
        }

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
                    copyrightTrigger = '<div class="ddb-omkea-colorbox-copyright-trigger"><i>&copy;</i></div>';
                }
                //  link
                if (typeof(this.dataset.linktext) != 'undefined' && this.dataset.linktext.length > 0) {
                    link = this.dataset.linktext;
                }
                if (typeof(this.dataset.linkurl) != 'undefined' && this.dataset.linkurl.length > 0) {
                    if (link.length == 0) {
                        if (typeof(this.dataset.linktitle) != 'undefined' && this.dataset.linktitle.length > 0) {
                            link = '<a target="_blank" href="' + this.dataset.linkurl + '" title="' + this.dataset.linktitle + '">' + linkIcon + '</a>';
                        } else {
                            link = '<a target="_blank" href="' + this.dataset.linkurl + '" title="' + this.dataset.linkurl + '">' + linkIcon + '</a>';
                        }
                    } else {
                        if (typeof(this.dataset.linktitle) != 'undefined' && this.dataset.linktitle.length > 0) {
                            link = '<a target="_blank" href="' + this.dataset.linkurl + '" title="' + this.dataset.linktitle + ' - ' + link + '">' + linkIcon + '</a>';
                        } else {
                            link = '<a target="_blank" href="' + this.dataset.linkurl + '" title="' + link + '">' + linkIcon + '</a>';
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
                    title =  '<div class="ddb-omkea-colorbox-title">'
                        + '<div id="ddb-omkea-colorbox-info-close"></div>'
                        + '<strong>' + this.dataset.title
                        + '</strong><br>' + this.dataset.description + '</div>';
                    titleTrigger =  '<div class="ddb-omkea-colorbox-title-trigger"><i class="active icon-info2"></i> </div>';
                }
                return title + copyright + '<div class="ddb-omkea-colorbox-info-triggers">' + titleTrigger + copyrightTrigger + link + '</div>';
            },
            onComplete: function() {
                $('.ddb-omkea-colorbox-copyright-trigger').click(function() {
                    $('.ddb-omkea-colorbox-title').filter(':visible').toggle();
                    $('.ddb-omkea-colorbox-copyright').toggle();
                    $('.ddb-omkea-colorbox-title-trigger i').removeClass('active');
                    if ($('.ddb-omkea-colorbox-copyright-trigger i').hasClass('active')) {
                        $('.ddb-omkea-colorbox-copyright-trigger i').removeClass('active');
                    } else {
                        $('.ddb-omkea-colorbox-copyright-trigger i').addClass('active');
                    }
                });
                $('.ddb-omkea-colorbox-title-trigger').click(function() {
                    $('.ddb-omkea-colorbox-copyright').filter(':visible').toggle();
                    $('.ddb-omkea-colorbox-title').toggle();
                    $('.ddb-omkea-colorbox-copyright-trigger i').removeClass('active');
                    if ($('.ddb-omkea-colorbox-title-trigger i').hasClass('active')) {
                        $('.ddb-omkea-colorbox-title-trigger i').removeClass('active');
                    } else {
                        $('.ddb-omkea-colorbox-title-trigger i').addClass('active');
                    }
                });
                $('#ddb-omkea-colorbox-info-close').click(function() {
                    $('.ddb-omkea-colorbox-title').css('display', 'none');
                    $('.ddb-omkea-colorbox-title-trigger i').removeClass('active');
                });
                $('#cboxLoadedContent').css('overflow-x', 'hidden');
            }
        });


    });
    </script>
</body>
</html>

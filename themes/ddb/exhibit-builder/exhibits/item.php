<?php
$width = 0; $height = 0;
$files = $item->getFiles();
$countFiles = count($files);
foreach ($files as $file) {
    if (isset($file->metadata)) {
        $metadata = json_decode($file->metadata);
        if (isset($metadata->video->resolution_x) && 
            $metadata->video->resolution_x > $width) {

            $width = $metadata->video->resolution_x;
        }
        if (isset($metadata->video->resolution_y) && 
            $metadata->video->resolution_y > 0) {

            $height = $height + $metadata->video->resolution_y;
        }
    }
}
?>
<div class="inline-lightbox-container" style="min-width:280px; min-height:100px;">
<?php echo files_for_item(array('imageSize' => 'fullsize', 'linkToFile' => true), 
    array('class'=>'inline-lightbox-element')); ?></div>

<script type="text/javascript">
    $(document).ready(function() {

        $.Gina.sizeColorBoxItem = function(loaded) {

            if (loaded) {
                $.Gina.setWindowSizes();
            }

            var mediaWidth = <?php echo $width; ?>;
            var mediaHeight = <?php echo $height; ?>;
            var countFiles =  <?php echo $countFiles; ?>;
            var withType = '';
            var newHeight = 0;
            var newWidth = 0;
            var checkWidth = 0;


            // container width
            if (mediaWidth > $.Gina.winW) {
                newWidth = $.Gina.winW;
                withType = 'window';
            } else {
                newWidth = mediaWidth;
            }

            // container height
            newHeight = mediaHeight / mediaWidth * newWidth;
            checkWidth = mediaWidth / mediaHeight * newHeight;
            if (newHeight > $.Gina.winH) {
                newHeight = $.Gina.winH;
                checkWidth = mediaWidth / mediaHeight * newHeight;
            }
            if (checkWidth < newWidth && countFiles == 1) {
                newWidth = checkWidth;
            }

            // set conatainer
            if (withType == 'window') {
                $('.inline-lightbox-container').css({'width': newWidth, margin: '0 auto'});
            } else {
                $('.inline-lightbox-container').css({'width': newWidth, margin: '0 auto'});
            }
            $('.inline-lightbox-container').css({'height': newHeight});

            // set img
            $('.inline-lightbox-element img').css({'max-height': newHeight, 'max-width': newWidth});

            

            if(!loaded) {
                $(window).resize(function() {
                    $.Gina.sizeColorBoxItem(!loaded);
                });
            } else {
                $.colorbox.resize({width: (newWidth + 63), height: (newHeight + 95)});
            }
            
        }

        $.Gina.sizeColorBoxItem();





        // // container width
        // if (mediaWidth > winW) {
        //     $('.inline-lightbox-container').css({'width': winW, margin: '0 17px'});
        //     withType = 'window';
        // } else {
        //     $('.inline-lightbox-container').css({'width': mediaWidth, margin: 0});
        // }
        // // container height
        // if (mediaHeight > winH) {
        //     if (withType == 'window') {
        //         var newHeight = ((mediaHeight / mediaWidth) * winW);
        //         if (newHeight < winH) {
        //             // adjust height in proportion to with
        //             $('.inline-lightbox-container').css({'height': newHeight});
        //         } else {
        //             $('.inline-lightbox-container').css({'height': winH});
        //         }
        //     } else {
        //         $('.inline-lightbox-container').css({'height': winH});
        //     }
        // } else {
        //     $('.inline-lightbox-container').css({'height': mediaHeight});
        // }

    });
</script>
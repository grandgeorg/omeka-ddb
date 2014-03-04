<?php
$containerMinWidth = 280;
$containerMinHeight = 100;
$width = 0; $height = 0;
$files = $item->getFiles();
$countFiles = count($files);
$additionalWrapperOpen = '';
$additionalWrapperClose = '';
$wrapperAttributes = array('class'=>'inline-lightbox-element');
foreach ($files as $file) {
    if (isset($file->metadata)) {
        $metadata = json_decode($file->metadata);
        // var_dump($metadata);
        if (isset($metadata->video->resolution_x) && 
            $metadata->video->resolution_x > $width) {

            $width = $metadata->video->resolution_x;
        } else {
            $width = 280;
        }
        if (isset($metadata->video->resolution_y) && 
            $metadata->video->resolution_y > 0) {

            $height = $height + $metadata->video->resolution_y;
        } else {
            $height = 100;
        }
        if (isset($metadata->mime_type) && 
            ($metadata->mime_type == 'audio/mpeg' || 
                $metadata->mime_type == 'application/ogg')) {
                $additionalWrapperOpen = '<audio controls>';
                $additionalWrapperClose = '</audio>';
                $wrapperAttributes = array();
                $width = 540;
        }
    }
}
// Video
$embedVideo = '';
$videoWidth = 0;
$videoHeight = 0;
$metaDataVideoSource = metadata($item, array('Item Type Metadata', 'Videoquelle'));
if (!empty($metaDataVideoSource)) {
    $embedVideo = ExhibitDdbHelper::getVideoFromShortcode($metaDataVideoSource);
    if (!empty($embedVideo) && !empty(ExhibitDdbHelper::$videoVimeoInfo)) {
        $containerMinWidth = 500;
        $containerMinHeight = 281;
        $videoInfo = ExhibitDdbHelper::$videoVimeoInfo;
        if(isset($videoInfo[0]['width']) && !empty($videoInfo[0]['width'])) {
            $videoWidth = $videoInfo[0]['width'];
        }
        if(isset($videoInfo[0]['height']) && !empty($videoInfo[0]['height'])) {
            $videoHeight = $videoInfo[0]['height'];
        }
    }
}
?>
<div class="inline-lightbox-container" style="min-width: <?php echo $containerMinWidth; ?>px; min-height: <?php echo $containerMinHeight; ?>px;">
<?php echo $embedVideo; ?>
<?php echo $additionalWrapperOpen; ?>
<?php echo files_for_item(
    array('imageSize' => 'fullsize', 'linkToFile' => true), 
    $wrapperAttributes); ?>
<?php echo $additionalWrapperClose; ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $.Gina.sizeColorBoxItem = function(loaded) {

            var mediaWidth = <?php echo $width; ?>;
            var mediaHeight = <?php echo $height; ?>;
            var countFiles =  <?php echo $countFiles; ?>;
            var withType = '';
            var newHeight = 0;
            var newWidth = 0;
            var checkWidth = 0;
            var videoWidth = <?php echo $videoWidth; ?>;
            var videoHeight = <?php echo $videoHeight; ?>;


            // check if we have video media
            if (0 == mediaWidth && 0 == mediaHeight && 0 < videoWidth && 0 < videoHeight) {
                mediaWidth = videoWidth;
                mediaHeight = videoHeight;
            }

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

            // set img & extarnal media
            if ($('.inline-lightbox-element img').get(0)) {
                $('.inline-lightbox-element img').css({'max-height': newHeight, 'max-width': newWidth});
            }
            if ($('.inline-lightbox-container iframe').get(0)) {
                $('.inline-lightbox-container iframe').attr({'width': newWidth, 'height' : newHeight});
                // $('.inline-lightbox-container iframe')[0].setAttribute({'width': newWidth, 'height' : newHeight});
            }

            if(!loaded) {
                $(window).resize(function() {
                    $.Gina.sizeColorBoxItem(!loaded);
                });
            } else {
                $.colorbox.resize({width: (newWidth + 63), height: (newHeight + 95)});
            }
            
        }
        $.Gina.sizeColorBoxItem();
    });
</script>
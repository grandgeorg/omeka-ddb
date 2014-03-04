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
$embedVideo = '';
$videoWidth = 0;
$videoHeight = 0;
$itemMetaIdentifier = metadata($item, array('Dublin Core', 'Identifier'));
    switch (true) {
        case (false !== stristr($itemMetaIdentifier, 'vimeo:')):
            $videoId = substr($itemMetaIdentifier, 6);
            $containerMinWidth = 500;
            $containerMinHeight = 281;
            $embedVideo = '<iframe src="//player.vimeo.com/video/' . $videoId . '?portrait=0&amp;byline=0&amp;color=E6183C" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
            // . '<p><a href="http://vimeo.com/' . $videoId . '">' . metadata($item, array('Dublin Core', 'Title'))  . '</a>';
            // $videoInfo = unserialize(file_get_contents('http://vimeo.com/api/v2/video/' . $videoId . '.php'));

            // create curl resource
            $ch = curl_init();

            // set url
            curl_setopt($ch, CURLOPT_URL, 'http://vimeo.com/api/v2/video/' . $videoId . '.php');

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // $output contains the output string
            $videoInfo = unserialize(curl_exec($ch));

            // close curl resource to free up system resources
            curl_close($ch); 

            // var_dump($videoInfo);
            if(isset($videoInfo[0]['width']) && !empty($videoInfo[0]['width'])) {
                $videoWidth = $videoInfo[0]['width'];
            }
            if(isset($videoInfo[0]['height']) && !empty($videoInfo[0]['height'])) {
                $videoHeight = $videoInfo[0]['height'];
            }
            break;
        
        default:
            break;
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

            // if (loaded) {
            //     $.Gina.setWindowSizes();
            // }

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
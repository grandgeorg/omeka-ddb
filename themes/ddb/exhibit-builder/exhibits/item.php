<?php
$width = 0; $height = 0;
$files = $item->getFiles();
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
        var mediaWidth = <?php echo $width; ?>;
        var mediaHeight = <?php echo $height; ?>;
        var setWidth = '';
        $('.inline-lightbox-element img').css({'max-height': winH, 'max-width': winW});
        if (mediaWidth > winW) {
            $('.inline-lightbox-container').css({'width': winW, margin: '0 17px'});
            setWidth = 'window';
        } else {
            $('.inline-lightbox-container').css({'width': mediaWidth, margin: 0});
        }
        if (mediaHeight > winH) {
            if (setWidth == 'window') {
                var newHeight = ((mediaHeight / mediaWidth) * winW);
                if (newHeight < winH) {
                    $('.inline-lightbox-container').css({'height': newHeight});
                } else {
                    $('.inline-lightbox-container').css({'height': winH});
                }
            } else {
                $('.inline-lightbox-container').css({'height': winH});
            }
            // console.log('winh' + winH);
        } else {
            $('.inline-lightbox-container').css({'height': mediaHeight});
        }
        // $.colorbox.resize();
    });
</script>
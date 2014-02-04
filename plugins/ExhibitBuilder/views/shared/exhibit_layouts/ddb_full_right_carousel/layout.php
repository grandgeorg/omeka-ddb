<?php
// foreach (loop('files', $item->Files) as $file):
// if ( ($file->hasThumbnail()){

//      $caption = (metadata($file,array('Dublin Core', 'Title'))) ? '<strong>'.metadata($file, array('Dublin Core', 'Title')).'</strong>' : '';

//      file_markup($file, array('imageSize'=>'fullsize', 'linkToFile'=>'fullsize','linkAttributes'=>array('rel'=>'fancy_group', 'class'=>'fancyitem','title' => metadata('Item',array('Dublin Core', 'Title')),'caption'=>$caption)),array('class' => 'square_thumbnail'));
// }
// endforeach;


/******
* defined vars:
*    - exhibitPage
*******/

/******
* get exhibit from db (i.e. for  exhibit slug):
* Bad example as db has already been queried: $exhibit = get_db()->getTable('Exhibit')->find($exhibitPage->exhibit_id);
* Better: $exhibit = $exhibitPage->getExhibit();
*******/

?>

<div class="gallery-full-left">
    <?php 
    // $attachment = exhibit_builder_page_attachment(1);
    // $file = $attachment['file'];
    // var_dump($file, $attachment);
    // var_dump($fileMeta, $attMeta, $attachment['caption']);
     ?>
    <div class="tertiary">
    <?php 
    $exhibit = $exhibitPage->getExhibit();
    if (isset($exhibit->banner) && !empty($exhibit->banner) && 
        file_exists(FILES_DIR . '/layout/' . $exhibit->banner)): ?>
        <img src="<?php echo substr(FILES_DIR, strlen(BASE_DIR)) . '/layout/' . $exhibit->banner; ?>" alt="<?php echo $exhibit->banner; ?>">
    <?php endif; ?>
    <?php if (isset($exhibit->widget) && !empty($exhibit->widget)): ?>
        <div class="ddb-omeka-exhibit-widget"><?php echo $exhibit->widget; ?></div>
    <?php endif; ?>
    </div>
    <div class="secondary">
        <?php 
        /* handle main image */
        if ($attachment = exhibit_builder_page_attachment(1)) {
            $file = $attachment['file'];
            $attachmentTitle = '';
            $attachmentTitleFromCaption = strip_tags($attachment['caption']);
            $attachmentTitleFromObject = strip_tags(metadata($attachment['item'], array('Dublin Core', 'Title')));
            $attachmentTitleFromFile = strip_tags(metadata($file, array('Dublin Core', 'Title')));
            if (!empty($attachmentTitleFromCaption)) {
                $attachmentTitle = $attachmentTitleFromCaption;
            } elseif(!empty($attachmentTitleFromObject)) {
                $attachmentTitle = $attachmentTitleFromObject;
            } elseif (!empty($attachmentTitleFromFile)) {
                $attachmentTitle = $attachmentTitleFromFile;
            }
            $attachmentRights = '';
            $attachmentRightsFromObject = strip_tags(metadata($attachment['item'], array('Dublin Core', 'Rights')));
            $attachmentRightsFromFile = strip_tags(metadata($file, array('Dublin Core', 'Rights')));
            if(!empty($attachmentRightsFromObject)) {
                $attachmentRights = $attachmentRightsFromObject;
            } elseif (!empty($attachmentRightsFromFile)) {
                $attachmentRights = $attachmentRightsFromFile;
            }

            // Source 
            $attachmenLinkText = '';
            $attachmenLinkTitle = '';
            $attachmenLinkUrl = '';
            $attachmenLinkTextFromObject = strip_tags(metadata($attachment['item'], array('Dublin Core', 'Source')));
            $attachmenLinkTextFromFile = strip_tags(metadata($file, array('Dublin Core', 'Source')));
            if(!empty($attachmenLinkTextFromObject)) {
                $attachmenLinkText = $attachmenLinkTextFromObject;
            } elseif (!empty($attachmenLinkTextFromFile)) {
                $attachmenLinkText = $attachmenLinkTextFromFile;
            }

            if (1 === preg_match('@title="([^"]*)@', 
                metadata($attachment['item'], array('Dublin Core', 'Source')), $attachmenLinkTitleFromObject)) {
                $attachmenLinkTitle = $attachmenLinkTitleFromObject[1];
            } elseif (1 === preg_match('@title="([^"]*)@', 
                metadata($file, array('Dublin Core', 'Source')), $attachmenLinkTitleFromFile)) {
                $attachmenLinkTitle = $attachmenLinkTitleFromFile[1];
            }

            if (1 === preg_match('@href="([^"]*)@', 
                metadata($attachment['item'], array('Dublin Core', 'Source')), $attachmenLinkUrlFromObject)) {
                $attachmenLinkUrl = $attachmenLinkUrlFromObject[1];
            } elseif (1 === preg_match('@href="([^"]*)@', 
                metadata($file, array('Dublin Core', 'Source')), $attachmenLinkUrlFromFile)) {
                $attachmenLinkUrl = $attachmenLinkUrlFromFile[1];
            }

        ?>
        <div class="exhibit-item ddb-omeka-gallery ddb-omeka-main-exhibit-item">
            <?php 
            if (1 != 1 && count($attachment{'item'}->getFiles()) == 1) {
                // There is only one file attached to the object
                $metadata = json_decode($file->metadata);
                if (isset($metadata->mime_type) && substr($metadata->mime_type, 0, 5) == 'image') {
                    // The file is an image, so link to the fullsize image
                    echo files_for_item(array(
                        'imageSize' => 'fullsize', 
                        'linkToFile' => true,
                        'linkAttributes'=>array(
                            // 'rel'=>'ddb-omeka-gallery-1',
                            'data-title' => $attachmentTitle,
                            'data-linktext' => $attachmenLinkText,
                            'data-linkurl' => $attachmenLinkUrl,
                            'data-linktitle' => $attachmenLinkTitle,
                            'data-copyright' => $attachmentRights
                    )), array('class'=>'permalink'), $attachment['item']); 
                }
            } else {
                echo exhibit_builder_attachment_markup(
                    $attachment, 
                    array(
                        'imageSize' => 'fullsize', 
                        'linkAttributes'=>array(
                            // 'rel'=>'ddb-omeka-gallery-1',
                            'data-title' => $attachmentTitle,
                            'data-linktext' => $attachmenLinkText,
                            'data-linkurl' => $attachmenLinkUrl,
                            'data-linktitle' => $attachmenLinkTitle,
                            'data-copyright' => $attachmentRights
                    )), 
                    array('class' => 'permalink'));
            }
            ?>
        </div>
        <?php } ?>
        <div id="thumbnail-gallery-carousel-elements">
            <div id="ddb-omeka-carousel-gallery_next" class="ddb-omeka-carousel-gallery-controlls">
                <!-- <img src="/themes/ddb/images/carousel-arrow-right.png"> -->
            </div>
            <div id="ddb-omeka-carousel-gallery_prev" class="ddb-omeka-carousel-gallery-controlls">
                <!-- <img src="/themes/ddb/images/carousel-arrow-left.png"> -->
            </div>
            <div id="thumbnail-gallery-carousel-container">
                <div class="gallery ddb-omeka-gallery" id="thumbnail-gallery-carousel-wrapper">
                    <?php echo ddb_exhibit_builder_thumbnail_gallery(2, 12, array('class'=>'permalink'), 'square_thumbnail'); ?>
                </div>
            </div>
        </div>


        <?php if ($text = exhibit_builder_page_text(2)):?>
        <div class="exhibit-text">
            <?php echo $text; ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="primary">
        <?php if ($text = exhibit_builder_page_text(1)):?>
        <div class="exhibit-text">
            <?php echo $text; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php if ($text = exhibit_builder_page_text(3)):?>
<div class="ddb-omkeka-subtitle"><?php echo $text; ?></div>
<?php endif; ?>
<?php if ($text = exhibit_builder_page_text(4)):?>
<div class="ddb-omeka-two-col"><?php echo $text; ?></div>
<?php endif; ?>
<?php if ($text = exhibit_builder_page_text(5)):?>
<div class="ddb-omkeka-subtitle"><?php echo $text; ?></div>
<?php endif; ?>
<?php if ($text = exhibit_builder_page_text(6)):?>
<div class="ddb-omeka-two-col"><?php echo $text; ?></div>
<?php endif; ?>
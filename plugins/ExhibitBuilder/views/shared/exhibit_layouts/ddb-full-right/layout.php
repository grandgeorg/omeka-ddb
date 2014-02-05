<?php
// foreach (loop('files', $item->Files) as $file):
//     if ( ($file->hasThumbnail()){
//          $caption = (metadata($file,array('Dublin Core', 'Title'))) ? 
//             '<strong>'.metadata($file, array('Dublin Core', 'Title')).'</strong>' : '';
//          file_markup($file, array('imageSize'=>'fullsize', 'linkToFile'=>'fullsize',
//             'linkAttributes'=>array('rel'=>'fancy_group', 'class'=>'fancyitem',
//             'title' => metadata('Item',array('Dublin Core', 'Title')),'caption'=>$caption)),
//             array('class' => 'square_thumbnail'));
//     }
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

/******
// $attachment = exhibit_builder_page_attachment(1);
// $file = $attachment['file'];
// var_dump($file, $attachment);
// var_dump($fileMeta, $attMeta, $attachment['caption']);
*******/
?>
<div class="gallery-full-left omeka-exhibit-content-wrapper clearfix">
    <div class="secondary">
        <?php if ($attachment = exhibit_builder_page_attachment(1)): ?>
        <div class="exhibit-item ddb-omeka-gallery ddb-omeka-main-exhibit-item">
            <?php echo ddb_exhibit_builder_attachment_markup($attachment); ?>
        </div>
        <?php endif; ?>
        <div class="gallery ddb-omeka-gallery">
            <?php echo ddb_exhibit_builder_thumbnail_gallery(2, 12,
                array('class'=>'permalink'), 'square_thumbnail'); ?>
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
    <div class="tertiary">
        <?php $exhibit = $exhibitPage->getExhibit();
        if (isset($exhibit->banner) && !empty($exhibit->banner) && 
            file_exists(FILES_DIR . '/layout/' . $exhibit->banner)): ?>
        <img src="<?php echo substr(FILES_DIR, strlen(BASE_DIR)) . '/layout/' 
            . $exhibit->banner; ?>" alt="<?php echo $exhibit->banner; ?>">
        <?php endif; ?>
        <?php if (isset($exhibit->widget) && !empty($exhibit->widget)): ?>
        <div class="ddb-omeka-exhibit-widget"><?php echo $exhibit->widget; ?></div>
        <?php endif; ?>
    </div>
</div>
<?php if ($text = exhibit_builder_page_text(3)):?>
<div class="ddb-omeka-subtitle"><?php echo $text; ?></div>
<?php endif; ?>
<?php if ($text = exhibit_builder_page_text(4)):?>
<div class="ddb-omeka-two-col"><?php echo $text; ?></div>
<?php endif; ?>
<?php if ($text = exhibit_builder_page_text(5)):?>
<div class="ddb-omeka-subtitle"><?php echo $text; ?></div>
<?php endif; ?>
<?php if ($text = exhibit_builder_page_text(6)):?>
<div class="ddb-omeka-two-col"><?php echo $text; ?></div>
<?php endif; ?>
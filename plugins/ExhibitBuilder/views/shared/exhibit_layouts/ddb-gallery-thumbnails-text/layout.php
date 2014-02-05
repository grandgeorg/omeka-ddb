<div class="gallery-full-left omeka-exhibit-content-wrapper clearfix">
    <?php if ($text = exhibit_builder_page_text(1)):?>
    <div class="ddb-omeka-two-col"><?php echo $text; ?></div>
    <?php endif; ?>
    <div class="ddb-omeka-cover-two-col">
        <div class="gallery ddb-omeka-gallery">
            <?php echo ddb_exhibit_builder_thumbnail_gallery(1, 18,
                array('class'=>'permalink'), 'square_thumbnail'); ?>
        </div>
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
<?php if ($text = exhibit_builder_page_text(2)):?>
<div class="ddb-omeka-subtitle"><?php echo $text; ?></div>
<?php endif; ?>
<?php if ($text = exhibit_builder_page_text(3)):?>
<div class="ddb-omeka-two-col"><?php echo $text; ?></div>
<?php endif; ?>
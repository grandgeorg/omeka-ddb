<div class="gallery-full-left omeka-exhibit-content-wrapper clearfix">
    <div class="secondary">
        <div class="ddb-omeka-gallery-large-size ddb-omeka-gallery">
        <!-- <div class="exhibit-item  ddb-omeka-main-exhibit-item"> -->
            <?php for ($i=1; $i < 9; $i++): ?>
            <?php if ($attachment = exhibit_builder_page_attachment($i)): ?>
            <?php echo ddb_exhibit_builder_attachment_markup($attachment); ?>
            <?php endif; ?>
            <?php endfor; ?>
        <!-- </div> -->
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
            file_exists(FILES_DIR . '/layout/banner/' . $exhibit->banner)): ?>
        <img src="<?php echo substr(FILES_DIR, strlen(BASE_DIR)) . '/layout/banner/' 
            . $exhibit->banner; ?>" alt="<?php echo $exhibit->banner; ?>">
        <?php endif; ?>
        <?php if (isset($exhibitPage->widget) && !empty($exhibitPage->widget)): ?>
        <div class="ddb-omeka-exhibit-widget"><?php echo $exhibitPage->widget; ?></div>
        <?php endif; ?>
        <?php if (isset($exhibit->widget) && !empty($exhibit->widget)): ?>
        <div class="ddb-omeka-exhibit-widget"><?php echo $exhibit->widget; ?></div>
        <?php endif; ?>
    </div>
</div>
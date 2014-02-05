<div class="image-list-left omeka-exhibit-content-wrapper clearfix">
    <?php 
    for ($i = 1; $i <= 8; $i++):
    $text = exhibit_builder_page_text($i);
    $attachment = exhibit_builder_page_attachment($i);
    if ($attachment || $text): ?>
    <div class="ddb-omeka-col-container">
    <?php if ($attachment): ?>
    <div class="primary">
        <div class="exhibit-item ddb-omeka-gallery ddb-omeka-main-exhibit-item">
            <?php echo ddb_exhibit_builder_attachment_markup($attachment); ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if ($text): ?>
    <div class="secondary">
        <div class="exhibit-text">
            <?php echo $text; ?>
        </div>
    </div>
    <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php endfor; ?>
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
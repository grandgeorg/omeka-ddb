<div class="omeka-exhibit-content-wrapper clearfix">
    <div class="ddb-omeka-two-col-wrapper">
        <?php 
        for ($i = 1; $i <= 8; $i++):
        $text = exhibit_builder_page_text($i);
        $attachment = exhibit_builder_page_attachment($i);
        if ($attachment || $text): ?>
        <div class="ddb-omeka-col-container">
        <div class="primary">
        <?php if ($attachment): ?>
            <div class="exhibit-item ddb-omeka-gallery ddb-omeka-main-exhibit-item">
                <?php echo ddb_exhibit_builder_attachment_markup($attachment); ?>
            </div>
        <?php endif; ?>
        </div>
        <div class="secondary">
        <?php if ($text): ?>
            <div class="exhibit-text">
                <?php echo $text; ?>
            </div>
        <?php endif; ?>
        </div>
        </div>
        <?php endif; ?>
        <?php endfor; ?>
    </div>
    <div class="tertiary">
        <?php $exhibit = $exhibitPage->getExhibit();
        if (isset($exhibit->banner) && !empty($exhibit->banner) && 
            file_exists(FILES_DIR . '/layout/banner/' . $exhibit->banner)): ?>
        <img src="<?php echo substr(FILES_DIR, strlen(BASE_DIR)) . '/layout/banner/' 
            . $exhibit->banner; ?>" alt="exihibition banner" class="exhibition-banner">
        <?php endif; ?>
        <?php if (isset($exhibitPage->widget) && !empty($exhibitPage->widget)): ?>
        <div class="ddb-omeka-exhibit-widget"><?php echo $exhibitPage->widget; ?></div>
        <?php endif; ?>
        <?php if (isset($exhibit->widget) && !empty($exhibit->widget)): ?>
        <div class="ddb-omeka-exhibit-widget"><?php echo $exhibit->widget; ?></div>
        <?php endif; ?>
    </div>
</div>
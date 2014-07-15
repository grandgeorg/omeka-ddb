<?php
$title = __('Exhibits');
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
?>
<h1><?php echo $title; ?> <?php // echo __('(%s total)', $total_results); ?></h1>
<?php if (count($exhibits) > 0): ?>

<!-- <nav class="navigation secondary-nav">
    <?php echo nav(array(
        array(
            'label' => __('Browse All'),
            'uri' => url('exhibits')
        ),
        array(
            'label' => __('Browse by Tag'),
            'uri' => url('exhibits/tags')
        )
    )); ?>
</nav> -->

<?php echo pagination_links(); ?>

<?php $exhibitCount = 0; ?>
<?php foreach (loop('exhibit') as $exhibit): ?>
    <?php if($exhibit->public == 1): ?>
    <?php $exhibitCount++; ?>
    <div class="ddb-omeka-exhibit-list exhibit <?php if ($exhibitCount%2==1) echo ' even'; else echo ' odd'; ?>">
        <?php if ($exhibit->cover): ?>
        <div class="ddb-omeka-exhibit-cover">
            <img alt="<?php echo $exhibit->cover; ?>" src="<?php echo WEB_FILES . '/layout/cover/' . $exhibit->cover; ?>">
        </div>
        <?php endif; ?>
        <div class="ddb-omeka-exhibit-info">
            <h2><?php echo link_to_exhibit(); ?></h2>
            <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
            <div class="description"><?php echo $exhibitDescription; ?></div>
            <?php endif; ?>
            <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
            <p class="tags"><?php echo $exhibitTags; ?></p>
        <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
<?php endforeach; ?>

<?php echo pagination_links(); ?>

<?php else: ?>
<p><?php echo __('There are no exhibits available yet.'); ?></p>
<?php endif; ?>

<?php echo foot(); ?>

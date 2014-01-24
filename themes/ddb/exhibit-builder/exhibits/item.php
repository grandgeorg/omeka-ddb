<html>
<head>
    <title><?php html_escape(__('Item #%s', $item->id)); ?></title>
    <link type="text/css" rel="stylesheet" media="all" href="/plugins/ExhibitBuilder/views/shared/exhibit_layouts/ddb_full_right/item.css">
</head>
<body>


<?php
// $title = html_escape(__('Item #%s', $item->id));
// echo head(array('title' => $title, 'bodyclass' => 'exhibits exhibit-item-show'));
// var_dump($item->getProperty('permalink'));
$myitem = get_current_record('item');
$myFiles = $myitem->Files;
foreach ($myFiles as $myFile) {
    $myFilename[] = $myFile->filename;
    echo '<img src="/files/original/' . $myFile->filename . '">';
    // echo $this->item_file('fullsize uri');
}
// var_dump($myFilename);
?>
<h1 class="item-title"><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>

<?php echo all_element_texts('item'); ?>

<div id="itemfiles">
    <?php // echo files_for_item(); ?>

</div>

<?php if (metadata('item', 'Collection Name')): ?>
    <div id="collection" class="field">
        <h2><?php echo __('Collection'); ?></h2>
        <div class="field-value"><p><?php echo link_to_collection_for_item(); ?></p></div>
    </div>
<?php endif; ?>

<?php if (metadata('item', 'has tags') && 1 != 1): ?>
  <div class="tags">
    <h2><?php echo __('Tags'); ?></h2>
   <?php echo tag_string('item'); ?>
</div>
<?php endif;?>

<!-- <div id="citation" class="field">
    <h2><?php echo __('Citation'); ?></h2>
    <p id="citation-value" class="field-value"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></p>
</div> -->
<?php // echo foot(); ?>
</body>
</html>
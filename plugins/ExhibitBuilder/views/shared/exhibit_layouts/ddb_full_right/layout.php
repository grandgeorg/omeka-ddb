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
    $attachment = exhibit_builder_page_attachment(1);
    // var_dump($attachment['file']->{'title'}, $attachment, $attachment['file']);
    $file = $attachment['file'];
    var_dump($file, $attachment);
    $attMeta =  metadata($attachment['item'], array('Dublin Core', 'Title'));
    $fileMeta =  metadata($file, array('Dublin Core', 'Title'));
    // $item = $this->_helper->db->findById($itemId, 'Item');
    var_dump($fileMeta, $attMeta);
     ?>
    <div class="tertiary">
        <img src="/themes/ddb/images/banner_moosgruen.jpg">
    </div>
    <div class="secondary">
        <?php if ($attachment = exhibit_builder_page_attachment(1)):?>
        <div class="exhibit-item ddb-omeka-gallery ddb-omeka-main-exhibit-item">
            <?php echo exhibit_builder_attachment_markup($attachment, 
                array(
                    'imageSize' => 'fullsize', 
                    'linkAttributes'=>array(
                        // 'rel'=>'ddb-omeka-gallery-1',
                        'data-title' => '',
                        'data-link' => '',
                        'data-copyright' => ''
                    )), 
                array('class' => 'permalink inline-lightbox-trigger')); ?>
        </div>
        <?php endif; ?>
        <div class="gallery ddb-omeka-gallery">
            <?php echo exhibit_builder_thumbnail_gallery(2, 12, array('class'=>'permalink'), 'square_thumbnail', array('rel'=>'ddb-omeka-gallery-1')); ?>
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

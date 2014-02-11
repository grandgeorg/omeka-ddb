<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits show'));
?>

<div class="ddb-omeka-exhibit-title"><a href="/">Ausstellungen</a>&nbsp;&nbsp;&nbsp;&gt;&nbsp;&nbsp;&nbsp;<span class="help-bc-active"><?php echo metadata('exhibit', 'title'); ?></span></div>

<nav id="exhibit-pages" class="exhibit-page-navigation-bar">
    <?php echo exhibit_builder_page_nav(); ?>
</nav>

<h1><span class="exhibit-page"><?php echo metadata('exhibit_page', 'title'); ?></span></h1>

<nav id="exhibit-child-pages">
    <?php echo exhibit_builder_child_page_nav(); ?>
</nav>

<?php exhibit_builder_render_exhibit_page(); ?>

<div id="exhibit-page-navigation" class="exhibit-page-prevnext-bar">
    <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
    <div id="exhibit-nav-prev">
    <?php echo str_replace(array('</a>', '&rarr;', '&larr;'), array('<span class="nav-icon-prev"></span></a>', '', ''), $prevLink); ?>
    </div>
    <?php endif; ?>
    <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
    <div id="exhibit-nav-next">
    <?php echo str_replace(array('</a>', '&rarr;', '&larr;'), array('<span class="nav-icon-next"></span></a>', '', ''), $nextLink); ?>
    </div>
    <?php endif; ?>
    <div id="exhibit-nav-up">
    <?php echo exhibit_builder_page_trail(); ?>
    </div>
</div>

<?php echo foot(); ?>

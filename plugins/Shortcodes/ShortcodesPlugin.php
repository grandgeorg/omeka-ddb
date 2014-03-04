<?php
/**
 * Shortcodes
 * 
 * @copyright Copyright 2014 Grandgeorg Websolutions
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * The Shortcodes plugin.
 * 
 * @package Omeka\Plugins\Shortcodes
 */
class ShortcodesPlugin extends Omeka_Plugin_AbstractPlugin
{
    
    const DEFAULT_SHORTCODES_ENABLE = 1;
    
    protected $_hooks = array(
        'install', 
        'uninstall', 
        'initialize', 
        'config_form', 
        'config', 
        'public_items_show', 
    );
    
    protected $_options = array(
        'shortcodes_enable' => self::DEFAULT_SHORTCODES_ENABLE
    );
    
    /**
     * Install the plugin.
     */
    public function hookInstall()
    {
        $this->_installOptions();
    }
   
    /**
     * Unnstall the plugin.
     */
    public function hookUninstall()
    {
        $this->_uninstallOptions();
    }
    
    
    /**
     * Initialize the plugin.
     */
    public function hookInitialize()
    {
        // Add translation.
        add_translation_source(dirname(__FILE__) . '/languages');
    }
    
    /**
     * Upgrade the plugin.
     */
    public function hookUpgrade($args)
    {
        // Version 2.0 introduced image viewer embed flags.
        if (version_compare($args['old_version'], '2.0', '<')) {
            set_option('zoomit_embed_admin', self::DEFAULT_VIEWER_EMBED);
            set_option('zoomit_embed_public', self::DEFAULT_VIEWER_EMBED);
        }
    }
    
    /**
     * Display the config form.
     */
    public function hookConfigForm()
    {
        echo get_view()->partial('plugins/zoomit-config-form.php');
    }
    
    /**
     * Handle the config form.
     */
    public function hookConfig()
    {
        if (!is_numeric($_POST['zoomit_width_admin']) || 
            !is_numeric($_POST['zoomit_height_admin']) || 
            !is_numeric($_POST['zoomit_width_public']) || 
            !is_numeric($_POST['zoomit_height_public'])) {
            throw new Omeka_Validate_Exception('The width and height must be numeric.');
        }
        set_option('zoomit_embed_admin', (int) (boolean) $_POST['zoomit_embed_admin']);
        set_option('zoomit_width_admin', $_POST['zoomit_width_admin']);
        set_option('zoomit_height_admin', $_POST['zoomit_height_admin']);
        set_option('zoomit_embed_public', (int) (boolean) $_POST['zoomit_embed_public']);
        set_option('zoomit_width_public', $_POST['zoomit_width_public']);
        set_option('zoomit_height_public', $_POST['zoomit_height_public']);
    }
    
    /**
     * Display the image viewer in admin items/show.
     */
    public function hookAdminItemsShow($args)
    {
        // Embed viewer only if configured to do so.
        if (!get_option('zoomit_embed_admin')) {
            return;
        }
        echo $args['view']->zoomit($args['item']->Files, 
                                   get_option('zoomit_width_admin'), 
                                   get_option('zoomit_height_admin'));
    }
    
    /**
     * Display the image viewer in public items/show.
     */
    public function hookPublicItemsShow($args)
    {
        // Embed viewer only if configured to do so.
        if (!get_option('zoomit_embed_public')) {
            return;
        }
        echo $args['view']->zoomit($args['item']->Files, 
                                   get_option('zoomit_width_public'), 
                                   get_option('zoomit_height_public'));
    }
}

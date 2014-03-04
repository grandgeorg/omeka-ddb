<?php
/**
 * Omeka Exhibit Extension and Helper for DDB - Deutsche Digitale Bibliothek
 * 
 * @copyright Copyright 2014 Viktor Grandgeorg, Grandgeorg Websolutions
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 * @author Viktor Grandgeorg, viktor@grandgeorg.de
 */

/**
 * ExhibitDdbHelper
 * 
 * @package Omeka\Plugins\ExhibitBuilder
 */
class ExhibitDdbHelper
{
    /**
     * Main shortcode parser
     * 
     * @param string String to parse for shortcodes
     * @return array shortcode matches
     **/
    public static function parseShortcode($subject) 
    {
        preg_match_all('|(\[\[)([^\]\:]+):([^\]]+)(\]\])|', $subject, $matches, PREG_SET_ORDER);
        return $matches;
    }

    public static function getVideoShortcode($item) 
    {

    }

    public static function getLicenseShortcode($licenseText) 
    {
        $licenses = array(
            'CC-BY' => array(
                'name' => 'Namensnennung',
                'link' => 'http://creativecommons.org/licenses/by/3.0/de/', 
                'icon' => '<i class="license license-by"> </i>'
            ),
            'CC-BY-ND' => array(
                'name' => 'Namensnennung - Keine Bearbeitung',
                'link' => 'http://creativecommons.org/licenses/by-nd/3.0/de/', 
                'icon' => '<i class="license license-by"> </i><i class="license license-nd"> </i>'
            ),
            'CC-BY-NC' => array(
                'name' => 'Namensnennung - Nicht kommerziell',
                'link' => 'http://creativecommons.org/licenses/by-nc/3.0/de/', 
                'icon' => '<i class="license license-by"> </i><i class="license license-nc"> </i>'
            ),
            'CC-BY-NC-ND' => array(
                'name' => 'Namensnennung - Nicht kommerziell - Keine Bearbeitung',
                'link' => 'http://creativecommons.org/licenses/by-nc-nd/3.0/de/', 
                'icon' => '<i class="license license-by"> </i><i class="license license-nc"> </i><i class="license license-nd"> </i>'
            ),
            'CC-BY-NC-SA' => array(
                'name' => 'Namensnennung - Nicht kommerziell - Weitergabe unter gleichen Bedingungen',
                'link' => 'http://creativecommons.org/licenses/by-nc-sa/3.0/de/', 
                'icon' => '<i class="license license-by"> </i><i class="license license-nc"> </i><i class="license license-sa"> </i>'
            ),
            'CC-BY-SA' => array(
                'name' => 'Namensnennung - Weitergabe unter gleichen Bedingungen',
                'link' => 'http://creativecommons.org/licenses/by-sa/3.0/de/', 
                'icon' => '<i class="license license-by"> </i><i class="license license-sa"> </i>'
            ),
            'CC-PDM1' => array(
                'name' => 'Public Domain Marke 1.0  - Weltweit frei von bekannten urheberrechtlichen Einschränkungen',
                'link' => 'http://creativecommons.org/publicdomain/mark/1.0/deed.de', 
                'icon' => '<i class="license license-pd"> </i>'
            ),
            'CC-PD-M1' => array(
                'name' => 'Public Domain Marke 1.0  - Weltweit frei von bekannten urheberrechtlichen Einschränkungen',
                'link' => 'http://creativecommons.org/publicdomain/mark/1.0/deed.de', 
                'icon' => '<i class="license license-pd"> </i>'
            ),
            'CC-PDU1' => array(
                'name' => 'CC0 Public Domain Dedication - Inhalt wurde in die Gemeinfreiheit, auch genannt Public Domain, entlassen',
                'link' => 'http://creativecommons.org/publicdomain/zero/1.0/deed.de', 
                'icon' => '<i class="license license-pdzero"> </i>'
            ),
            'CC-PD-U1' => array(
                'name' => 'CC0 Public Domain Dedication - Inhalt wurde in die Gemeinfreiheit, auch genannt Public Domain, entlassen',
                'link' => 'http://creativecommons.org/publicdomain/zero/1.0/deed.de', 
                'icon' => '<i class="license license-pdzero"> </i>'
            ),
            'G-RR-AF' => array(
                'name' => 'Rechte vorbehalten - Freier Zugang',
                'link' => 'https://www.deutsche-digitale-bibliothek.de/content/lizenzen/rv-fz/', 
                'icon' => '<i class="license license-rr"> </i>'
                ),
            'G-RR-AP' => array(
                'name' => 'Rechte vorbehalten - Zugang nach Zahlung einer Gebühr',
                'link' => 'https://www.deutsche-digitale-bibliothek.de/content/lizenzen/rv-bz/', 
                'icon' => '<i class="license license-rr"> </i>'
                ),
            'G-RR-AA' => array(
                'name' => 'Rechte vorbehalten - Zugang nach Autorisierung',
                'link' => 'https://www.deutsche-digitale-bibliothek.de/content/lizenzen/rv-ez/', 
                'icon' => '<i class="license license-rr"> </i>'
                ),
            'G-NA' => array(
                'name' => 'Rechtsstatus unbekannt',
                'link' => 'https://www.deutsche-digitale-bibliothek.de/content/lizenzen/unbekannt/', 
                'icon' => ''
                )
            );

        $output = '';
        $matches = self::parseShortcode($licenseText);
        // var_dump($matches);
        $matchesSize = count($matches);
        for ($i=0; $i < $matchesSize; $i++) { 
            if (isset($matches[$i][2]) && 'license' == $matches[$i][2] && isset($licenses[$matches[$i][3]])) {
                $output .= '<a tagrt="_blank" href="' 
                    . $licenses[$matches[$i][3]]['link'] . '" title="' 
                    . $licenses[$matches[$i][3]]['name'] . '">' 
                    . $licenses[$matches[$i][3]]['icon'] . '<br style="clear:both;"">'
                    . $licenses[$matches[$i][3]]['name'] . '</a>';
            }
        }
        if (0 == $matchesSize && !empty($licenseText)) {
            $output = strip_tags($licenseText);
        }
        return $output;
    }


    public static function getItemTitle($attachment, $file)
    {
        $attachmentTitle = strip_tags($attachment['caption']);
        if (null !== $attachment['item'] && empty($attachmentTitle)) {
            $attachmentTitle = strip_tags(metadata($attachment['item'], 
                array('Item Type Metadata', 'Titel')));
        }
        if (null !== $attachment['item'] && empty($attachmentTitle)) {
            $attachmentTitle = strip_tags(metadata($attachment['item'], 
                array('Dublin Core', 'Title')));
        }
        if (null !== $file  && empty($attachmentTitle)) {
            $attachmentTitle = strip_tags(metadata($file, 
                array('Dublin Core', 'Title')));
        }
        return $attachmentTitle;
    }

    public static function getItemSubtitle($attachment, $file)
    {
        $attachmentSubtitle = '';
        if (null !== $attachment['item']) {
            $attachmentSubtitle = strip_tags(metadata($attachment['item'], 
                array('Item Type Metadata', 'Weiterer Titel')));
        }
        return $attachmentSubtitle;
    }

    public static function getItemDescription($attachment, $file)
    {
        $attachmentDescription = '';
        if (null !== $attachment['item']) {
            $attachmentDescription = strip_tags(metadata($attachment['item'], 
                array('Item Type Metadata', 'Beschreibung')));
        }
        if (null !== $attachment['item'] && empty($attachmentDescription)) {
            $attachmentDescription = strip_tags(metadata($attachment['item'], 
                array('Dublin Core', 'Description')));
        }
        if (null !== $file && empty($attachmentDescription)) {
            $attachmentDescription = strip_tags(metadata($file, 
                array('Dublin Core', 'Description')));
        }
        return $attachmentDescription;
    }

    public static function getItemRights($attachment, $file)
    {
        $attachmentRights = '';
        if (null !== $attachment['item']) {
            $attachmentRights = strip_tags(metadata($attachment['item'], 
                array('Item Type Metadata', 'Rechtsstatus')));
        }
        if (null !== $attachment['item'] && empty($attachmentRights)) {
            $attachmentRights = strip_tags(metadata($attachment['item'], 
                array('Dublin Core', 'Rights')));
        }
        if (null !== $file && empty($attachmentRights)) {
            $attachmentRights = strip_tags(metadata($file, 
                array('Dublin Core', 'Rights')));
        }
        return self::getLicenseShortcode($attachmentRights);
    }

    public static function getItemLinkText($attachment, $file)
    {
        $attachmenLinkText = '';
        if (null !== $attachment['item']) {
            $attachmenLinkText = strip_tags(metadata($attachment['item'], 
                array('Item Type Metadata', 'Link zum Objekt')));
        }
        if (null !== $attachment['item'] && empty($attachmenLinkText)) {
            $attachmenLinkText = strip_tags(metadata($attachment['item'], 
                array('Item Type Metadata', 'Link zum Objekt bei der datenliefernden Einrichtung')));
        }

        if (null !== $attachment['item'] && empty($attachmenLinkText)) {
            $attachmenLinkText = strip_tags(metadata($attachment['item'], 
                array('Dublin Core', 'Source')));
        }
        if (null !== $file && empty($attachmenLinkText)) {
            $attachmenLinkText = strip_tags(metadata($file, 
                array('Dublin Core', 'Source')));
        }
        return $attachmenLinkText;
    }

    public static function getItemLinkTitle($attachment, $file)
    {
        $attachmenLinkTitle = '';
        if (null !== $attachment['item'] && 1 === preg_match('@title="([^"]*)@', 
            metadata($attachment['item'], array('Item Type Metadata', 'Link zum Objekt')), 
                $matches)) {
            $attachmenLinkTitle = $matches[1];
        }
        if (null !== $attachment['item'] && empty($attachmenLinkTitle) && 
            1 === preg_match('@title="([^"]*)@', metadata($attachment['item'], 
                array('Item Type Metadata', 'Link zum Objekt bei der datenliefernden Einrichtung')), 
                $matches)) {
            $attachmenLinkTitle = $matches[1];
        }
        if (null !== $attachment['item'] && empty($attachmenLinkTitle) && 
            1 === preg_match('@title="([^"]*)@', metadata($attachment['item'], 
                array('Dublin Core', 'Source')), $matches)) {
            $attachmenLinkTitle = $matches[1];
        }
        if (null !== $file && empty($attachmenLinkTitle) && 1 === preg_match('@title="([^"]*)@', 
            metadata($file, array('Dublin Core', 'Source')), $matches)) {
            $attachmenLinkTitle = $matches[1];
        }
        return $attachmenLinkTitle;
    }

    public static function getItemLinkUrl($attachment, $file)
    {
        $attachmenLinkUrl = '';
        if (null !== $attachment['item'] && 1 === preg_match('@href="([^"]*)@', 
            metadata($attachment['item'], array('Item Type Metadata', 'Link zum Objekt')), 
                $matches)) {
            $attachmenLinkUrl = $matches[1];
        }
        if (null !== $attachment['item'] && empty($attachmenLinkUrl) && 
            1 === preg_match('@href="([^"]*)@', metadata($attachment['item'], 
                array('Item Type Metadata', 'Link zum Objekt bei der datenliefernden Einrichtung')), 
                $matches)) {
            $attachmenLinkUrl = $matches[1];
        } 
        if (null !== $file && empty($attachmenLinkUrl) && 1 === preg_match('@href="([^"]*)@', 
            metadata($file, array('Dublin Core', 'Source')), $matches)) {
            $attachmenLinkUrl = $matches[1];
        } else {
            $attachmenLinkUrl = record_url($attachment['item'], 'show', false);
        }
        return $attachmenLinkUrl;
    }

    public static function getThumbnailGallery($start, $end, $props = array(), 
        $thumbnailType = 'square_thumbnail', $linkOptions = array())
    {

        $html = '';
        $colCount = 0;
        for ($i = (int)$start; $i <= (int)$end; $i++) {
            $colCount++;
            if ($attachment = exhibit_builder_page_attachment($i)) {

                if (($colCount % 3) === 0) {
                    $addExhibitItemClass = ' last-item-in-line';
                } else {
                    $addExhibitItemClass = '';                
                }
                $html .= "\n" . '<div class="exhibit-item' . $addExhibitItemClass . '">';

                if ($attachment['file']) {
                    $file = $attachment['file'];

                    // title
                    $attachmentTitle = self::getItemTitle($attachment, $file);

                    // subtitle
                    $attachmentSubtitle = self::getItemSubtitle($attachment, $file);

                    // description
                    $attachmentDescription = self::getItemDescription($attachment, $file);

                    // rights
                    $attachmentRights = self::getItemRights($attachment, $file);

                    // Source 
                    // link text
                    $attachmenLinkText = self::getItemLinkText($attachment, $file);

                    // link title
                    $attachmenLinkTitle = self::getItemLinkTitle($attachment, $file);
                    if (empty($attachmenLinkTitle)) {
                        $attachmenLinkTitle = $attachmentTitle;
                    }

                    // link url
                    $attachmenLinkUrl = self::getItemLinkUrl($attachment, $file);

                    $currentLinkOptions = array();
                    $currentLinkOptions = array_merge($linkOptions, array(
                        'data-title' => $attachmentTitle,
                        'data-subtitle' => $attachmentSubtitle,
                        'data-description' => $attachmentDescription,
                        'data-linktext' => $attachmenLinkText,
                        'data-linkurl' => $attachmenLinkUrl,
                        'data-linktitle' => $attachmenLinkTitle,
                        'data-copyright' => $attachmentRights,
                        'title' => $attachmentTitle,
                        'alt' => $attachmentTitle
                        ));
                    $thumbnail = file_image($thumbnailType, $props, $attachment['file']);
                    $html .= exhibit_builder_link_to_exhibit_item($thumbnail, $currentLinkOptions, $attachment['item']);

                } elseif(metadata($attachment['item'], array('Dublin Core', 'Identifier'))) {

                    $itemMetaIdentifier = metadata($attachment['item'], array('Dublin Core', 'Identifier'));
                    $title = metadata($attachment['item'], array('Dublin Core', 'Title'));
                    if (!$title && !empty($videoInfo[0]['title'])) {
                        $title = $videoInfo[0]['title'];
                    }
                    $currentLinkOptions = array();
                    $currentLinkOptions = array_merge($linkOptions, array(
                        'title' => $title,
                        'alt' => $title,
                    ));

                    $thumbnail = null;
                    switch (true) {
                        case (false !== stristr($itemMetaIdentifier, 'vimeo:')):
                            $videoId = substr($itemMetaIdentifier, 6);
                                // $videoInfo = unserialize(
                                    // file_get_contents('http://vimeo.com/api/v2/video/' . $videoId . '.php'));
                                // create curl resource
                            $ch = curl_init();

                                // set url
                            curl_setopt($ch, CURLOPT_URL, 'http://vimeo.com/api/v2/video/' . $videoId . '.php');

                                //return the transfer as a string
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                // $output contains the output string
                            $videoInfo = unserialize(curl_exec($ch));

                                // close curl resource to free up system resources
                            curl_close($ch);      

                                // echo $videoInfo[0]['thumbnail_small']; die();
                            if (isset($videoInfo[0]['thumbnail_medium']) && !empty($videoInfo[0]['thumbnail_medium'])) {
                                $thumbnail = '<div class="external-thumbnail" style="background-image:url(\'' . $videoInfo[0]['thumbnail_medium'] . '\');"><img src="' . img('thnplaceholder.gif') . '" alt="video" style="visibility:hidden;"><div class="blurb">Video</div></div>';
                            }

                            break;

                        default:
                        break;
                    }

                    $html .= exhibit_builder_link_to_exhibit_item($thumbnail, $currentLinkOptions, $attachment['item']);
            }
            $html .= '</div>' . "\n";
        }
    }

    return apply_filters('exhibit_builder_thumbnail_gallery', $html,
        array('start' => $start, 'end' => $end, 'props' => $props, 'thumbnail_type' => $thumbnailType));

    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public static function getAttachmentMarkup($attachment)
    {

        $file = $attachment['file'];

        // title
        $attachmentTitle = self::getItemTitle($attachment, $file);

        // subtitle
        $attachmentSubtitle = self::getItemSubtitle($attachment, $file);

        // description
        $attachmentDescription = self::getItemDescription($attachment, $file);

        // rights
        $attachmentRights = self::getItemRights($attachment, $file);

        // Source 
        // link text
        $attachmenLinkText = self::getItemLinkText($attachment, $file);

        // link title
        $attachmenLinkTitle = self::getItemLinkTitle($attachment, $file);
        if (empty($attachmenLinkTitle)) {
            $attachmenLinkTitle = $attachmentTitle;
        }

        // link url
        $attachmenLinkUrl = self::getItemLinkUrl($attachment, $file);

        // if (1 != 1 && count($attachment{'item'}->getFiles()) == 1) {
        //     // There is only one file attached to the object
        //     $metadata = json_decode($file->metadata);
        //     if (isset($metadata->mime_type) && substr($metadata->mime_type, 0, 5) == 'image') {
        //         // The file is an image, so link to the fullsize image
        //         return files_for_item(array(
        //             'imageSize' => 'fullsize', 
        //             'linkToFile' => true,
        //             'linkAttributes'=>array(
        //                 // 'rel'=>'ddb-omeka-gallery-1',
        //                 'data-title' => $attachmentTitle,
        //                 'data-linktext' => $attachmenLinkText,
        //                 'data-linkurl' => $attachmenLinkUrl,
        //                 'data-linktitle' => $attachmenLinkTitle,
        //                 'data-copyright' => $attachmentRights
        //         )), array('class'=>'permalink'), $attachment['item']); 
        //     }
        // } 

        return exhibit_builder_attachment_markup(
            $attachment, 
            array(
                'imageSize' => 'fullsize', 
                'linkAttributes'=>array(
                    // 'rel'=>'ddb-omeka-gallery-1',
                    'data-title' => $attachmentTitle,
                    'data-subtitle' => $attachmentSubtitle,
                    'data-description' => $attachmentDescription,
                    'data-linktext' => $attachmenLinkText,
                    'data-linkurl' => $attachmenLinkUrl,
                    'data-linktitle' => $attachmenLinkTitle,
                    'data-copyright' => $attachmentRights
            )), 
            array('class' => 'permalink'));

    }


}
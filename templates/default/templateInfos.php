<?php

/*
 * Yanis Framework, Yet ANother Internet Service for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

/**
 * Class templateInfos
 */
class TemplateInfos {

    /**
     * @var String Your site name
     */
    var $sitename = 'demo';

    /*=================
     * Template Metadata
     * =================
     */
    /**
     * @var type 
     */
    var $author = 'Yanis Framework';
    
    var $metadata = array(
        'author'=> 'Yanis Framework',
        'description'=>'',
        'keywords'=>'',
        'generator'=>'Yanis Framework',
        ''=>'',
        ''=>'',
        ''=>'',
        ''=>''
    );

    /**
     * @var Array Module positions and names
     */
    var $modules = array(
        1 => 'top',
        2 => 'carousel',
        3 => 'breadcumb', // 570|* ! 7#15 15 4 57|_|ff 70 |<33|*
        4 => 'right',
        5 => 'left',
        6 => 'bottom',
        7 => 'footer',
    );

    /**
     * @var Array Your web pages 
     */
    var $pages = array(
        1 => 'agence',
        2 => 'services',
        3 => 'innovation',
        4 => 'clients',
        5 => 'contact',
    );

}

?>
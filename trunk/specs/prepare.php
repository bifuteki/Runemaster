<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/**
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id:$
 * @since      File available since Release 0.1.0
 */

set_include_path(realpath(dirname(__FILE__) . '/../lib') .
                 PATH_SEPARATOR . get_include_path()
                 );

require_once 'SpecCommon.php';
require_once 'Rune/Master.php';

function rendererInTest($master, $file)
{
    ob_start();
    $master->cast($file);
    $buffer = ob_get_contents();
    ob_end_clean();

    return $buffer;
}

/*
 * Local Variables:
 * mode: php
 * coding: utf-8
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * indent-tabs-mode: nil
 * End:
 */
?>

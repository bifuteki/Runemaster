<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id$
 * @since      File available since Release 0.1.0
 */

require_once dirname(__FILE__) . '/SpecCommon.php';

// {{{ Describeテンプレート読み込み

/**
 * テンプレート読み込みに関するSpec
 *
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Describeテンプレート読み込み extends SpecCommon
{

    // {{{ properties

    /**#@+
     * @access public
     */

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

    /**#@-*/

    /**#@+
     * @access public
     */

    public function itテンプレートはinlucdeで読み込んでいるのでphpタグが使える()
    {
        $this->_master->assign(array('title' => 'Hello, World!'));
        $display = $this->_renderer('TemplateLoad/UsingPHP');
        $result = $this->_answer('TemplateLoad/UsingPHP.html');

        $this->spec($display)->should->be($result);
    }

    public function itテンプレート内のphpスクリプトで変数が扱える()
    {
        $variables = array('items' => array('foo', 'bar', 'baz'));
        $display = $this->_renderer('TemplateLoad/UsingPHPWithVariable',
                                    $variables
                                    );
        $result = $this->_answer('TemplateLoad/UsingPHPWithVariable.html');

        $this->spec($display)->should->be($result);
    }

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

    /**#@-*/

    // }}}
}

// }}}

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

<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id:$
 * @since      File available since Release 0.2.0
 */

require_once dirname(__FILE__) . '/prepare.php';

// {{{ Describeレイアウト機能

/**
 * レイアウト機能に関するSpec
 *
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    Release: @package_version@
 * @since      Class available since Release 0.2.0
 */
class Describeレイアウト機能 extends SpecCommon
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

    public function it指定タグの内部にコンテンツを置換挿入できる()
    {
        $master = $this->_master;
        $master->setLayout('Layout/Inner');
        $display = rendererInTest($master, 'Layout/Content');
        $result = file_get_contents('./results/Layout/Inner.html');

        $this->spec($display)->should->be($result);
    }

    public function it指定タグの外部にコンテンツを置換挿入できる()
    {
        $master = $this->_master;
        $master->setLayout('Layout/Outer');
        $display = rendererInTest($master, 'Layout/Content');
        $result = file_get_contents('./results/Layout/Outer.html');

        $this->spec($display)->should->be($result);
    }

    public function itレイアウトテンプレートのディレクトリを個別指定できる()
    {
        $master = $this->_master;
        $master->setLayout('Inner', $this->_templateDirectory . '/Layout');
        $display = rendererInTest($master, 'Layout/Content');
        $result = file_get_contents('./results/Layout/Inner.html');

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

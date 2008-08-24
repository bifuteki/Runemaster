<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id$
 * @since      File available since Release 0.2.0
 */

require_once dirname(__FILE__) . '/../SpecCommon.php';

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

    public function it指定タグの内部へコンテンツを置換挿入できる()
    {
        $master = $this->_master;
        $master->setLayout('Layout/Basic');
        $display = $this->_renderer('Layout/Content');
        $result = $this->_answer('Layout/Inner.html');

        $this->spec($display)->should->be($result);
    }

    public function it指定タグの内部へと明示的に指定してコンテンツを置換挿入できる()
    {
        $master = $this->_master;
        $master->setLayout('Layout/Inner');
        $display = $this->_renderer('Layout/Content');
        $result = $this->_answer('Layout/Inner.html');

        $this->spec($display)->should->be($result);
    }

    public function it指定タグの外部へと明示的に指定してコンテンツを置換挿入できる()
    {
        $master = $this->_master;
        $master->setLayout('Layout/Outer');
        $display = $this->_renderer('Layout/Content');
        $result = $this->_answer('Layout/Outer.html');

        $this->spec($display)->should->be($result);
    }

    public function itレイアウトテンプレートのディレクトリを個別指定できる()
    {
        $master = $this->_master;
        $master->setLayout('Inner', $this->_templatesDirectory . '/Layout');
        $display = $this->_renderer('Layout/Content');
        $result = $this->_answer('Layout/Inner.html');

        $this->spec($display)->should->be($result);
    }

    public function it指定タグ内部に記述してあるテキストをレイアウトへ挿入するコンテンツとして利用できる()
    {
        $master = $this->_master;
        $master->setLayout('Layout/Inner');
        $display = $this->_renderer('Layout/ContentsWithOther');
        $result = $this->_answer('Layout/Inner.html');

        $this->spec($display)->should->be($result);
    }

    public function it指定タグ内部に記述してあると明示的にしたテキストをレイアウトへ挿入するコンテンツとして利用できる()
    {
        $master = $this->_master;
        $master->setLayout('Layout/Inner');
        $display = $this->_renderer('Layout/ContentsInInner');
        $result = $this->_answer('Layout/Inner.html');

        $this->spec($display)->should->be($result);
    }

    public function it指定タグ外部を含めると明示的にしたテキストをレイアウトへ挿入するコンテンツとして利用できる()
    {
        $master = $this->_master;
        $master->setLayout('Layout/Outer');
        $display = $this->_renderer('Layout/ContentsInOuter');
        $result = $this->_answer('Layout/Inner.html');

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

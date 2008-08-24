<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id$
 * @since      File available since Release 0.1.0
 */

require_once dirname(__FILE__) . '/prepare.php';

// {{{ Describe挿入処理

/**
 * 挿入処理に関するSpec
 *
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Describe挿入処理 extends SpecCommon
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

    public function itセレクタによる指定ノード内の末尾にコンテンツが追加できる()
    {
        $text = 'Insertion';
        $node = '<span>Insertion</span>';

        $master = $this->_master;
        $master->append('#foo', $text);
        $master->append('#bar', $node);
        $display = rendererInTest($master, 'Manipulation/AppendContent');
        $result = file_get_contents('./results/Manipulation/AppendContent.html');

        $this->spec($display)->should->be($result);
    }

    public function itセレクタによる指定ノード内の末尾にノードが追加できる()
    {
        $dom = str_get_dom('<span class="example">Insertion</span>');
        $nodes = $dom->find('span');
        $node = $nodes[0];

        $master = $this->_master;
        $master->append('#foo', $node);
        $display = rendererInTest($master, 'Manipulation/AppendNode');
        $result = file_get_contents('./results/Manipulation/AppendNode.html');

        $this->spec($display)->should->be($result);
    }

    public function itセレクタによる指定ノード内の先頭にコンテンツが追加できる()
    {
        $text = 'Insertion';
        $node = '<span>Insertion</span>';

        $master = $this->_master;
        $master->prepend('#foo', $text);
        $master->prepend('#bar', $node);
        $display = rendererInTest($master, 'Manipulation/PrependContent');
        $result = file_get_contents('./results/Manipulation/PrependContent.html');

        $this->spec($display)->should->be($result);
    }

    public function itセレクタによる指定ノード内の先頭にノードが追加できる()
    {
        $dom = str_get_dom('<span class="example">Insertion</span>');
        $nodes = $dom->find('span');
        $node = $nodes[0];

        $master = $this->_master;
        $master->prepend('#foo', $node);
        $display = rendererInTest($master, 'Manipulation/PrependNode');
        $result = file_get_contents('./results/Manipulation/PrependNode.html');

        $this->spec($display)->should->be($result);
    }

    public function itセレクタによる指定ノード内の先頭と末尾へ同時にノードが追加できる()
    {
        $appendixContent = 'AAA';
        $prependsContent = 'BBB';

        $master = $this->_master;
        $master->append('#foo', $appendixContent);
        $master->prepend('#foo', $prependsContent);

        $display = rendererInTest($master, 'Manipulation/AppendAndPrepend');
        $result = file_get_contents('./results/Manipulation/AppendAndPrepend.html');

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

<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id$
 * @since      File available since Release 0.1.0
 */

require_once dirname(__FILE__) . '/../SpecCommon.php';

// {{{ Describeエレメント属性操作

/**
 * エレメント属性操作に関するSpec
 *
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Describeエレメント属性操作 extends SpecCommon
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

    public function itセレクタによる指定ノードのエレメントが追加、変更できる()
    {
        $element = new stdClass();
        $element->class = 'example';
        $element->aaa = 'AAA';

        $master = $this->_master;
        $master->setAttribute('#foo', $element);
        $display = $this->_renderer('Attributes/Basic');
        $result = $this->_answer('Attributes/Basic.html');

        $this->spec($display)->should->be($result);
    }

    public function itセレクタによる複数対象のエレメントが追加、変更できる()
    {
        $element = new stdClass();
        $element->class = 'example';
        $element->aaa = 'AAA';

        $master = $this->_master;
        $master->setAttribute('span', $element);
        $display = $this->_renderer('Attributes/Multi');
        $result = $this->_answer('Attributes/Multi.html');

        $this->spec($display)->should->be($result);
    }

    public function itエレメントの各要素のうち、今のところタグ名は変えれない()
    {
        $element = new stdClass();
        $element->tag = 'div';

        $master = $this->_master;
        $master->setAttribute('#foo', $element);
        $display = $this->_renderer('Attributes/Basic');
        $result = file_get_contents($this->_templatesDirectory .
                                    '/Attributes/Basic.html'
                                    );
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

<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id:$
 * @since      File available since Release 0.1.0
 */

require_once dirname(__FILE__) . '/prepare.php';

// {{{ Describe繰り返し処理

/**
 * 繰り返し処理に関するSpec
 *
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Describe繰り返し処理 extends SpecCommon
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

    public function itphpのforeach_as_valueのような処理ができる()
    {
        $variables = new stdClass();
        $variables->messages = array('foo', 'bar', 'baz');

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Foreach/ForeachAsValue');
        $result = file_get_contents('./results/Foreach/ForeachAsValue.html');

        $this->spec($display)->should->be($result);
    }

    public function itphpのforeach_as_key_valueのような処理ができる()
    {
        $variables = new stdClass();
        $variables->messages = array('foo', 'bar', 'baz');

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Foreach/ForeachAsKeyValue');
        $result = file_get_contents('./results/Foreach/ForeachAsKeyValue.html');

        $this->spec($display)->should->be($result);
    }

    public function it繰り返し処理エレメント内でも、トップレベルのテンプレート変数が使える()
    {
        $variables = new stdClass();
        $variables->messages = array('foo', 'bar', 'baz');
        $variables->item = 'AAA';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Foreach/ForeachTopVariable');
        $result = file_get_contents('./results/Foreach/ForeachTopVariable.html');

        $this->spec($display)->should->be($result);
    }

    public function it通常の変数と繰り返し対象の展開変数の変数名が重複した場合は、展開変数が優先される()
    {
        $variables = new stdClass();
        $variables->messages = array('foo', 'bar', 'baz');
        $variables->message = 'Duplicating Value';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Foreach/ForeachAsKeyValue');
        $result = file_get_contents('./results/Foreach/ForeachAsKeyValue.html');

        $this->spec($display)->should->be($result);
    }

    public function it繰り返し対象の展開変数がオブジェクトや配列も利用できる()
    {
        $person1 = new stdClass();
        $person1->id = 1;
        $person1->name = 'foo';
        $person1->email = array('pc' => 'foo@example.com');
        $person2 = new stdClass();
        $person2->id = 2;
        $person2->name = 'bar';
        $person2->email = array('pc' => 'bar@example.com');

        $variables = new stdClass();
        $variables->persons = array($person1, $person2);

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Foreach/Table');
        $result = file_get_contents('./results/Foreach/Table.html');

        $this->spec($display)->should->be($result);
    }

    public function it繰り返し処理はネストできる()
    {
        $person1 = new stdClass();
        $person1->items = array('foo', 'bar', 'baz');

        $variables = new stdClass();
        $variables->persons = array($person1);

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Foreach/Nest');
        $result = file_get_contents('./results/Foreach/Nest.html');

        $this->spec($display)->should->be($result);
    }

    public function itforeach属性と同じエレメントにkey属性を設定して変数展開できる()
    {
        $variables = new stdClass();
        $variables->messages = array('foo', 'bar', 'baz');

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Foreach/ForeachAsValue');
        $result = file_get_contents('./results/Foreach/ForeachAsValue.html');

        $this->spec($display)->should->be($result);
    }

    public function itリスト変数が空もしくはnullの場合はinnertextが消える()
    {
        $variables = new stdClass();
        $variables->messages = array();
        $variables->persons = null;

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Foreach/Noting');
        $result = file_get_contents('./results/Foreach/Noting.html');

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

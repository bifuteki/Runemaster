<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id:$
 * @since      File available since Release 0.1.0
 */

require_once dirname(__FILE__) . '/prepare.php';

// {{{ Describe条件による表示切り替え処理

/**
 * 条件による表示切り替え処理に関するSpec
 *
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Describe条件による表示切り替え処理 extends SpecCommon
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

    public function itテンプレート変数値がtrueであれば表示、偽であれば非表示にできる()
    {
        $variables = new stdClass();
        $variables->foo = true;
        $variables->bar = false;

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'If/Basic');
        $result = file_get_contents('./results/If/Basic.html');

        $this->spec($display)->should->be($result);
    }

    public function itテンプレート変数値の条件を反転評価して表示非表示を切り替えることができる()
    {
        $variables = new stdClass();
        $variables->foo = true;
        $variables->bar = false;

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'If/Reversal');
        $result = file_get_contents('./results/If/Reversal.html');

        $this->spec($display)->should->be($result);
    }

    public function itオブジェクトのテンプレート変数を使って表示非表示を切り替えることができる()
    {
        $variables = new stdClass();
        $variables->foo = new stdClass();
        $variables->foo->bar = 'Bar';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'If/Object');
        $result = file_get_contents('./results/If/Object.html');

        $this->spec($display)->should->be($result);
    }

    public function it配列のテンプレート変数を使って表示非表示を切り替えることができる()
    {
        $variables = new stdClass();
        $variables->foo = array(1, 2, 3);

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'If/Array');
        $result = file_get_contents('./results/If/Array.html');

        $this->spec($display)->should->be($result);
    }

    public function itクラスメソッドの評価によって表示非表示を切り替えることができる()
    {
        require_once dirname(__FILE__) . '/lib/ExampleClass.php';
        $class = new ExampleClass();

        $variables = new stdClass();
        $variables->class = $class;

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'If/Class');
        $result = file_get_contents('./results/If/Class.html');

        $this->spec($display)->should->be($result);
    }

    public function it関数の評価によって表示非表示を切り替えることができる()
    {
        $variables = new stdClass();
        $variables->numeric = 10;
        $variables->string = 'foo';
        $variables->null = null;

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'If/Function');
        $result = file_get_contents('./results/If/Function.html');

        $this->spec($display)->should->be($result);
    }

    public function it「if（比較評価式）」のような評価が行える()
    {
        $variables = new stdClass();
        $variables->foo = 10;
        $variables->bar = 0;
        $variables->baz = 20;
        $variables->qux = 30;

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'If/Expression');
        $result = file_get_contents('./results/If/Expression.html');

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

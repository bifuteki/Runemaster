<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id:$
 * @since      File available since Release 0.1.0
 */

require_once dirname(__FILE__) . '/prepare.php';

// {{{ Describeテンプレート変数割り当て

/**
 * テンプレート変数割り当てに関するSpec
 *
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Describeテンプレート変数割り当て extends SpecCommon
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

    public function itオブジェクトを割り当てると、プロパティがテンプレート変数として利用される()
    {
        $variables = new stdClass();
        $variables->foo = 'Bar';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Literal');
        $result = file_get_contents('./results/Assign/Literal.html');

        $this->spec($display)->should->be($result);
    }

    public function it連想配列を割り当てると、配列キーがテンプレート変数として利用される()
    {
        $variables = array();
        $variables['foo'] = 'Bar';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Literal');
        $result = file_get_contents('./results/Assign/Literal.html');

        $this->spec($display)->should->be($result);
    }

    public function itテンプレート変数として配列が利用できる()
    {
        $variables = new stdClass();
        $variables->foo = array(1, 2, 3);
        $variables->bar = array(4, array(5, 6));
        $variables->baz = array(array(array(7)));
        $variables->quux = array('a' => 'AAA',
                                 'b' => array('c' => 'CCC'),
                                 'c' => array(7, 8)
                                 );
        $variables->qux = array(array(array('foo' => array(9, 10))));

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Array');
        $result = file_get_contents('./results/Assign/Array.html');

        $this->spec($display)->should->be($result);
    }

    public function itテンプレート変数としてオブジェクトが利用できる()
    {
        $variables = new stdClass();
        $variables->foo = new stdClass();
        $variables->foo->bar = 'AAA';
        $variables->foo->baz = new stdClass();
        $variables->foo->baz->quux = 'BBB';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Object');
        $result = file_get_contents('./results/Assign/Object.html');

        $this->spec($display)->should->be($result);
    }

    public function itテンプレート変数は配列とオブジェクトが混合で利用できる()
    {
        $variables = new stdClass();
        $variables->foo = new stdClass();
        $variables->foo->bar = array(1, 2, 3);

        $variables->baz = array();
        $variables->baz[0] = new stdClass();
        $variables->baz[0]->quux = 'AAA';
        $variables->baz[1]->qux = 'BBB';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/ArrayObject');
        $result = file_get_contents('./results/Assign/ArrayObject.html');

        $this->spec($display)->should->be($result);
    }

    public function itテンプレート変数として割り当てたクラスオブジェクトのメソッドが利用できる()
    {
        require_once dirname(__FILE__) . '/lib/ExampleClass.php';
        $class = new ExampleClass();

        $variables = new stdClass();
        $variables->class = $class;
        $variables->bbb = 2;
        $variables->path['to'] = $class;

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Class');
        $result = file_get_contents('./results/Assign/Class.html');

        $this->spec($display)->should->be($result);
    }

    public function itテンプレート変数に対して関数が利用できる()
    {
        require_once dirname(__FILE__) . '/lib/ExampleFunction.php';
        $variables = new stdClass();
        $variables->items = array(1, 2, 3);

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Function');
        $result = file_get_contents('./results/Assign/Function.html');

        $this->spec($display)->should->be($result);
    }

    public function itテンプレート変数として指定する属性の名称が変更できる()
    {
        $variables = new stdClass();
        $variables->foo = 'Bar';

        $master = $this->_master;
        $master->setVariableKey('original_key');
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/OriginalKey');
        $result = file_get_contents('./results/Assign/OriginalKey.html');

        $this->spec($display)->should->be($result);
    }

    public function it置換されるテンプレート変数は何もせずともエスケープ済み()
    {
        $variables = new stdClass();
        $variables->foo = '<br />';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Htmlspecialchars1');
        $result = file_get_contents('./results/Assign/Htmlspecialchars1.html');

        $this->spec($display)->should->be($result);
    }

    public function it置換されるテンプレート変数のエスケープは個別で無効にできる()
    {
        $variables = new stdClass();
        $variables->foo = '<br />';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Htmlspecialchars2');
        $result = file_get_contents('./results/Assign/Htmlspecialchars2.html');

        $this->spec($display)->should->be($result);
    }

    public function itテンプレート内で同じ変数は、利用タグに関係なく何度でも使える()
    {
        $variables = new stdClass();
        $variables->foo = 'Bar';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/SameKey');
        $result = file_get_contents('./results/Assign/SameKey.html');

        $this->spec($display)->should->be($result);
    }

    public function it値がassignされていないテンプレート変数は無視される()
    {
        $variables = new stdClass();
        $variables->foo = 'Bar';
        $variables->baz->quux = 'Qux';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/NoAssign');
        $result = file_get_contents('./results/Assign/NoAssign.html');

        $this->spec($display)->should->be($result);
    }

    public function it値を割り当てるのに利用したタグは明示的に消去することができる()
    {
        $variables = new stdClass();
        $variables->foo = 'Bar';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Omitter');
        $result = file_get_contents('./results/Assign/Omitter.html');

        $this->spec($display)->should->be($result);
    }

    public function itエレメント属性の値に対して｛｝で囲んだテンプレート変数を利用できる()
    {
        $variables = new stdClass();
        $variables->foo = 'Bar';
        $variables->class = 'baz';

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Attribute');
        $result = file_get_contents('./results/Assign/Attribute.html');

        $this->spec($display)->should->be($result);
    }

    public function itノード内テキストにおいて｛｝で囲んだテンプレート変数を利用できる()
    {
        $variables = new stdClass();
        $variables->foo = 'Foo';
        $variables->bar = array('foo' => 'Bar');

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/NodeText');
        $result = file_get_contents('./results/Assign/NodeText.html');

        $this->spec($display)->should->be($result);
    }

    public function it｛｝で置換するテンプレート変数もエスケープ済み()
    {
        $variables = new stdClass();
        $variables->foo = '<br />';
        $variables->bar = "alert('hello');";
        $variables->baz = "\" onmouseover=\"alert('hello');\"";
        $variables->qux = "' onmouseover='alert(\"hello\");'";

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Htmlspecialchars3');
        $result = file_get_contents('./results/Assign/Htmlspecialchars3.html');

        $this->spec($display)->should->be($result);
    }

    public function it｛｝で置換するテンプレート変数のエスケープは｛＊＊｜html｝とすれば無効にできる()
    {
        $variables = new stdClass();
        $variables->foo = '<br />';
        $variables->bar = "alert('hello');";
        $variables->baz = "\" onmouseover=\"alert('hello');";

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Assign/Htmlspecialchars4');
        $result = file_get_contents('./results/Assign/Htmlspecialchars4.html');

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

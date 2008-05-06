<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id:$
 * @since      File available since Release 0.1.0
 */

require_once dirname(__FILE__) . '/prepare.php';

// {{{ Describeフォーム操作

/**
 * フォーム操作に関するSpec
 *
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Describeフォーム操作 extends SpecCommon
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

    public function itテキストラインへ値をセットすることができる()
    {
        $values = new stdClass();
        $values->email = 'foo@example.com';

        $master = $this->_master;
        $master->setFormValue('example', $values);
        $display = rendererInTest($master, 'Form/TextLine');
        $result = file_get_contents('./results/Form/TextLine.html');

        $this->spec($display)->should->be($result);
    }

    public function itテキストエリアへ値をセットすることができる()
    {
        $values = new stdClass();
        $values->message = <<< MESSAGE
foo
bar
baz
MESSAGE;

        $master = $this->_master;
        $master->setFormValue('example', $values);
        $display = rendererInTest($master, 'Form/TextArea');
        $result = file_get_contents('./results/Form/TextArea.html');

        $this->spec($display)->should->be($result);
    }

    public function itHiddenへ値をセットすることができる()
    {
        $values = new stdClass();
        $values->email = 'foo@example.com';

        $master = $this->_master;
        $master->setFormValue('example', $values);
        $display = rendererInTest($master, 'Form/Hidden');
        $result = file_get_contents('./results/Form/Hidden.html');

        $this->spec($display)->should->be($result);
    }

    public function itセレクトボックスを選択状態にできる()
    {
        $values = new stdClass();
        $values->item = 2;

        $master = $this->_master;
        $master->setFormValue('example', $values);
        $display = rendererInTest($master, 'Form/Select');
        $result = file_get_contents('./results/Form/Select.html');

        $this->spec($display)->should->be($result);
    }

    public function itラジオボタンをチェック状態にできる()
    {
        $values = new stdClass();
        $values->item = 2;

        $master = $this->_master;
        $master->setFormValue('example', $values);
        $display = rendererInTest($master, 'Form/Radio');
        $result = file_get_contents('./results/Form/Radio.html');

        $this->spec($display)->should->be($result);
    }

    public function itチェックボックスをチェック状態にできる()
    {
        $values = new stdClass();
        $values->item = 2;
        $values->person = 3;

        $master = $this->_master;
        $master->setFormValue('example', $values);
        $display = rendererInTest($master, 'Form/Checkbox');
        $result = file_get_contents('./results/Form/Checkbox.html');

        $this->spec($display)->should->be($result);
    }

    public function itボタンやサブミットへ値がセットすることができる()
    {
        $values = new stdClass();
        $values->foo = 'foo button';
        $values->bar = 'bar submit';
        $values->baz = 'baz button';
        $values->qux = 'qux button';

        $master = $this->_master;
        $master->setFormValue('example', $values);
        $master->assign(array('qux' => 'qux'));
        $display = rendererInTest($master, 'Form/Button');
        $result = file_get_contents('./results/Form/Button.html');

        $this->spec($display)->should->be($result);
    }

    public function it指定するフォームに値をhiddenとしてセットすることができる()
    {
        $values = new stdClass();
        $values->foo = 'AAA';
        $values->bar = 'BBB';

        $master = $this->_master;
        $master->setHiddenValue('example', $values);
        $display = rendererInTest($master, 'Form/InsertHidden');
        $result = file_get_contents('./results/Form/InsertHidden.html');

        $this->spec($display)->should->be($result);
    }

    public function itリストをセレクトオプションとして登録することができる()
    {
        $items = array('1' => 'foo', '2' => 'bar', '3' => 'baz');
        $persons = array('1' => 'qux', '2' => 'quux', '3' => 'corge');
        $values = new stdClass();
        $values->person = 2;

        $master = $this->_master;
        $master->setOption('item', $items);
        $master->setOption('person', $persons);
        $master->setFormValue('example', $values);
        $display = rendererInTest($master, 'Form/Options');
        $result = file_get_contents('./results/Form/Options.html');

        $this->spec($display)->should->be($result);
    }

    public function it設定する値は何もせずともエスケープ済み()
    {
        $values = new stdClass();
        $values->field = '" onclick="alert(\'hello\')';

        $master = $this->_master;
        $master->setFormValue('example', $values);
        $display = rendererInTest($master, 'Form/Html');
        $result = file_get_contents('./results/Form/Html.html');

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

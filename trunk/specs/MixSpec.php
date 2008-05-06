<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id$
 * @since      File available since Release 0.1.0
 */

require_once dirname(__FILE__) . '/prepare.php';

// {{{ Describe機能の複合利用

/**
 * 機能の複合利用に関するSpec
 *
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Describe機能の複合利用 extends SpecCommon
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

    public function itforeach構文とif構文を組み合わせて利用できる()
    {
        $variables = new stdClass();

        $variables->items1 = array('foo', 'bar', null, 'baz');
        $variables->items2 = array('foo', 'bar', null, 'baz');
        $variables->persons = array('bob', 'mike');

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Mix/IfForeach');
        $result = file_get_contents('./results/Mix/IfForeach.html');

        $this->spec($display)->should->be($result);
    }

    public function itforeach構文で繰り返されるコンテンツ内のエレメント要素が｛｝変数で変更できる()
    {
        $variables = new stdClass();
        $variables->entries = array(array('value' => 'foo', 'color' => '#000000'),
                                    array('value' => 'bar', 'color' => '#FFFFFF'),
                                    );

        $master = $this->_master;
        $master->assign($variables);
        $display = rendererInTest($master, 'Mix/ForeachSetAttribute');
        $result = file_get_contents('./results/Mix/ForeachSetAttribute.html');

        $this->spec($display)->should->be($result);
    }

    public function itforeach構文で繰り返されるコンテンツ内でチェックボックスの生成およびチェック状態が実現できる()
    {
        $variables = new stdClass();
        $variables->checkboxes = array(array('value' => 1, 'name' => 'foo'),
                                       array('value' => 2, 'name' => 'bar'),
                                       );
        $formValue->checkbox = array(2);

        $master = $this->_master;
        $master->assign($variables);
        $master->setFormValue(null, $formValue);
        $display = rendererInTest($master, 'Mix/ForeachCheckbox');
        $result = file_get_contents('./results/Mix/ForeachCheckbox.html');

        $this->spec($display)->should->be($result);
    }

    public function itappendしたコンテンツ内に記載されているテンプレート変数が置換できる()
    {
        $node = '<span key="foo"></span>';

        $master = $this->_master;
        $master->append('#foo', $node);
        $master->assign(array('foo' => 'Foo'));
        $display = rendererInTest($master, 'Mix/AssignAfterAppend');
        $result = file_get_contents('./results/Mix/AssignAfterAppend.html');

        $this->spec($display)->should->be($result);
    }

    public function itsetattributesでテンプレート変数属性を追加したタグの変数が置換できる()
    {
        $element = new stdClass();
        $element->key = 'foo';

        $master = $this->_master;
        $master->setAttribute('#foo', $element);
        $master->assign(array('foo' => 'Foo'));
        $display = rendererInTest($master, 'Mix/AssignAfterSetAttributes');
        $result = file_get_contents('./results/Mix/AssignAfterSetAttributes.html');

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

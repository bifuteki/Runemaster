<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id$
 * @since      File available since Release 0.1.0
 */

require_once dirname(__FILE__) . '/SpecCommon.php';

// {{{ Describeプラグイン

/**
 * プラグインに関するSpec
 *
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Describeプラグイン extends SpecCommon
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

    public function it利用するプラグインのエントリリストが取得できる()
    {
        $spells = $this->_master->listSpell();

        $this->spec(is_array($spells))->should->beTrue();
        $this->spec(count($spells))->should->be(7);
    }

    public function it利用するプラグインのエントリを変更できる()
    {
        $this->_master->assign(array('foo' => 'Bar'));
        $display = $this->_renderer('Plugin/Change');
        $result = $this->_answer('Plugin/Change1.html');

        $this->spec($display)->should->be($result);

        $spells = $this->_master->listSpell();
        $newSpells = array();
        foreach ($spells as $spell) {
            if ($spell !== 'Rune_Spell_Variable') {
                array_push($newSpells, $spell);
            }
        }

        $this->before();

        try {
            $this->_master->setSpells($newSpells);
            $this->_master->assign(array('foo' => 'Baz'));
        } catch (Exception $e) {
            return;
        }

        $this->fail();
    }

    public function itオリジナルプラグインが追加できる()
    {
        set_include_path(realpath(dirname(__FILE__) . '/PluginSpec') .
                         PATH_SEPARATOR . get_include_path()
                         );

        $this->_master->addSpell('ExampleSpell');

        $this->_master->testExampleSpell('Changed by original spell.');

        $display = $this->_renderer('Plugin/Add');
        $result = $this->_answer('Plugin/Add.html');

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

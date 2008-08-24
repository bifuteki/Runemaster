<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/* 
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    SVN: $Id$
 * @since      File available since Release 0.1.0
 */

require_once 'PHPSpec/Context.php';

// {{{ SpecCommon

/**
 * Spec Common クラス
 *
 * @package    Runemaster
 * @copyright  2008 KUMAKURA Yousuke All rights reserved.
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class SpecCommon extends PHPSpec_Context
{

    // {{{ properties

    /**#@+
     * @access public
     */

    /**#@-*/

    /**#@+
     * @access protected
     */

    protected $_master;
    protected $_templateDirectory;
    protected $_cacheDirectory;

    /**#@-*/

    /**#@+
     * @access private
     */

    /**#@-*/

    /**#@+
     * @access public
     */

    public function beforeAll()
    {
        $this->_templateDirectory = dirname(__FILE__) . '/templates';
    }

    public function before()
    {
        unset($this->_master);
        $this->_master = new Rune_Master($this->_templateDirectory);
    }

    public function after()
    {
/*         $this->_removeInnerDirectory($this->_cacheDirectory); */
    }

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

    private function _removeInnerDirectory($directory)
    {
        $dir = new DirectoryIterator($directory);
        foreach ($dir as $target) {
            if ($dir->isDot()) {
                continue;
            }
            if ($dir->isDir()) {
                $this->_removeInnerDirectory("{$directory}/{$target}");
                rmdir("{$directory}/{$target}");
            } else {
                unlink("{$directory}/{$target}");
            }
        }
    }


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

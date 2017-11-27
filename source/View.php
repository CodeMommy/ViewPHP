<?php

/**
 * CodeMommy ViewPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\ViewPHP;

use Smarty;

/**
 * Class View
 * @package CodeMommy\ViewPHP
 */
class View
{
    /**
     * @var bool
     */
    private static $isDebug = false;

    /**
     * @var string
     */
    private static $path = '';

    /**
     * @var string
     */
    private static $cachePath = '';

    /**
     * @var string
     */
    private static $compilePath = '';

    /**
     * View constructor.
     */
    public function __construct()
    {
    }

    /**
     * Set Config
     * @param bool $isDebug
     */
    public static function setDebug($isDebug = false)
    {
        self::$isDebug = $isDebug;
    }

    /**
     * Set Path
     * @param string $path
     */
    public static function setPath($path = '')
    {
        self::$path = $path;
    }

    /**
     * Set Cache Path
     * @param string $cachePath
     */
    public static function setCachePath($cachePath = '')
    {
        self::$cachePath = $cachePath;
    }

    /**
     * Set Compile Path
     * @param string $compilePath
     */
    public static function setCompilePath($compilePath = '')
    {
        self::$compilePath = $compilePath;
    }

    /**
     * Render
     * @param string $view
     * @param array $data
     *
     * @return null
     */
    public static function render($view = '', $data = array())
    {
        $smarty = new Smarty();
        $smarty->setTemplateDir(self::$path);
        $smarty->setCompileDir(self::$compilePath);
        $smarty->setCacheDir(self::$cachePath);
        $smarty->left_delimiter = '{';
        $smarty->right_delimiter = '}';
        $smarty->debugging = false;
        if (self::$isDebug == true) {
            $smarty->caching = false;
            $smarty->clearAllCache();
            $smarty->clearCompiledTemplate($view);
        } else {
            $smarty->caching = true;
        }
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $smarty->assign($key, $value);
            }
        }
        $view .= '.tpl';
        $smarty->display($view);
        return null;
    }
}

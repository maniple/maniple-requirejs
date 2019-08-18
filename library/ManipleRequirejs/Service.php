<?php

/**
 * @uses Zend_View
 * @uses Zend_View_Helper_BaseUrl
 * @uses Zend_View_Helper_HeadScript
 */
class ManipleRequirejs_Service
{
    const className = __CLASS__;

    /**
     * @var Zend_View_Abstract
     */
    protected $_view;

    /**
     * @var string
     */
    protected $_baseUrl;

    /**
     * @var string[]
     */
    protected $_paths = array();

    /**
     * @var array
     */
    protected $_shim = array();

    public function __construct(Zend_View_Abstract $view)
    {
        $this->_view = $view;

        // Attach scripts to HeadScript. It uses the fact, that scripts can be
        // given not only as strings, but as objects implementing __toString()
        // method.

        /** @var Zend_View_Helper_HeadScript $headScript */
        $headScript = $view->getHelper('HeadScript');
        $headScript->prependFile($this->getScriptUrlCallback());
        $headScript->appendScript($this, 'text/javascript', array('noescape' => true));
    }

    /**
     * @param string $baseUrl
     * @return $this
     */
    public function setBaseUrl($baseUrl)
    {
        $this->_baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->_baseUrl;
    }

    /**
     * @param string $module
     * @param string $path
     * @return $this
     */
    public function addPath($module, $path)
    {
        $this->_paths[$module] = $path;
        return $this;
    }

    /**
     * @param string[] $paths
     * @return $this
     */
    public function addPaths($paths)
    {
        foreach ($paths as $module => $path) {
            $this->addPath($module, $path);
        }
        return $this;
    }

    /**
     * Add shim to configuration.
     *
     * Shim configuration looks like this:
     *
     * <pre>
     * shim: {
     *   module1: [dep1, dep2, ..., depN],
     *   module2: {
     *     deps: [dep1, dep2, ..., depN],
     *     exports: varName
     *   }
     * }
     * </pre>
     *
     * @see https://requirejs.org/docs/api.html#config-shim
     *
     * @param string $module
     * @param string[] $deps
     * @param string $exports
     * @return $this
     */
    public function addShim($module, array $deps = null, $exports = null)
    {
        $shim = array();
        $deps = array_values(array_map('strval', $deps));

        if ($exports) {
            // RequireJS supports only single export per module
            // https://github.com/jrburke/requirejs/issues/482
            $shim['exports'] = strval($exports);
            if ($deps) {
                $shim['deps'] = $deps;
            }
        } elseif ($deps) {
            // if shim is given as an array, it is a shorthand for deps
            $shim = $deps;
        }
        $this->_shim[$module] = $shim;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = array();

        $array['baseUrl'] = $this->_baseUrl
            ? $this->_baseUrl
            : $this->_view->getHelper('BaseUrl')->baseUrl('/');

        if ($this->_paths) {
            $array['paths'] = array_map('strval', $this->_paths);
        }

        if ($this->_shim) {
            $array['shim'] = $this->_shim;
        }

        return $array;
    }

    /**
     * @return string
     */
    public function getConfigScript()
    {
        $json = Zefram_Json::encode($this->toArray(), array(
            'unescapedSlashes' => true,
            'unescapedUnicode' => true,
        ));

        return sprintf('require.config(%s);', $json);
    }

    /**
     * @return string
     */
    public function getScriptUrl()
    {
        return $this->_view->getHelper('BaseUrl')->baseUrl('bower_components/requirejs/require.js');
    }

    /**
     * This method is for deferring the call to baseUrl, because it requires
     * request to be defined in the front controller, and this requirement may
     * not be satisfied during application bootstrap phase.
     *
     * @return ManipleRequirejs_Util_StringCallback
     */
    public function getScriptUrlCallback()
    {
        return new ManipleRequirejs_Util_StringCallback(array($this, 'getScriptUrl'));
    }

    /**
     * Proxy to {@link getConfigScript()}
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getConfigScript();
    }
}

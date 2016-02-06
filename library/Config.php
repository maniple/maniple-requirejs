<?php

class ManipleRequirejs_Config
{
    protected $_baseUrl;

    protected $_paths = array();

    protected $_shim = array();

    // shim:
    //    module: [dep1, dep2, ..., depN]
    //    or {
    //      deps: [dep1, dep2, ..., depN]
    //      exports:
    //    }

    public function setBaseUrl($baseUrl)
    {
        $this->_baseUrl = $baseUrl;
        return $this;
    }

    public function getBaseUrl()
    {
        return $this;
    }

    public function addPath($module, $path)
    {
        $this->_paths[$module] = $path;
        return $this;
    }

    public function addPaths($paths)
    {
        foreach ($paths as $module => $path) {
            $this->addPath($module, $path);
        }
        return $this;
    }

    public function addShim($module, array $deps, $exports = null)
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

    public function toArray()
    {
        $config = array();

        if ($this->_baseUrl) {
            $config['baseUrl'] = $this->_baseUrl;
        }

        if ($this->_paths) {
            $config['paths'] = $this->_paths;
        }

        if ($this->_shim) {
            $config['shim'] = $this->_shim;
        }

        return $config;
    }
}

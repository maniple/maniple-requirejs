<?php

class ManipleRequirejs_View_Helper_RequireJs extends Zend_View_Helper_Abstract
{
    /**
     * @var ManipleRequirejs_Config
     */
    protected $_config;

    /**
     * @return ManipleRequirejs_View_Helper_RequireJs
     */
    public function requireJs()
    {
        return $this;
    }

    public function register()
    {
        /** @var Zend_View_Helper_HeadScript $headScript */
        $headScript = $this->view->headScript();
        $headScript->appendFile($this->view->baseUrl('bower_components/requirejs/require.js'));
        $headScript->appendScript(sprintf(
            'require.config(%s)',
            str_replace('\\/', '/', Zend_Json::encode($this->getConfig()->toArray()))
        ));
    }

    public function getConfig()
    {
        if ($this->_config === null) {
            $this->_config = new ManipleRequirejs_Config();
            $this->_config->setBaseUrl($this->view->baseUrl('/'));
        }
        return $this->_config;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $this->register();
        return '';
    }
}

<?php

class ManipleRequirejs_View_Helper_Requirejs extends Zend_View_Helper_Abstract
{
    /**
     * Add require.js script to head
     */
    public function register()
    {
        $this->view->headScript()->appendFile($this->view->baseUrl('bower_components/requirejs/require.js'));
        // TODO check for duplicates
    }

    /**
     * @return ManipleRequirejs_View_Helper_Requirejs
     */
    public function requirejs()
    {
        return $this;
    }

    /**
     * @return string
     */
    public function toJavaScript()
    {
        // TODO
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJavaScript();
    }
}

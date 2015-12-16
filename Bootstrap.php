<?php

class ManipleRequirejs_Bootstrap extends Maniple_Application_Module_Bootstrap
{
    protected function _initView()
    {
        /** @var Zend_Application_Bootstrap_Bootstrap $bootstrap */
        $bootstrap = $this->getApplication();
        $bootstrap->bootstrap('View');

        /** @var Zend_View $view */
        $view = $bootstrap->getResource('View');
        $view->addHelperPath(dirname(__FILE__) . '/library/View/Helper/', 'ManipleRequirejs_View_Helper_');
    }
}
<?php

class ManipleRequirejs_Bootstrap extends Maniple_Application_Module_Bootstrap
{
    protected function _initAutoloader()
    {
        Zend_Loader_AutoloaderFactory::factory(array(
            'Zend_Loader_StandardAutoloader' => array(
                'prefixes' => array(
                    'ManipleRequirejs_' => dirname(__FILE__) . '/library/',
                ),
            ),
        ));
    }

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

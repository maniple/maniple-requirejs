<?php

class ManipleRequirejs_Bootstrap extends Maniple_Application_Module_Bootstrap
{
    public function getResourcesConfig()
    {
        return require __DIR__ . '/configs/resources.config.php';
    }

    public function getViewConfig()
    {
        return array(
            'helperPaths' => array(
                'ManipleRequirejs_View_Helper_' => __DIR__ . '/library/ManipleRequirejs/View/Helper/',
            ),
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend_Loader_StandardAutoloader' => array(
                'prefixes' => array(
                    'ManipleRequirejs_' => __DIR__ . '/library/ManipleRequirejs/',
                ),
            ),
        );
    }

    protected function _initHeadScript()
    {
        /** @var Maniple_Di_Container $container */
        $container = $this->getContainer();

        /** @var Zefram_View_Abstract $view */
        $view = $this->bootstrap('View')->getResource('View');
        $view->headScript()->appendScript(new ManipleRequirejs_Util_StringCallback(function () use ($container) {
            $container[ManipleRequirejs_Service::className]->appendToHeadScript();
        }), 'text/javascript', array('noescape' => true));
    }
}

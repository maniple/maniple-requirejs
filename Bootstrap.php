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
            'prefixes' => array(
                'ManipleRequirejs_' => __DIR__ . '/library/ManipleRequirejs/',
            ),
        );
    }
}

<?php

abstract class ManipleRequirejs_ServiceFactory
{
    /**
     * @param Maniple_Di_Container $container
     * @return ManipleRequirejs_Service
     */
    public static function createService(Maniple_Di_Container $container)
    {
        $service = new ManipleRequirejs_Service($container['View']);

        foreach ($container['Modules'] as $moduleBootstrap) {
            if ($moduleBootstrap instanceof ManipleRequirejs_ConfigProviderInterface
                || method_exists($moduleBootstrap, 'getRequireJsConfig')
            ) {
                $config = $moduleBootstrap->getRequireJsConfig();
                if (isset($config['paths'])) {
                    $service->addPaths($config['paths']);
                }
                if (isset($config['shim'])) {
                    $service->addShims($config['shim']);
                }
            }
        }

        return $service;
    }
}

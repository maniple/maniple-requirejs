<?php

abstract class ManipleRequirejs_ServiceFactory
{
    /**
     * @param Maniple_Di_Container $container
     * @return ManipleRequirejs_Service
     */
    public static function createService(Maniple_Di_Container $container)
    {
        return new ManipleRequirejs_Service($container->getResource('View'));
    }
}

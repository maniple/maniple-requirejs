<?php

class ManipleRequirejs_View_Helper_Requirejs extends Maniple_View_Helper_Abstract
{
    /**
     * @return ManipleRequirejs_Service
     * @throws Zend_View_Exception
     */
    public function requirejs()
    {
        /** @var Zend_Application_Bootstrap_BootstrapAbstract $bootstrap */
        $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $requirejs = $bootstrap->getResource(ManipleRequirejs_Service::className);

        if (!$requirejs instanceof ManipleRequirejs_Service) {
            throw new Zend_View_Exception('Requirejs service is not registered');
        }

        return $requirejs;
    }
}

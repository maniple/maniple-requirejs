<?php

/**
 * Interface used for indicating that module bootstrap class provides
 * a configuration array for Requirejs service.
 *
 * Example implementation:
 *
 * <pre>
 * public function getRequireJsConfig()
 * {
 *     return array(
 *         'paths' => array(
 *             'jquery' => 'bower_components/jquery/dist/jquery.min',
 *         ),
 *         'shim' => array(
 *             'backbone' => array(
 *                 'deps'    => array('underscore', 'jquery'),
 *                 'exports' => 'Backbone',
 *             ),
 *             'underscore' => array(
 *                 'exports' => '_',
 *             ),
 *             'jquery.scroll' => array('jquery'),
 *         ),
 *     );
 * }
 * </pre>
 */
interface ManipleRequirejs_ConfigProviderInterface
{
    /**
     * @return array
     */
    public function getRequireJsConfig();
}

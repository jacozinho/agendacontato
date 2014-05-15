<?php
/**
* namespace para o módulo Contato.
*/

namespace Contato;

class Module
{
    /**
    * include de arquivo para outras configuraçoes deste módulo.
    */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    /**
    * autoloader para este módulo.
    */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}

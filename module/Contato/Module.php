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
    
    /**
    *Registro da View Helper
     * 
     */
    public function getViewHelperConfig(){
        return array(
            #registro da View Helper com injecao de dependencia
            'factories' => array(
                'menuAtivo' => function($sm){
                    return new View\Helper\MenuAtivo($sm->getServiceLocator()->get('Request'));
                },
                'mensagem' => function($sm) {
                    return new View\Helper\Mensagem($sm->getServiceLocator()->get('ControllerPluginManager')->get('flashmessenger'));
                },
            )
        );
    }
}

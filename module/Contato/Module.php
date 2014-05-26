<?php
/**
* namespace para o módulo Contato.
*/

namespace Contato;

//import Model\Contato
use Contato\Model\Contato,
 Contato\Model\ContatoTable;
        
//import Zend\Db
use Zend\Db\ResultSet\ResultSet,
 Zend\Db\TableGateway\TableGateway;

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
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
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
    
    /**
     * registra serviços
     */
    public function getServiceConfig(){
        return array(
            'factories'     => array(
                'ContatoTableGateway'   => function($sm){
                    //obter adapter db atraves do service manager
//                    $adapter = $sm->get('AdapterDb');
                      $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    
                    //configurar ResultSet com o modelo Contato
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Contato());
                                        
                    //returna TableGateway configurado para o modelo Contato
                    return new TableGateway('contatos',$adapter,null,$resultSetPrototype);
                },
                'ModelContato' => function ($sm) {
                    // return instacia Model ContatoTable
                    return new ContatoTable($sm->get('ContatoTableGateway'));
                }
            )            
        );
    }    
}

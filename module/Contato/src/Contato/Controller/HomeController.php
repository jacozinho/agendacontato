<?php

/*
 * namespace de localização deste Controller
 */

namespace Contato\Controller;

//import do Zend\Mvc
use Zend\Mvc\Controller\AbstractActionController;
//import do Zend\View
use Zend\View\Model\ViewModel;
//import do Zend\Db
use Zend\Db\Adapter\Adapter as AdaptadorAlias,
    Zend\Db\Sql\Sql,
    Zend\Db\ResultSet\ResultSet;

class HomeController extends AbstractActionController {

    /**
     * action index
     * @return \Zend\View\Model\ViewModel
     */
//ESTE MÉTODO ESTÁ FUNCIONANDO PERFEITAMENTE - TESTENDO OUTRA IMPLEMENTAÇÃO
//    public function indexAction(){
//        
//        /**
//         * função anônima para var_dump estilizado
//         */
//        $myVarDump = function($nome_linha = "Nome da Linha", $data = null, $caracter = ' - '){
//            echo str_repeat($caracter, 100). '<br/>'. ucwords($nome_linha).'<pre><br/>';
//            var_dump($data);
//            echo '</pre>'. str_repeat($caracter, 100). '<br/><br/>';            
//        };
//        
//        /**
//         * conexão com o banco
//         */
//        $adapter = new \Zend\Db\Adapter\Adapter(array(
//            'driver'    => 'Pdo_Mysql',
//            'database'  => 'agenda',
//            'username'  => 'root',
//            'password'  => '123'
//        ));
//        
//        /**
//         * obter nome do schema do banco de dados
//         */
//        $myVarDump(
//                "Nome do schema",
//                $adapter->getCurrentSchema()
//        );
//        
//        /**
//         * contar quantidade de elementos da tabela
//         */
//        $myVarDump(
//                "Quantidade de elementos da tabela contatos",
//                $adapter->query("SELECT * FROM contatos")->execute()->count()
//        );
//        
//        /**
//         * montar objeto sql e executar
//         */
//        $sql            = new \Zend\Db\Sql\Sql($adapter);
//        $select         = $sql->select()->from('contatos');
//        $statement      = $sql->prepareStatementForSqlObject($select);
//        $resultsSql      = $statement->execute();
//        $myVarDump(
//                "Objeto Sql com Select executado",
//                $resultsSql
//        );
//        
//        /**
//         * montar objeto resultset com objeto sql e mostrar resultado em array
//         */
//        $resultSet      = new \Zend\Db\ResultSet\ResultSet;
//        $resultSet->initialize($resultsSql);
//        $myVarDump(
//                "Resultado do Objeto Sql para Array",
//                $resultSet->toArray()
//        );
//        
//        die();
////        return new ViewModel(); 
//    }


    public function indexAction() {

        /**
         * função anônima para var_dump estilizado
         */
//        $myVarDump = function($nome_linha = "Nome da Linha", $data = null, $caracter = ' - ') {
//            echo str_repeat($caracter, 100) . '<br/>' . ucwords($nome_linha) . '<pre><br/>';
//            var_dump($data);
//            echo '</pre>' . str_repeat($caracter, 100) . '<br/><br/>';
//        };

        /**
         * conexão com o banco
         */
//      $adapter = new \Zend\Db\Adapter\Adapter(array(
//        $adapter = new AdaptadorAlias(array(
//            'driver'    => 'Pdo_Mysql',
//            'database'  => 'agenda',
//            'username'  => 'root',
//            'password'  => '123'
//        ));
//        $adapter = $this->getServiceLocator()->get('AdapterDb');

        /**
         * obter nome do schema do banco de dados
         */
        //chamada da função  
//        $myVarDump(
//                "Nome do schema", $adapter->getCurrentSchema()
//        );
//
//        /**
//         * contar quantidade de elementos da tabela
//         */
//        //chamada da função
//        $myVarDump(
//                "Quantidade de elementos da tabela contatos", $adapter->query("SELECT * FROM contatos")->execute()->count()
//        );
//
//        /**
//         * montar objeto sql e executar
//         */
////        $sql            = new \Zend\Db\Sql\Sql($adapter);
//        $sql = new Sql($adapter);
//        $select = $sql->select()->from('contatos');
//        $statement = $sql->prepareStatementForSqlObject($select);
//        $resultsSql = $statement->execute();
//
//        //chamada da função
//        $myVarDump(
//                "Objeto Sql com Select executado", $resultsSql
//        );
//
//        /**
//         * montar objeto resultset com objeto sql e mostrar resultado em array
//         */
////        $resultSet      = new \Zend\Db\ResultSet\ResultSet;
//        $resultSet = new ResultSet;
//        $resultSet->initialize($resultsSql);
//
//        //chamada da função
//        $myVarDump(
//                "Resultado do Objeto Sql para Array", $resultSet->toArray()
//        );
//
//        die();
        return new ViewModel(); 
    }

    /**
     * action sobre
     * @return \Zend\View\Model\ViewModel
     */
    public function sobreAction() {
        return new ViewModel();
    }

//    function getServiceLocator() {
//        return $serviceManager->getServiceLocator();
//    }
}

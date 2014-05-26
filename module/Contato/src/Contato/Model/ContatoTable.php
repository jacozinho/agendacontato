<?php

//namespace da localização desse model
namespace Contato\Model;

//import Zend\Db
use //Zend\Db\Adapter\Adapter,
    //Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class ContatoTable{
    protected $tableGateway;
    
    /**
     * Construtor com dependência do Adapter do Banco
     * 
     * @param \Zend\Db\Adaptaer\Adapter $adapter
     */
    //sem injeção de dependência
//    public function __construct(Adapter $adapter) {
//        $resultSetPrototype = new ResultSet();
//        $resultSetPrototype->setArrayObjectPrototype(new Contato());
//        
//        $this->tableGateway = new TableGateway('contatos', $adapter, null, $resultSetPrototype);
//    }
    
    //com injeção de depedeência
     public function __construct(TableGateway $tableGateway) {              
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * Recupera todos os elementos da tabela contatos
     * 
     * @return Resultset
     */
    public function fetchAll(){
        return $this->tableGateway->select();
    }
    
    /**
     * Localiza linha especifica pelo id da tabela contatos
     * 
     * @param type $id
     * @return \Model\Contato
     * @throws \Exception
     */
    public function find($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row)
            throw new Exception ("Nao foi encontado o contato de id = {$id}");            
        return $row;
    }
}

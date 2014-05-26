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
    
    /**
    * Atualizar um contato existente
    *
    * @param \Contato\Model\Contato $contato
    * @throws \Exception
    */
    public function update(Contato $contato)
    {
//        $timeNow = new \DateTime();
        $timeNow = date('Y-m-d H:i:s');        

        $data = [
            'nome'                  => $contato->nome,
            'telefone_principal'    => $contato->telefone_principal,
            'telefone_secundario'   => $contato->telefone_secundario,
            'data_atualizacao'      => $timeNow,
        ];

        $id = (int) $contato->id;
        if ($this->find($id)) {
            $this->tableGateway->update($data, array('id' => $id));
        } else {
            throw new \Exception("Contato #{$id} inexistente");
        }
    }
    
    
    
    /**
    * Inserir um novo contato
    *
    * @param \Contato\Model\Contato $contato
    * @return 1/0
    */
    public function save(Contato $contato)
    {
        $timeNow = date('Y-m-d H:i:s');
        $timeNow1 = date('Y-m-d H:i:s');

        $data = [
            'nome'                  => $contato->nome,
            'telefone_principal'    => $contato->telefone_principal,
            'telefone_secundario'   => $contato->telefone_secundario,
            'data_criacao'          => $timeNow,
            'data_atualizacao'      => $timeNow1, # data de criação igual a de atualização
        ];

        return $this->tableGateway->insert($data);
    }
    
    /**
     * Deletar um contato existente
     * @param type $id
     * 
     */
    public function delete($id){
        $this->tableGateway->delete(array('id'=>(int) $id));
    }
    
}

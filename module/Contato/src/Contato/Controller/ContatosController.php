<?php

/**
 * namespace de localizacao do nosso controller
 */
namespace Contato\Controller;

// import Zend\Mvc
use Zend\Mvc\Controller\AbstractActionController;
// import Zend\View
use Zend\View\Model\ViewModel;

//import ContatoForm
use Contato\Form\ContatoForm;

// import Model\Contato
use Contato\Model\Contato;

class ContatosController extends AbstractActionController
{

    protected $contatoTable;

    // GET /contatos
    public function indexAction()
    {
        // enviar para view o array com key contatos e value com todos os contatos
        return new ViewModel(array('contatos' => $this->getContatoTable()->fetchAll()));
    }

    // GET /contatos/novo
    public function novoAction(){
        return array('formContato' => new ContatoForm());
    }

    // POST /contatos/adicionar
    public function adicionarAction()
    {
        // obtém a requisição
        $request = $this->getRequest();

        // verifica se a requisição é do tipo post
        if ($request->isPost()) {
            // obter e armazenar valores do post
//            $postData = $request->getPost()->toArray();
//            $formularioValido = true;
            
            //instancia formulário
            $form =  new ContatoForm();
            
            //instancia model contato com regras de filtros e validações
            $modelContato = new contato();
            
            //passa para o objeto formulário as regras de filtros e validações
            //contidas na entity contato
            $form->setInputFilter($modelContato->getInputFilter());
            //passa para o objeto formulário os dados vindos da submissão
            $form->setData($request->getPost());

            // verifica se o formulário segue a validação proposta
            //if ($formularioValido) {
            if($form->isValid()){
                // aqui vai a lógica para adicionar os dados à tabela no banco
                // 1 - popular model com valores do formulário
                $modelContato->exchangeArray($form->getData());
                 
                // 2 - persiste dados do model para banco de dados
                $this->getContatoTable()->save($modelContato);
                
                // adicionar mensagem de sucesso
                $this->flashMessenger()
                        ->addSuccessMessage("Contato criado com sucesso");

                // redirecionar para action index no controller contatos
                return $this->redirect()->toRoute('contatos');
            } else { //em caso da validação não seguir o que foi definido
                //renderiza para action novo com o objeto form populado,
                //com isso, os erros serão tratados pelos helpers views

                return(new ViewModel())
                    ->setVariable('formContato', $form)
                    ->setTemplate('contato/contatos/novo');
            }
        }
    }

    // GET /contatos/detalhes/id
    public function detalhesAction()
    {
        // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 0);

        // se id = 0 ou não informado redirecione para contatos
        if (!$id) {
            // adicionar mensagem
            $this->flashMessenger()->addMessage("Contato não encotrado");

            // redirecionar para action index
            return $this->redirect()->toRoute('contatos');
        }

        try {
            // aqui vai a lógica para pegar os dados referente ao contato
            // 1 - solicitar serviço para pegar o model responsável pelo find
            // 2 - solicitar form com dados desse contato encontrado
            // formulário com dados preenchidos
            $contato = (array) $this->getContatoTable()->find($id);
        } catch (\Exception $exc) {
            // adicionar mensagem
            $this->flashMessenger()->addErrorMessage($exc->getMessage());

            // redirecionar para action index
            return $this->redirect()->toRoute('contatos');
        }

        // dados eviados para detalhes.phtml
        return ['contato' => $contato];
    }

    // GET /contatos/editar/id
    public function editarAction()
    {
        // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 0);

        // se id = 0 ou não informado redirecione para contatos
        if (!$id) {
            // adicionar mensagem de erro
            $this->flashMessenger()->addMessage("Contato não encotrado");

            // redirecionar para action index
            return $this->redirect()->toRoute('contatos');
        }

        try {
            //variável com objeto contato localizado
            $contato = (array) $this->getContatoTable()->find($id);
        } catch (\Exception $exc) {
            // adicionar mensagem
            $this->flashMessenger()->addErrorMessage($exc->getMessage());

            // redirecionar para action index
            return $this->redirect()->toRoute('contatos');
        }

        //objeto form vazio
        $form = new ContatoForm();
        
        //popula objeto form contato com objeto model contato
        $form->setData($contato);
        
        // dados eviados para editar.phtml
        return ['formContato'=> $form];
    }

    // PUT /contatos/editar/id
    public function atualizarAction(){
        // obtém a requisição
        $request = $this->getRequest();

        // verifica se a requisição é do tipo post
        if ($request->isPost()) {
            
            //instancia formulário
            $form = new ContatoForm();
            
            //instancia model contato com regras de filtros e validaçoes
            $modelContato = new Contato();
            
            //passa para o objeto formulario as regras de filtros e validaçoes
            //contidas no entity contato
            $form->setInputFilter($modelContato->getInputFilter());
            
            //passa para o objeto formulario os dados vindos da submissao
            $form->setData($request->getPost());


            // verifica se o formulário segue a validação proposta
            if ($form->isValid()) {
                // aqui vai a lógica para editar os dados à tabela no banco
                // 1 - popular model com valores do formulario
                $modelContato->exchangeArray($form->getData());
                // 2 - atualizar dados do model para banco de dados
                $this->getContatoTable()->update($modelContato);
                
                // adicionar mensagem de sucesso
                $this->flashMessenger()
                        ->addSuccessMessage("Contato editado com sucesso");

                // redirecionar para action detalhes
                return $this->redirect()->toRoute('contatos', array("action" => "detalhes", "id" => $modelContato->id));
            } else { //em caso da validação não seguir o que foi definido
                //renderiza para action editar com o objeto form populado,
                //com isso, os erros serão tratados pela helpers view
                return (new ViewModel())
                    ->setVariable('formaContato', $form)
                    ->setTemplate('contato/contatos/editar');
            }
        }
    }

    // DELETE /contatos/deletar/id
    public function deletarAction()
    {
        // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 0);

        // se id = 0 ou não informado redirecione para contatos
        if (!$id) {
            // adicionar mensagem de erro
            $this->flashMessenger()->addMessage("Contato não encotrado");
        } else {
            // aqui vai a lógica para deletar o contato no banco
            // 1 - solicitar serviço para pegar o model responsável pelo delete
            // 2 - deleta contato            
            $this->getContatoTable()->delete($id);
            
            // adicionar mensagem de sucesso
            $this->flashMessenger()->addSuccessMessage("Contato de ID $id deletado com sucesso");
        }

        // redirecionar para action index
        return $this->redirect()->toRoute('contatos');
    }

    /**
     * Metodo privado para obter instacia do Model ContatoTable
     * 
     * @return \Contato\Model\ContatoTable
     */
    private function getContatoTable()
    {
        // adicionar service ModelContato a variavel de classe
        if (!$this->contatoTable)
            $this->contatoTable = $this->getServiceLocator()->get('ModelContato');

        // return vairavel de classe com service ModelContato
        return $this->contatoTable;
    }
}


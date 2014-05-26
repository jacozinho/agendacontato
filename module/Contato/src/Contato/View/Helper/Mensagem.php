<?php

namespace Contato\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Mvc\Controller\Plugin\FlashMessenger as FlashMessenger;

class Mensagem extends AbstractHelper {

    protected $flashMessenger;
    protected $mensagem;

    public function __construct(FlashMessenger $flashMessenger) {
        $this->setFlashMessenger($flashMessenger);
        $this->setMensagem();
    }

    public function __invoke() {
        return $this->renderHtml();
    }

    public function renderHtml() {
        $html = '';
        $mensagem = $this->getMensagem();

        if ($mensagem) {
            $key = key($mensagem);
            $html .= '<div id="alert-message">';
            $html .= '<div class="' . $key . ' alert-block fade in">';
            $html .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            $html .= $mensagem[$key];
            $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
    }

    public function getFlashMessenger() {
        return $this->flashMessenger;
    }

    public function setFlashMessenger($flashMessenger) {
        $this->flashMessenger = $flashMessenger;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function setMensagem() {
        $flashMessenger = $this->getFlashMessenger();

        if ($flashMessenger->hasMessages()) {
            $message = $flashMessenger->getMessages();
            $this->mensagem = array('alert alert-warning' => array_shift($message));
        }

        if ($flashMessenger->hasInfoMessages()) {
            $messageInfo = $flashMessenger->getInfoMessages();
            $this->mensagem = array('alert alert-info' => array_shift($messageInfo));
        }

        if ($flashMessenger->hasSuccessMessages()) {
            $messageSuccess = $flashMessenger->getSuccessMessages();
            $this->mensagem = array('alert alert-success' => array_shift($messageSuccess));
        }

        if ($flashMessenger->hasErrorMessages()) {
            $messageError = $flashMessenger->getErrorMessages();
            $this->mensagem = array('alert alert-danger' => array_shift($messageError));
        }
    }
}

/**
efeito alert
*/ 

$(function(){
    //pegar elemento com corpo da mensagem
    var corpo_alert = $('#alert-message');

    //verifica se o elemento está presente na página
    if(corpo_alert.length)
        //gerar efeito para o elemento encontrado na página
        corpo_alert.fadeOut().fadeIn().fadeOut().fadeIn();	
});

/**
* mask input
*/
$(function (){
    // mascara para telefone: (xx)xxxx-xxxxx
    $("input#inputTelefonePrincipal, input#inputTelefoneSecundario").mask("(99)9999-9999");
    
    // mascara para captcha com 12 caracteres apenas alfabéticos: xxxxxxxxxxxx
    $("input#inputCaptcha").mask("a");
});
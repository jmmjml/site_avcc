console.log('cadastroevento.js');
/* Atribui ao evento submit do formulário a função de validação de dados*/
var form = document.getElementById("form-contato");
if (form != null && form.addEventListener) {
    form.addEventListener("submit", validaCadastro);
}
else if (form != null && form.attachEvent) {
    form.attachEvent("onsubmit", validaCadastro);
}


/* Atribui ao evento keypress do input data de nascimento a função para formatar o data (dd/mm/yyyy) */
var inputData = document.getElementById("data");
if (inputData != null && inputData.addEventListener) {
    inputData.addEventListener("keypress", function () { mascaraTexto(this, '##/##/####') });
}
else if (inputData != null && inputData.attachEvent) {
    inputData.attachEvent("onkeypress", function () { mascaraTexto(this, '##/##/####') });
}

/* Atribui ao evento keypress do input celular a função para formatar o Celular (00 00000-0000) */
var inputCelular = document.getElementById("celular");
if (inputCelular != null && inputCelular.addEventListener) {
    inputCelular.addEventListener("keypress", function () { mascaraTexto(this, '## #####-####') });
}
else if (inputCelular != null && inputCelular.attachEvent) {
    inputCelular.attachEvent("onkeypress", function () { mascaraTexto(this, '## #####-####') });
}


/* Atribui ao evento click do link de exclusão na página de consulta a função confirmaExclusao */
var linkExclusao = document.querySelectorAll(".link_exclusao");
if (linkExclusao != null){
    for (var i = 0; i < linkExclusao.length; i++){
        (function(i){
            var id_produto = linkExclusao[i].getAttribute("rel");
            if(linkExclusao[i].addEventListener){
                linkExclusao[i].addEventListener("click", function(){confirmaExclusao(id_produto);});
            }else if (linkExclusao[i].attachEvent){
                linkExclusao[i].attachEvent("onclick", function(){confirmaExclusao(id_produto);});
            }
        })(i);
    }
}

/* função para validar os dados antes da submissão dos dados */
function validaCadastro(evt) {
    var nomeevento = document.getElementById("nomeevento");
    var nometitular = document.getElementById("nometitular");
    var data_evento = document.getElementById("data");
    var descricao = document.getElementById("descricao");
    var status = document.getElementById("status");
    var celular = document.getElementById("celular");
    var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var contErro = 0;

    /* Validação do campo nome do evento */
    caixa_nomeevento = document.querySelector(".msg-nomeevento");
    if (nomeevento.value == "") {
        caixa_nomeevento.innerHTML = "Favor preencher o Nome do Evento";
        caixa_nomeevento.style.display = 'block';
        contErro += 1;
    } else {
        caixa_nomeevento.style.display = 'none';
    }

    /* Validação do campo nome do titular */
    caixa_nometitular = document.querySelector(".msg-nometitular");
    if (nometitular.value == "") {
        caixa_nometitular.innerHTML = "Favor preencher o Nome do Titular do evento";
        caixa_nometitular.style.display = 'block';
        contErro += 1;
    } else {
        caixa_nometitular.style.display = 'none';
    }


    /* Validação do campo data */
    caixa_data = document.querySelector(".msg-data");
    if (data_evento.value == "") {
        caixa_data.innerHTML = "Favor preencher a Data do evento";
        caixa_data.style.display = 'block';
        contErro += 1;
    } else {
        caixa_data.style.display = 'none';
    }


    /* Validação do campo celular */
    caixa_celular = document.querySelector(".msg-celular");
    if (celular.value == "") {
        caixa_celular.innerHTML = "Favor preencher o Celular";
        caixa_celular.style.display = 'block';
        contErro += 1;
    } else {
        caixa_celular.style.display = 'none';
    }

    /* Validação do campo status */
    caixa_status = document.querySelector(".msg-status");
    if (status.value == "") {
        caixa_status.innerHTML = "Favor selecionar o Status";
        caixa_status.style.display = 'block';
        contErro += 1;
    } else {
        caixa_status.style.display = 'none';
    }

    /* Validação do campo descrição */
    caixa_descricao = document.querySelector(".msg-descricao");
    if (descricao.value == "") {
        caixa_descricao.innerHTML = "Favor selecionar a Descrição";
        caixa_descricao.style.display = 'block';
        contErro += 1;
    } else {
        caixa_descricao.style.display = 'none';
    }
    
    if (contErro > 0) {
        evt.preventDefault();
    }
}

/* Função para formatar dados conforme parâmetro enviado, CPF, DATA, TELEFONE e CELULAR */
function mascaraTexto(t, mask) {
    var i = t.value.length;
    var saida = mask.substring(1, 0);
    var texto = mask.substring(i);

    if (texto.substring(0, 1) != saida) {
        t.value += texto.substring(0, 1);
    }
}

/* Função para exibir um alert confirmando a exclusão do registro */
function confirmaExclusao(id){
    retorno = confirm("Deseja excluir esse Registro?")

    if(retorno){

        // Cria um formulário
        var formulario = document.createElement("form");
        formulario.action = "action_evento.php";
        formulario.method = "post";

        // Cria os inputs e adiciona ao formulário
        var inputAcao = document.createElement("input");
        inputAcao.type = "hidden";
        inputAcao.value = "excluir";
        inputAcao.name = "acao";
        formulario.appendChild(inputAcao);
        
        var inputId = document.createElement("input");
        inputId.type = "hidden";
        inputId.value = id;
        inputId.name = "id";
        formulario.appendChild(inputId);

        // Adiciona o formulário ao corpo do documento
        document.body.appendChild(formulario);

        // Envia o formulário
        formulario.submit();
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const whatsappLinks = document.querySelectorAll('.link_whatsapp');

    whatsappLinks.forEach(link => {
        link.addEventListener('click', function() {
            const celular = this.getAttribute('data-celular');
            const ddd = celular.substring(0, 2);
            const numero = celular.substring(2);
            const mensagem = "Olá, gostaria de mais informações sobre o evento.";
            const url = `https://wa.me/55${ddd}${numero}?text=${encodeURIComponent(mensagem)}`;

            window.open(url, '_blank');
        });
    });
});
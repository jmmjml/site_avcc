/* Atribui ao evento submit do formulário a função de validação de dados*/
var form = document.getElementById("form-contato");
if (form != null && form.addEventListener) {
    form.addEventListener("submit", validaCadastro);
}
else if (form != null && form.attachEvent) {
    form.attachEvent("onsubmit", validaCadastro);
}


/* Atribui ao evento keypress do input data de nascimento a função para formatar o data (dd/mm/yyyy) */
var inputDataNascimento = document.getElementById("data_nascimento");
if (inputDataNascimento != null && inputDataNascimento.addEventListener) {
    inputDataNascimento.addEventListener("keypress", function () { mascaraTexto(this, '##/##/####') });
}
else if (inputDataNascimento != null && inputDataNascimento.attachEvent) {
    inputDataNascimento.attachEvent("onkeypress", function () { mascaraTexto(this, '##/##/####') });
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
            var id_cliente = linkExclusao[i].getAttribute("rel");
            if(linkExclusao[i].addEventListener){
                linkExclusao[i].addEventListener("click", function(){confirmaExclusao(id_cliente);});
            }else if (linkExclusao[i].attachEvent){
                linkExclusao[i].attachEvent("onclick", function(){confirmaExclusao(id_cliente);});
            }
        })(i);
    }
}

/* função para validar os dados antes da submissão dos dados */
function validaCadastro(evt) {
    var nome = document.getElementById("nome");
    var nomedoador = document.getElementById("data_nascimento");
    var tipo = document.getElementById("disponibilidade");
    var valor = document.getElementById("cargo");
    var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var contErro = 0;

    /* Validação do campo nome */
    caixa_nome = document.querySelector(".msg-nome");
    if (nome.value == "") {
        caixa_nome.innerHTML = "Favor preencher o Nome";
        caixa_nome.style.display = 'block';
        contErro += 1;
    } else {
        caixa_nome.style.display = 'none';
    }

    /* Validação do campo data_nascimento */
    caixa_nomedoador = document.querySelector(".msg-nomedoador");
    if (nomedoador.value == "") {
        caixa_nomedoador.innerHTML = "Favor preencher a Data de Nascimento";
        caixa_nomedoador.style.display = 'block';
        contErro += 1;
    } else {
        caixa_nomedoador.style.display = 'none';
    }


    /* Validação do campo tipo */
    caixa_tipo = document.querySelector(".msg-tipo");
    if (tipo.value == "") {
        caixa_tipo.innerHTML = "Favor preencher o tipo";
        caixa_tipo.style.display = 'block';
        contErro += 1;
    } else {
        caixa_tipo.style.display = 'none';
    }

    /* Validação do campo valor */
    caixa_valor = document.querySelector(".msg-valor");
    if (valor.value == "") {
        caixa_valor.innerHTML = "Favor selecionar o valor";
        caixa_valor.style.display = 'block';
        contErro += 1;
    } else {
        caixa_valor.style.display = 'none';
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
        formulario.action = "action_doacao.php";
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
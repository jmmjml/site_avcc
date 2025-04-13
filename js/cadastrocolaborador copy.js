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
    var data_nascimento = document.getElementById("data_nascimento");
    var disponibilidade = document.getElementById("disponibilidade");
    var cargo = document.getElementById("cargo");
    var senha = document.getElementById("senha");
    var celular = document.getElementById("celular");
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
    caixa_data = document.querySelector(".msg-data");
    if (data_nascimento.value == "") {
        caixa_data.innerHTML = "Favor preencher a Data de Nascimento";
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

    /* Validação do campo cargo */
    caixa_cargo = document.querySelector(".msg-cargo");
    if (cargo.value == "") {
        caixa_cargo.innerHTML = "Favor selecionar o Cargo";
        caixa_cargo.style.display = 'block';
        contErro += 1;
    } else {
        caixa_cargo.style.display = 'none';
    }

    /* Validação do campo disponibilidade */
    caixa_disponibilidade = document.querySelector(".msg-cargo");
    if (disponibilidade.value == "") {
        caixa_disponibilidade.innerHTML = "Favor selecionar o Disponibilidade";
        caixa_disponibilidade.style.display = 'block';
        contErro += 1;
    } else {
        caixa_disponibilidade.style.display = 'none';
    }

    /* Validação do campo cargo */
    caixa_senha = document.querySelector(".msg-senha");
    if (senha.value == "") {
        caixa_senha.innerHTML = "Favor preencher a senha";
        caixa_senha.style.display = 'block';
        contErro += 1;
    } else {
        caixa_senha.style.display = 'none';
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
        formulario.action = "action_colaborador.php";
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
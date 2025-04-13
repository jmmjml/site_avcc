/* Atribui ao evento submit do formulário a função de validação de dados*/
var form = document.getElementById("form-contato");
if (form != null && form.addEventListener) {
    form.addEventListener("submit", validaCadastro);
}
else if (form != null && form.attachEvent) {
    form.attachEvent("onsubmit", validaCadastro);
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
    var titulo = document.getElementById("titulo");
    var texto = document.getElementById("texto");
    var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var contErro = 0;

    /* Validação do campo título */
    caixa_titulo = document.querySelector(".msg-titulo");
    if (titulo.value == "") {
        caixa_titulo.innerHTML = "Favor preencher o Título";
        caixa_titulo.style.display = 'block';
        contErro += 1;
    } else {
        caixa_titulo.style.display = 'none';
    }


    /* Validação do campo celular */
    caixa_texto = document.querySelector(".msg-texto");
    if (texto.value == "") {
        caixa_texto.innerHTML = "Favor preencher o Texto";
        caixa_texto.style.display = 'block';
        contErro += 1;
    } else {
        caixa_celular.style.display = 'none';
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
        formulario.action = "action_noticia.php";
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
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
	var elems = document.querySelectorAll('.modal');
	var elems = document.querySelectorAll('select');
	var elems = document.querySelectorAll('.sidenav');
    //var instances = M.Collapsible.init(elems, options);
  });
  

function validar(){
	var usuario = $("#usuarioCad").val();
	var senha = $("#senha").val();
	var senhaConf = $("#senhaConf").val();
	var rasaoSocial = $("#rasaoSocial").val();
	var cnpj = $("#cnpj").val();
	var rua = $("#rua").val();
	var numeroCasa = $("#numeroCasa").val();
	var bairro = $("#bairro").val();
	var telefone = $("#telefone").val();
	var cidade = $("#cidades").val();
	var uf = $("#estados").val();
    if (verificarVazio(usuario) || verificarVazio(senha) || verificarVazio(senhaConf) || verificarVazio(rasaoSocial) || verificarVazio(cnpj) || verificarVazio(rua)
	 || verificarVazio(numeroCasa) || verificarVazio(bairro) || verificarVazio(telefone) || verificarVazio(cidade) || verificarVazio(uf)){
        alert("Preencha todos os campos!");
		return false;
    }else	
	if(cidade==null || uf==null){
		alert("Preencha todos os campos!");
		return false;
	}
	if(!verificarSenha()){
		alert("Senhas diferentes!");
	}else
	if(!validarCNPJ(cnpj)){
		alert("CNPJ inválido");
	}else{
		$('#cadastro').submit();
	}
	
}
function atualizarCadastro(){
	var cnpj = $("#cnpj").val();
	if(!validarCNPJ(cnpj)){
		alert("CNPJ inválido");
	}else{
		$('#cadastro').submit();
	}
}

function verificarVazio(campo){
	if (campo == "" || campo == null){
		return true;
	}
	return false;
}

function excluirArquivo(a,b){
	$("#nomeArquivo").val(b);
	$("#exclusao").val(a);
	$("#formArquivos").submit();
}
function verificarSenha(){
	if ($("#senha").val() === $("#senhaConf").val()){
		return true;
	}
	return false;
}

function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
    
}
function reprovar(){
	$.ajax({
            url:'DAO.php',
            type:'post',
            data: {msg : $('#textarea2').val(), idf : $('#idF').val(), linkAux : $("input[name='link']:checked").val()},
            success: function (data){
				alert('Salvo');
				history.go(0);
            }
        });
}
function aprovar(){
	$.ajax({
            url:'DAO.php',
            type:'post',
            data: {idAprovado : $('#idF').val()},
            success: function (data){
				alert('Salvo');
				history.go(0);
            }
        });
}
function historico(){
	$('#campoAddAdm').remove();
	$('.modal-footer').remove();
	$.ajax({
            url:'search.php',
            type:'post',
            data: {historico : $('#idF').val()},
            success: function (data){
				var $modal = 
					  $("#modal")
						.empty()
						.html(' ');
				$modal.append("<div class='modal-content' id='modal'>"+data+"<div class='modal-footer'><a class='modal-close waves-effect waves-red btn-flat'>Fechar</a></div>");
            }
        });
}
$(document).ready(function(){
	setInterval(function(){noti(1)}, 10000);
	$('input#input_text, textarea#textarea2').characterCounter();
	$('select').formSelect();
	$('.sidenav').sidenav();
	$(".dropdown-trigger").dropdown();
	$('.collapsible').collapsible();
	$('.modal').modal();
	$('#estados').on('change', function(){        
        $.ajax({
            url:'search.php',
            type:'post',
            data: {estados : $('#estados').val()},
            success: function (data){
				var $selectDropdown = 
					  $("#cidades")
						.empty()
						.html(' ');
				
				$selectDropdown.append("<option value='' disabled selected>Selecione uma cidade</option>");
				$selectDropdown.append(data);
				$selectDropdown.trigger('contentChanged');
				$('select').formSelect();
            }
        });
    });
    $('.notif').on('click',function(e){
        e.preventDefault();
		notificacoes = 1;
        $.ajax({
            url:'search.php',
			dataType: 'html',
            type:'post',
            data: {notificacoes : notificacoes},
            success: function (data){
				$('#campoAddAdm3').remove();
				$('.modal-footer3').remove();
				$("#modal3").html(data+"<div class='modal-footer3'><a class='modal-close waves-effect waves-red btn-flat right' onclick='noti(1);'>Fechar</a></div>");
				noti(1);
            }
        });
    });
   $(document).on("focus", ".tel", function(){
      $.mask.definitions['~']='[+-]';
	//Inicio Mascara Telefone
	$('.tel').focusout(function(){
		var phone, element;
		element = $(this);
		element.unmask();
		phone = element.val().replace(/\D/g, '');
		if(phone.length > 10) {
			element.mask("(99) 99999-999?9");
		} else {
			element.mask("(99) 9999-9999?9");
		}
	}).trigger('focusout');
   });
   $(document).on("focus", ".cpf", function(){
   $.mask.definitions['~']='[+-]';
	//Inicio Mascara CNPJ
	$('.cpf').focusout(function(){
		var phone, element;
		element = $(this);
		element.unmask();
		phone = element.val().replace(/\D/g, '');
		if(phone.length > 10) {
			element.mask("999.999.999-99");
		} else {
			element.mask("999.999.999-99");
		}
	}).trigger('focusout');
   });
   $(document).on("focus", ".cnpj", function(){
		$.mask.definitions['~']='[+-]';
	//Inicio Mascara CNPJ
	$('.cnpj').focusout(function(){
		var phone, element;
		element = $(this);
		element.unmask();
		phone = element.val().replace(/\D/g, '');
		if(phone.length > 10) {
			element.mask("99.999.999/9999-99");
		} else {
			element.mask("99.999.999/9999-99");
		}
	}).trigger('focusout');
   });
});
function noti(a){
	$.ajax({
		url:'search.php',
		dataType: 'html',
		type:'post',
		data: {noti : a},
		success: function (data){
			$('.bbb').remove();
			$(".notif").html("<a>Notificações"+data+"</a>");
		}
	});
}
function VisualizatNotificacao(a){
	$.ajax({
		url:'search.php',
		type:'post',
		data: {visto : a},
		success: function (data){
			window.open('visualizarAdm.php?idF='+a, '_blank');
		}
	});
}
function reprovarCad(){
	$('.modal-footer').remove();
	$('#modal').remove();
	$('#modal1').append("<div class='modal-content' id='modal'><div id='campoAddAdm'><h6>Justificativa</h6><p><textarea id='textarea2' class='materialize-textarea' data-length='2000'></textarea><label for='Justificativa'>Caracteres</label><br><br><h6 id='cabeca'>Links para auxílio<i class='material-icons left'>link</i></h6><label><br><input class='with-gap' name='link' type='radio' value='1' class='radio' /><span>Inserir documentos</span></label><br><label><input class='with-gap' name='link' type='radio' value='2' class='radio' /><span>Alterar dados de cadastro</span></label><br><label><input class='with-gap' name='link' type='radio' class='radio' value='3' /><span>Excluir documentos</span></label></p></div></div><div class='modal-footer'><a href='#' class='modal-close waves-effect waves-green btn-flat'>Cancelar</a><button data-target='modal1' class='modal-close waves-effect waves-green btn-flat' onclick='reprovar();'>Confirmar</button></div>");
	$('input#input_text, textarea#textarea2').characterCounter();
}
function aprovarCad(){
	$('.modal-footer').remove();
	$('#modal').remove();
	$('#modal1').append("<div class='modal-content' id='modal'><div id='campoAddAdm'><h6 class='center'>Você realmente deseja aprovar este cadastro?</h6><p></p></div></div><div class='modal-footer'><a href='#' class='modal-close waves-effect waves-green btn-flat'>Cancelar</a><button data-target='modal1' class='modal-close waves-effect waves-green btn-flat' onclick='aprovar();'>Confirmar</button></div>");
}
function editar(){
	$("input.validate").prop("disabled", false);
	$("#estados").prop("disabled", false);
	$("#cidades").prop("disabled", false);
	$('select').formSelect();
	$('#op').append("<div class='green left btn waves-effect waves-light center block' id='buttonMais' onclick='adicionarCampos()'>Adicionar<i class='add material-icons center'>add_circle</i></div>");
	$('#cadastro').append("<button class='green right btn waves-effect waves-light block' type='button' name='action' onclick='atualizarCadastro()'>Atualizar<i class='material-icons right'>update</i></button>");
	$('#editButton').remove();
}
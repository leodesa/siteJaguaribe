document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
  
   document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('select').formSelect();
  });
  $(".dropdown-trigger").dropdown();
  
   document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, options);
  });

  // Initialize collapsible (uncomment the lines below if you use the dropdown variation)
  // var collapsibleElem = document.querySelector('.collapsible');
  // var collapsibleInstance = M.Collapsible.init(collapsibleElem, options);

  // Or with jQuery

  $(document).ready(function(){
    $('.sidenav').sidenav();
  });
  
  $(document).ready(function() {
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
	var cidade = $("#cidade").val();
	var uf = $("#uf").val();
    if (verificarVazio(usuario) || verificarVazio(senha) || verificarVazio(senhaConf) || verificarVazio(rasaoSocial) || verificarVazio(cnpj) || verificarVazio(rua)
	 || verificarVazio(numeroCasa) || verificarVazio(bairro) || verificarVazio(telefone) || verificarVazio(cidade) || verificarVazio(uf)){
        alert("Preencha todos os campos!");
    }else
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
	if (campo == ""){
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
function editar(){
	$("input.validate").prop("disabled", false);
	$("#estados").prop("disabled", false);
	$("#cidades").prop("disabled", false);
	$('select').formSelect();
	$('#op').append("<div class='green left btn waves-effect waves-light center block' id='buttonMais' onclick='adicionarCampos()'>Adicionar<i class='add material-icons center'>add_circle</i></div>");
	$('#cadastro').append("<button class='green right btn waves-effect waves-light block' type='button' name='action' onclick='atualizarCadastro()'>Atualizar<i class='material-icons right'>update</i></button>");
	$('#editButton').remove();
}
(function($){
  $(function(){

    $('.sidenav').sidenav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

function validar(){
	usuario = cadastro.usuario.value;
	senha = cadastro.password.value;
	confSenha = cadastro.passwordConf.value;
	rasaoSocial = cadastro.rasaoSocial.value;
	cnpj = cadastro.cnpj.value;
	rua = cadastro.rua.value;
	numeroCasa = cadastro.numeroCasa.value;
	bairro = cadastro.bairro.value;
	cidade = cadastro.cidade.value;
	telefone = cadastro.telefone.value;
	uf = cadastro.uf.value;

	if (verificarVazio(usuario) || verificarVazio(senha) || verificarVazio(confSenha)
	 || verificarVazio(rasaoSocial) || verificarVazio(cnpj) || verificarVazio(rua)
	 || verificarVazio(numeroCasa) || verificarVazio(bairro) || verificarVazio(cidade)
	 || verificarVazio(telefone) || verificarVazio(uf)){
		alert('Todos os capos com "*" devem ser preenchidos.')
	}

	if (senha != confSenha){
		alert('Senhas Diferentes!')
	}
}

function verificarVazio(campo){
	if (campo == ''){
		return true;
	}
	return false;
}
(function($){
  $(function(){

    $('.sidenav').sidenav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

function validar(){
	usuario = cadastro.usuario.value;
	senha = cadastro.password.value;
	confSenha = cadastro.passwordConf.value;

	if (verificarVazio(usuario) || verificarVazio(senha) || verificarVazio(confSenha)) {
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
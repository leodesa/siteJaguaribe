(function($){
  $(function(){

    $('.sidenav').sidenav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

function validar(){
	usuario = form1.usuario.value;
	verificarVazio(usuario);
	senha = form1.password.value;
	verificarVazio(senha);
	confSenha = form1.passwordConf.value;
	verificarVazio(confSenha);

	if (senha != confSenha){
		alert('Senhas Diferentes!')
	}
}

function verificarVazio(campo){
	if (campo == ''){
		alert('Campos com "*" devem ser preenchidos')
	}
}
usuario = "";
senha = "";
confSenha = "";
rasaoSocial = "";
cnpj = "";
rua = "";
numeroCasa = "";
bairro = "";
cidade = "";
telefone = "";
uf = "";
usuario = cadastro.usuario.value;
senha = cadastro.senha.value;
confSenha = cadastro.confSenha.value;
rasaoSocial = cadastro.rasaoSocial.value;
cnpj = cadastro.cnpj.value;
rua = cadastro.rua.value;
numeroCasa = cadastro.numeroCasa.value;
bairro = cadastro.bairro.value;
cidade = cadastro.cidade.value;
telefone = cadastro.telefone.value;
uf = cadastro.uf.value;
function validar(){
    alert(usuario);
    if ((verificarVazio(usuario)) || (verificarVazio(senha)) || (verificarVazio(confSenha))
     || (verificarVazio(rasaoSocial)) || (verificarVazio(cnpj)) || (verificarVazio(rua))
     || (verificarVazio(numeroCasa)) || (verificarVazio(bairro)) || (verificarVazio(cidade))
     || (verificarVazio(telefone)) || (verificarVazio(uf))){
        alert('Todos os campos com "*" devem ser preenchidos.')
    }
    else{
        if (!validarCNPJ(cnpj)) {
            alert('CNPJ invalido')
        }
        else{
            if (verificarSenha()) {
                alert('Senhas Diferentes!')
            }
            else{
                cadastro.submit;
            }    
        }        
    }   
}

function verificarVazio(campo){
	if (campo == ""){
		return true;
	}
	return false;
}

function verificarSenha(){
	if (senha != confSenha){
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
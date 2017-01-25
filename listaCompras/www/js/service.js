angular.module('app.service', ['ngStorage'])

.service('webservice', function($http, $timeout, $window, $localStorage){
	var _getToken = function(){
		if($localStorage.token){
			return $localStorage.token;
		}else{
			return false;
		}
	};
	var _login = function(usuario, scope){
		var url = 'http://localhost:8000/api/entrar';
		var headers = {'Content-Type': 'application/x-www-form-urlencoded'};
		$http.post(url, 'email='+usuario.email+'&password='+usuario.senha, {headers: headers}).then(function(retorno){
			if(retorno.status == 200){
				dados = retorno.data;
				console.log(dados);
				if(dados.status){
					var user = dados.data;
					$localStorage.usuario = user;
					$localStorage.token = user.api_token;
					scope.msg = "Login realizado com sucesso!";

					$timeout(function(){
						scope.msg = "";
						$window.location.href='/#/app/lista';
					}, 1000);
				} else{
					scope.msg = dados.data;
				}
			}else{
				alert("Confira sua conexão");
				return;
			}
		})
	};
	var _cadastro = function(){
		$localStorage.teste = 'Implementando com ngStorage';
		return 'Dados do cadastro';
	};
	return {
		getToken: _getToken,
		login: _login,
		cadastro: _cadastro
	}
})
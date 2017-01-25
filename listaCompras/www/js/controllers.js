angular.module('app.controllers', [])

.controller('LoginCtrl', function($scope, $window, webservice){
  if(!webservice.getToken()){
  	$window.location.href = '#/app/lista';
  }
  $scope.entrar = function(usuario){
    console.log(usuario);
    webservice.login(usuario, $scope);
  };

})

.controller('CadastroCtrl', function($scope, $window, webservice){
  $scope.cadastro = function(usuario){
    console.log(usuario);
  };

})

.controller('PerfilCtrl', function($scope){
  $scope.usuario = {id: 1, nome: 'Fagner', email: 'fagner@teste.com', api_token: 'etwetre'};
  $scope.editarPerfil = function(id){
      alert('Perfil atualizado');
  };

})

.controller('MenuCtrl', function($scope){
  $scope.sair = function(){
      alert('Sair');
  };

})

.controller('ListaCtrl', function($scope, $ionicListDelegate, $window, webservice){
  if(!webservice.getToken()){
  	$window.location.href = '#/basico/login';
  }
  $scope.compras = [
    {id: 1, titulo: 'Super Mais', descricao: 'Compras do mês'}
  ];
  $scope.editarLista = function(id){
    $ionicListDelegate.closeOptionButtons();
    $window.location.href = '/#/app/editar/principal/'+id;
  };

})

.controller('DetalheCtrl', function($scope, $stateParams, $ionicListDelegate, $window){
  console.log($stateParams.detalheId);
  $scope.itens = [
    {id: 1, id_compra:1, titulo: 'Cerveja', descricao: 'Latão', valor:2.99, valor_format:'2.99'}
  ];
  $scope.editarDetalhe = function(id){
    $ionicListDelegate.closeOptionButtons();
    $window.location.href = '/#/app/editar/detalhe/'+id;
  };

})

.controller('AdicionarCtrl', function($scope, $stateParams){
  console.log($stateParams.pagina);
  $scope.pagina = $stateParams.pagina;

  if($stateParams.pagina == 'principal'){
    $scope.titulo = "Adicionar Lista";
  }else{
    $scope.titulo = "Adicionar Compra";
  }

  $scope.addLista = function(lista){
    alert('Lista Adicionada');
  };
  $scope.addCompra = function(lista){
    alert('Compra Adicionada');
  };
  
})

.controller('EditarCtrl', function($scope, $stateParams){
  console.log($stateParams.pagina);
  $scope.pagina = $stateParams.pagina;

  if($stateParams.pagina == 'principal'){
    $scope.titulo = "Editar Lista";
    $scope.lista = {id: 1, titulo: 'Super Mais', descricao: 'Compras do mês'};
  }else{
    $scope.titulo = "Editar Compra";
    $scope.compra = {id: 1, id_compra:1, titulo: 'Cerveja', descricao: 'Latão', valor_format:'2.99'};
  }

  $scope.editarLista = function(lista){
    alert('Lista Editada');
  };
  $scope.editarCompra = function(lista){
    alert('Compra Editada');
  };
  
})
// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic', 'app.controllers'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})

.config(function($stateProvider, $urlRouterProvider){
  $stateProvider
  .state('app', {
    url:'/app',
    abstract:true,
    templateUrl:'templates/menu.html',
    controller: 'MenuCtrl'
  })

  .state('basico', {
    url:'/basico',
    abstract:true,
    templateUrl:'templates/basico.html'
  })

  .state('basico.login', {
    url:'/login',
    views:{
        'menuContent':{
            templateUrl:'templates/login.html',
            controller:'LoginCtrl'
          }
      }
  })

  .state('basico.cadastro', {
    url:'/cadastro',
    views:{
        'menuContent':{
            templateUrl:'templates/cadastro.html',
            controller:'CadastroCtrl'
          }
      }
  })

  .state('app.perfil', {
    url:'/perfil',
    views:{
        'menuContent':{
            templateUrl:'templates/perfil.html',
            controller:'PerfilCtrl'
          }
      }
  })

  .state('app.lista', {
    url:'/lista',
    views:{
        'menuContent':{
            templateUrl:'templates/lista.html',
            controller:'ListaCtrl'
          }
      }
  })

  .state('app.adicionar', {
    url:'/adicionar/:pagina',
    views:{
        'menuContent':{
            templateUrl:'templates/adicionar.html',
            controller:'AdicionarCtrl'
          }
      }
  })

  .state('app.editar', {
    url:'/editar/:pagina/:id',
    views:{
        'menuContent':{
            templateUrl:'templates/editar.html',
            controller:'EditarCtrl'
          }
      }
  })

  .state('app.detalhe', {
    url:'/detalhe/:detalheId',
    views:{
        'menuContent':{
            templateUrl:'templates/detalhe.html',
            controller:'DetalheCtrl'
          }
      }
  });

  $urlRouterProvider.otherwise('/app/lista');
})



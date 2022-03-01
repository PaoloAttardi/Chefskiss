define([
    'jquery',
    'underscore',
    'backbone',
    'View/HomeRicetteView',
    'View/HomePostView',
    'View/FooterView',
    'View/RicetteView',
    'View/ForumView',
    'View/ProfiloView',
    'View/RicettaView',
    'View/PostView',
    'View/RegistrazioneView',
    'View/NuovaRicettaView',
    'View/NuovaDomandaView',
    'View/ModificaProfiloView',
    'View/ModificaRicettaView',
    'View/LoginView',
    'View/ProfiloUtenteView',
    'View/ErrorView'
  ], function($, _, Backbone, HomeRicette, HomePost, FooterView, RicetteView,
             ForumView, ProfiloView, RicettaView, PostView, RegistrazioneView, NuovaRicettaView, NuovaDomandaView,
               ModificaProfiloView, ModificaRicettaView, LoginView, ProfiloUtenteView, ErrorView) {
  
    var AppRouter = Backbone.Router.extend({
      routes: {
        // Define some URL routes
        'Registrazione': 'showFormRegistrazione',

        'Ricetta/:id':'showRicetta',

        'Post/:id':'showPost',

        'Ricette/:page/:search': 'showRicette',

        'Forum/:search': 'showForum',

        'Profilo/:page': 'showProfilo',

        'NuovaRicetta': 'showNewRicetta',

        'NuovaDomanda': 'showNewDomanda',

        'ProfiloUtente/:id':'profiloUtente',

        'ModificaProfilo':'showModificaProfilo',

        'ModificaRicetta/:id':'showModificaRicetta',

        'Login/:state':'showLogin',

        // Default
        '*actions': 'defaultAction',

        'error':'error'

      }
    });
      
    var initialize = function(){

        var app_router = new AppRouter;

        app_router.on('route:error', function(){
            $(window).off('scroll');
            $('#page2').attr('style', 'display: none');
            var erroreView= new ErrorView();
        })

        app_router.on('route:profiloUtente', function(id){
            $(window).off('scroll');
            $('#page2').attr('style', 'display: none');
            var profiloUtenteView= new ProfiloUtenteView(id);
        })

        app_router.on('route:showLogin', function(state){
            $(window).off('scroll');
            $('#page2').attr('style', 'display: none');
            var loginView= new LoginView(state);
        })

        app_router.on('route:showRicette', function(page, search){  
          $(window).off('scroll'); 
          $('#page2').attr('style', 'display: none');
          var ricetteView = new RicetteView(page, search);
        })

        app_router.on('route:showRicetta', function(id){
          $(window).off('scroll');
          $('#page2').attr('style', 'display: none');
          var ricettaView = new RicettaView(id);
        })

        app_router.on('route:showNewRicetta', function(){
          $(window).off('scroll');
          $('#page2').attr('style', 'display: none');
          var nuovaRicetta = new NuovaRicettaView();
        })

        app_router.on('route:showNewDomanda', function(){
          $(window).off('scroll');
          $('#page2').attr('style', 'display: none');
          var nuovaDomanda = new NuovaDomandaView();
        })

        app_router.on('route:showFormRegistrazione', function(){
          $(window).off('scroll');
          $('#page2').attr('style', 'display: none');
          var registrazioneView = new RegistrazioneView();
        })

        app_router.on('route:showModificaProfilo', function(){
            $(window).off('scroll');
            $('#page2').attr('style', 'display: none');
            var modificaProfiloView = new ModificaProfiloView();
        })

        app_router.on('route:showModificaRicetta', function(id){
            $(window).off('scroll');
            $('#page2').attr('style', 'display: none');
            var modificaRicettaView = new ModificaRicettaView(id);
        })

        app_router.on('route:showPost', function(id){
          $(window).off('scroll');
          $('#page2').attr('style', 'display: none');
          var postView= new PostView(id);
        })

        app_router.on('route:defaultAction', function () {
          $(window).off('scroll');
          var homeRicette = new HomeRicette();
          var homePost = new HomePost();
        })

        app_router.on('route:showForum', function(search){
          $('#page2').attr('style', 'display: none');
          var forumView = new ForumView(search);
        })

        app_router.on('route:showProfilo', function(page){
          $(window).off('scroll');
          $('#page2').attr('style', 'display: none');
          var profiloView = new ProfiloView(page);
        })

        var footerView = new FooterView();

        footerView.render();

        Backbone.history.start(); 
        //When all of your Routers have been created, and all of the routes are set up properly,
        //call Backbone.history.start() to begin monitoring hashchange events, and dispatching routes
    };
    return { 
    initialize: initialize
   };
});
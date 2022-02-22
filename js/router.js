define([
    'jquery',
    'underscore',
    'backbone',
    'View/HomeRicetteView',
    'View/HomePostView',
    'View/FooterView',
    'View/RicetteView',
    'View/ForumView',
    'View/ProfiloView'
  ], function($, _, Backbone, HomeRicette, HomePost, FooterView, RicetteView, ForumView, ProfiloView) {
  
    var AppRouter = Backbone.Router.extend({
      routes: {
        // Define some URL routes

        'Ricette/:page': 'showRicette',

        'Forum': 'showForum',

        'Profilo': 'showProfilo',
        
        // Default
        '*actions': 'defaultAction'
      }
    });
      
    var initialize = function(){

        $('#page2').setAttribute('style', 'display: none');

        var app_router = new AppRouter;

        app_router.on('route:showRicette', function(page){
          var ricetteView = new RicetteView(page);
        })

        app_router.on('route:defaultAction', function () {
          var homeRicette = new HomeRicette();
          var homePost = new HomePost();
        })

        app_router.on('route:showForum', function(){
          var forumView = new ForumView();
          forumView.render();
        })

        app_router.on('route:showProfilo', function(){
          var profiloView = new ProfiloView();
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
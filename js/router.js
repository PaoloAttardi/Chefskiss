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

        'Ricette/:page/:search': 'showRicette',

        'Forum/:search': 'showForum',

        'Profilo/:page': 'showProfilo',
        
        // Default
        '*actions': 'defaultAction'
      }
    });
      
    var initialize = function(){

        var app_router = new AppRouter;

        app_router.on('route:showRicette', function(page, search){
          $(window).off('scroll');
          $('#page2').attr('style', 'display: none');
          var ricetteView = new RicetteView(page, search);
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
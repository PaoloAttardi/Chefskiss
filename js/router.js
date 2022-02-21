define([
    'jquery',
    'underscore',
    'backbone',
    'View/HomeRicetteView',
    'View/HomePostView',
    'View/FooterView',
    'View/RicetteView',
    'View/ForumView'
  ], function($, _, Backbone, HomeRicette, HomePost, FooterView, RicetteView, ForumView) {
  
    var AppRouter = Backbone.Router.extend({
      routes: {
        // Define some URL routes

        'Ricette/:page': 'showRicette',

        'Forum': 'showForum',
        
        // Default
        '*actions': 'defaultAction'
      }
    });
      
    var initialize = function(){

        var app_router = new AppRouter;

        var homePost = new HomePost();

        app_router.on('route:showRicette', function(page){
          var ricetteView = new RicetteView(page);
          homePost.$el.hide();
        })

        app_router.on('route:defaultAction', function () {
          var homeRicette = new HomeRicette();
          homePost.$el.show();
        })

        app_router.on('route:showForum', function(){
          var forumView = new ForumView();
          homePost.$el.hide();
          forumView.render();
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
define([
    'jquery',
    'underscore',
    'backbone',
    '../client/View/HomeView',
    '../client/View/FooterView'
  ], function($, _, Backbone, HomeView, FooterView) {
  
    var AppRouter = Backbone.Router.extend({
      routes: {
        // Define some URL routes
        'home': 'HomeView',
        
        // Default
        '*actions': 'defaultAction'
      }
    });
      
    var initialize = function(){

        var app_router = new AppRouter;

        app_router.on('route:HomeView', function(){

            var homeView = new HomeView();
            homeView.render();
        })

        app_router.on('route:defaultAction', function (actions) {
        
          var homeView = new HomeView();
            
          homeView.render();
        });

        var footerView = new FooterView();

        footerView.render();

        //Backbone.history.stop();
        Backbone.history.start(); 
        //When all of your Routers have been created, and all of the routes are set up properly,
        //call Backbone.history.start() to begin monitoring hashchange events, and dispatching routes
    };
    return { 
    initialize: initialize
   };
});
define([
    'jquery',
    'underscore',
    'backbone',
    'View/HomeView',
    'View/FooterView',
    'js/Collections/RicetteCollection.js'
  ], function($, _, Backbone, HomeView, FooterView, RicetteCollection) {
  
    var AppRouter = Backbone.Router.extend({
      routes: {
        // Define some URL routes
        '/chefskiss2.0/index.html': 'HomeView',
        
        // Default
        '*actions': 'defaultAction'
      }
    });
      
    var initialize = function(){

        var app_router = new AppRouter;

        app_router.on('route:HomeView', function(){
          console.log('errore')
            var homeView = new HomeView();
            homeView.render();
        })

        app_router.on('route:defaultAction', function (actions) {
          
        ricette = new RicetteCollection();
        var homeView = new HomeView({collection: ricette});
        ricette.fetch({
          success: console.log(ricette),
          error: console.log('porcodio'),
        })
        console.log(ricette.lenght)
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
define([
    'jquery',
    'underscore',
    'backbone',
    'View/HomeRicetteView',
    'View/HomePostView',
    'View/FooterView',
    'View/RicetteView',
    'js/Collections/RicetteCollection.js',
    'js/Collections/DomandeCollection.js'
  ], function($, _, Backbone, HomeRicette, HomePost, FooterView, RicetteView, RicetteCollection, DomandeCollection) {
  
    var AppRouter = Backbone.Router.extend({
      routes: {
        // Define some URL routes
        'Home': 'HomeView',

        'Ricette': 'showRicette',
        
        // Default
        '*actions': 'defaultAction'
      }
    });
      
    var initialize = function(){

        var app_router = new AppRouter;

        app_router.on('route:showRicette', function(){
          var ricetteView = new RicetteView();
          var homePost = new HomePost();
          homePost.$el.hide();
          ricetteView.render();
      })

        app_router.on('route:defaultAction', function (actions) {
        var ricette = new RicetteCollection();
        var homeRicette = new HomeRicette({collection: ricette});
        ricette.fetch({
          success: function(){
            console.log(JSON.stringify(ricette));
            homeRicette.render();
          },
          error: function(){console.log('errore')},
          })
        });

        var post = new DomandeCollection();
        var homePost = new HomePost({collection: post});
        homePost.$el.show();
        post.fetch({
          success: function(){
            console.log(JSON.stringify(post));
            homePost.render();
          },
          error: function(){console.log('errore')},
          });

        app_router.on('route:HomeView', function(){
          var ricette = new RicetteCollection();
          var homeRicette = new HomeRicette({collection: ricette});
          ricette.fetch({
            success: function(){
              console.log(JSON.stringify(ricette));
              homeRicette.render();
            },
            error: function(){console.log('errore')},
            })
          });
  
          var post = new DomandeCollection();
          var homePost = new HomePost({collection: post});
          homePost.$el.show();
          post.fetch({
            success: function(){
              console.log(JSON.stringify(post));
              homePost.render();
            },
            error: function(){console.log('errore')},
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
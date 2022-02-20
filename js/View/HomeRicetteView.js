define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/HomeRicette.html',
    'js/Collections/RicetteCollection.js'
  ], function($, _, Backbone, homeTemplate, RicetteCollection){

    var HomeView = Backbone.View.extend({
      el: $("#page1"),

      initialize: function() {
        var that = this;
        var onDataHandler = function() {
          that.render();
        }

        ricette = new RicetteCollection();
        ricette.fetch({success: function(){
          that.collection = ricette;
          onDataHandler();
          }
        })
      },
  
      render: function(){
        ricette = ricette.at(0);
        //_.toArray(ricette);
        var data = {
          ricette: ricette.toJSON(),
          _: _
        };
        console.log(JSON.stringify(data));
        var compiledTemplate = _.template( homeTemplate, data );
        this.$el.html(compiledTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
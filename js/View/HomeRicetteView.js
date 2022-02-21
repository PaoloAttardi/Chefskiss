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
        ricette.fetch({
          data: $.param({
            order: 'valutazione',
            offset: 0,
            limit: 6,
            like: ''
          }),
          success: function(){
          that.collection = ricette;
          onDataHandler();
          }
        })
      },
  
      render: function(){
        ricette = ricette.at(0);
        var data = {
          ricette: ricette.toJSON(),
          _: _
        };
        var compiledTemplate = _.template( homeTemplate, data );
        this.$el.html(compiledTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
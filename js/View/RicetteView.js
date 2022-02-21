define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Ricette.html',
    'js/Collections/RicetteCollection.js'
  ], function($, _, Backbone, ricetteTemplate, ricette){

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
            order: '',
            offset: 0,
            limit: 9,
            like: ''
          }),
          success: function(){
          that.collection = ricette;
          onDataHandler();
          }
        })
      },
  
      render: function(){
        this.$el.html(ricetteTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
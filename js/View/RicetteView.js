define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Ricette.html',
    'js/Collections/RicetteCollection.js'
  ], function($, _, Backbone, ricetteTemplate, ricette){

    var HomeView = Backbone.View.extend({
      el: $("#page1"),

      initialize: function() {},
  
      render: function(){
        this.$el.html(ricetteTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
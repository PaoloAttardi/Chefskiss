define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Nuova_ricetta.html'
  ], function($, _, Backbone, homeTemplate){

    var nuovaDomandaView = Backbone.View.extend({
      el: $("#page1"),

      initialize: function() {
          this.render()
      },

      render: function(){
        this.$el.html(homeTemplate);
      }

    });
  
    return nuovaDomandaView;
    
  });
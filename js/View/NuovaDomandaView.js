define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Nuova_domanda.html'
  ], function($, _, Backbone, domandaTemplate){

    var nuovaDomandaView = Backbone.View.extend({
      el: $("#page1"),

      initialize: function() {
          this.render()
      },

      render: function(){
        this.$el.html(domandaTemplate);
      }

    });
  
    return nuovaDomandaView;
    
  });
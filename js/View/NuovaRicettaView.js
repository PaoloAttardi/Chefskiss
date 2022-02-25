define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Nuova_ricetta.html'
  ], function($, _, Backbone, nuovaRicettaTemplate){

    var nuovaRicettaView = Backbone.View.extend({
      el: $("#page1"),

      initialize: function() {
          this.render()
      },

      render: function(){
        this.$el.html(nuovaRicettaTemplate);
      }

    });
  
    return nuovaRicettaView;
    
  });
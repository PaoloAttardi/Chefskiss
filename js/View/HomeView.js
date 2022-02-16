define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/homeTemplate.html',
    'js/Collections/RicetteCollection.js'
  ], function($, _, Backbone, homeTemplate, ricetteCollection){

    var HomeView = Backbone.View.extend({
      el: $("#page"),
      //template: _.template($('#HomeTemplate').html()),

      initialize: function() {

        var that = this;
  
        var onDataHandler = function() {
            that.render();
        }

        this.collection = new ricetteCollection();
        this.collection.fetch({
            success: function(){
              onDataHandler,
              console.log('ciao')
            },
            error: function(){
              console.log('errore')
            }
        })
  
      },
  
      render: function(){
        this.$el.html(homeTemplate/*(ricetta.attributes)*/);
      }
  
    });
  
    return HomeView;
    
  });
  
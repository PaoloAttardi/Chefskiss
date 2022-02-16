define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/homeTemplate.html',
    'Collections/ricetteCollection'
  ], function($, _, Backbone, homeTemplate){
  
    var HomeView = Backbone.View.extend({
      el: $("#page"),
      //template: _.template($('#HomeTemplate').html()),
  
      render: function(){
        var ricette = new ricetteCollection
        /*Backbone.sync('read', ricettaCollection, {
            success: function(){
              console.log()
            },
            error: function(){}} )*/
        ricette.fetch({
            data: {},
            success: function(){
              console.log(ricette)
            },
            error: function(){
              console.log(errore)
            }
        })
        this.$el.html(homeTemplate(ricetta.attributes));
      }
  
    });
  
    return HomeView;
    
  });
  
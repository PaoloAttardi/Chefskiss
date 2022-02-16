define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/homeTemplate.html'
  ], function($, _, Backbone, homeTemplate){
  
    var HomeView = Backbone.View.extend({
      el: $("#page"),
      //template: _.template($('#HomeTemplate').html()),
  
      render: function(){
          var ricetta = new ricetta({ id: 1 });
          ricetta.fetch({
              success: function(){},
              error: function(){}
          });
        this.$el.html(homeTemplate(ricetta.attributes));
      }
  
    });
  
    return HomeView;
    
  });
  
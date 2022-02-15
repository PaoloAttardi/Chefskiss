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
        this.$el.html(homeTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
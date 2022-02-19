define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Forum.html',
    'js/Collections/domandeCollection.js'
  ], function($, _, Backbone, forumTemplate, post){

    var HomeView = Backbone.View.extend({
      el: $("#page1"),

      initialize: function() {},
  
      render: function(){
        this.$el.html(forumTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
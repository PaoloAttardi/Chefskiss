define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/HomePost.html',
    'js/Collections/DomandeCollection.js'
  ], function($, _, Backbone, homeTemplate, DomandeCollection){

    var HomeView = Backbone.View.extend({
      el: $("#page2"),

      initialize: function() {
        var that = this;
        var onDataHandler = function() {
          that.render();
        }

        post = new DomandeCollection();
        post.fetch({
          data: $.param({
            order: 'dataPubblicazione',
            offset: 0,
            limit: 3,
            like: ''
          }),
          success: function(){
            that.collection = post;
            onDataHandler();
          }
        })
      },
  
      render: function(){
        post = this.collection.at(0);
        var data = {
          post: post.toJSON().data,
          _: _
        };
        this.$el.show();
        var compiledTemplate = _.template( homeTemplate, data );
        this.$el.html(compiledTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
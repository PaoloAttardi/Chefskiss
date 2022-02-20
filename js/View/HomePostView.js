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
          console.log(JSON.stringify(this.collection));
          that.render();
        }

        post = new DomandeCollection();
        post.fetch({success: function(){
          this.collection = post;
            onDataHandler();
          }
        })
      },
  
      render: function(){
        var data = {
          post: post.toJSON(),
          _: _
        };

        var compiledTemplate = _.template( homeTemplate, data );
        this.$el.html(compiledTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
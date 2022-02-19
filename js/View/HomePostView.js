define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/HomePost.html',
    'js/Collections/DomandeCollection.js'
  ], function($, _, Backbone, homeTemplate, post){

    var HomeView = Backbone.View.extend({
      el: $("#page2"),

      initialize: function() {

        //this.collection.bind("reset", this.render, this);
        //this.collection.bind("add", this.addOne, this);
  
      },
  
      render: function(){
        this.$el.html(homeTemplate);
        //this.addAll();
      }

    /*addAll: function () {
      this.collection.each(this.addOne);
      console.log('ciao');
    },

    addOne: function (model) {
        view = new HomeView({
            model: model
        });
        //$("ul", this.el).append(view.render()); //aggiunta di un elemento alla view
        console.log(model);
      }*/
  
    });
  
    return HomeView;
    
  });
  
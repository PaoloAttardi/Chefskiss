define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Home.html',
    'js/Collections/RicetteCollection.js'
  ], function($, _, Backbone, homeTemplate, ricette){

    var HomeView = Backbone.View.extend({
      el: $("#page"),
      //template: _.template($('#HomeTemplate').html()),

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
  
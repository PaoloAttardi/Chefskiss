define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Ricette.html',
    'js/Collections/RicetteCollection.js'
  ], function($, _, Backbone, ricetteTemplate, RicetteCollection){

    var HomeView = Backbone.View.extend({
      el: $("#page1"),

      initialize: function(number) {
        var that = this;
        var page = number * 9;
        var onDataHandler = function() {
          that.render(Number(number));
        }
        var limite = 9;
        ricette = new RicetteCollection();
        ricette.fetch({
          data: $.param({
            order: '',
            offset: page,
            limit: limite,
            like: ''
          }),
          success: function(){
            that.collection = ricette;
            onDataHandler();
          }
        })
      },
  
      render: function(number){
        ricette = this.collection.at(0);
        var total = Number(ricette.toJSON().total);
        var n = number * 9 + 9;
        if(total > n){
          var nPage = number + 1;
        } else var nPage = false;
        var pPage = number - 1;
        var data = {
          ricette: ricette.toJSON().data,
          page: number,
          nextPage: nPage,
          previousPage: pPage,
          _: _
        };
        var compiledTemplate = _.template( ricetteTemplate, data );
        this.$el.html(compiledTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
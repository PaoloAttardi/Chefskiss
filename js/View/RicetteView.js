define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Ricette.html',
    'js/Collections/RicetteCollection.js',
    'js/Collections/categorieCollection.js'
  ], function($, _, Backbone, ricetteTemplate, RicetteCollection, categorieCollection){

    var HomeView = Backbone.View.extend({
      el: $("#page1"),

      initialize: function(number, search) {
        var that = this;
        this.search = search.split('=');
        this.parametro = '';
        this.like = '';
        if(this.search.length == 2){
           if(that.search[0] == 'Categoria') that.parametro = ['categoria', '=', that.search[1]];
           else that.like = that.search[1];
        }
        var page = number * 9;
        var onDataHandler = function() {
          that.render(Number(number));
        }
        var limite = 9;
        ricette = new RicetteCollection();
        categorie = new categorieCollection();
        ricette.fetch({
          data: $.param({
            parametri: that.parametro,
            order: '',
            offset: page,
            limit: limite,
            like: that.like
          }),
          success: function(){
            that.collection = ricette;
            categorie.fetch({
              success: function(){
                that.categorie = categorie;
                onDataHandler();
              }
            })
          }
        })
      },
  
      render: function(number){
        var that = this;
        var ricette = this.collection.at(0);
        var categorie = this.categorie;
        var total = Number(ricette.toJSON().total);
        var n = number * 9 + 9;
        if(total > n){
          var nPage = number + 1;
        } else var nPage = false;
        var pPage = number - 1;
        var data = {
          ricette: ricette.toJSON().data,
          categorie: categorie.toJSON(),
          page: number,
          nextPage: nPage,
          previousPage: pPage,
          search: that.search,
          _: _
        };
        var compiledTemplate = _.template( ricetteTemplate, data );
        this.$el.html(compiledTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
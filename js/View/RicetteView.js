define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Ricette.html',
    'js/Collections/RicetteCollection.js',
    'js/Collections/categorieCollection.js',
    'js/Collections/immaginiCollection.js'
  ], function($, _, Backbone, ricetteTemplate, RicetteCollection, categorieCollection, immaginiCollection){

    var HomeView = Backbone.View.extend({
      el: $("#page1"),
      events: {
        'click #searchRicetta': 'searchFor'
      },

      initialize: function(number, search) {
        var that = this;
        _.bindAll(this, 'searchFor');
        this.search = search.split('=');
        this.parametro = '';
        this.like = '';
        if(this.search.length == 2){
           if(that.search[0] == 'Categoria') that.parametro = ['categoria', '=', that.search[1]];
        }
        this.page = number * 9;
        this.limite = 9;
        this.loadData(number)
      },

      loadImage: function(imgParam, number){
        var that = this;
        immagini = new immaginiCollection();
        immagini.fetch({
          data: $.param({ 
            parametri:['idImmagine','=', imgParam],
          }),
          success: function(){
              that.immagini = immagini;
              that.render(Number(number));
          }
        })
      },

      loadData: function(number){
        var that = this;
        this.ricette = new RicetteCollection();
        categorie = new categorieCollection();

        var onDataHandler = function() {
          var imgRicette = that.ricette.at(0);
          var imgParam = [];
          if(imgRicette.toJSON().total > that.page + 9) var value = that.page + 9;
          else var value = imgRicette.toJSON().total - that.page;
          for(var i = 0; i < value; i++){
            imgParam.push(imgRicette.toJSON().data[i].idImmagine);
          }
          that.loadImage(imgParam, number);
        }
        that.ricette.fetch({
          data: $.param({
            parametri: that.parametro,
            order: '',
            offset: that.page,
            limit: that.limite,
            like: that.like
          }),
          success: function(){
            that.collection = that.ricette;
            categorie.fetch({
              success: function(){
                that.categorie = categorie;
                onDataHandler();                
              }
            })
          }
        })
      },

      searchFor: function() {
        this.like = ['nomeRicetta', document.getElementById('Text').value];
        this.page = 0;
        var search = 'search';
        this.loadData(this.page, search);
      },

      arrayImg: function(){
        var that = this;
        var arrayImg = [];
        for(var i = 0; i < that.immagini.length; i++){
          arrayImg.push(that.immagini.at(i));
        }
        return arrayImg;
      },
  
      render: function(number){
        var that = this;
        var ricette = this.collection.at(0);
        var categorie = this.categorie;
        var total = Number(ricette.toJSON().total);
        var n = number * 9 + 9;
        var arrayImg = that.arrayImg();
        if(total > n){
          var nPage = number + 1;
        } else var nPage = false;
        var pPage = number - 1;
        var data = {
          immagine: arrayImg,
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
  
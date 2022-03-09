define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/HomeRicette.html',
    'js/Collections/RicetteCollection.js',
    'js/Collections/immaginiCollection.js'
  ], function($, _, Backbone, homeTemplate, RicetteCollection, immaginiCollection){

    var HomeView = Backbone.View.extend({
      el: $("#page1"),

      initialize: function() {
        var that = this;
        var onDataHandler = function() {
          var imgRicette = ricette.at(0);
          if(imgRicette.toJSON().total > 6) var value = 6;
          else var value = imgRicette.toJSON().total;
          var imgParam = [];
          for(var i = 0; i < value; i++){
            imgParam.push(imgRicette.toJSON().data[i].idImmagine);
          }
          that.loadImage(imgParam);
        }
        this.immagini = new immaginiCollection();
        ricette = new RicetteCollection();
        ricette.fetch({
          data: $.param({
            order: 'valutazione',
            offset: 0,
            limit: 6,
            like: ''
          }),
          success: function(){
            that.collection = ricette;
            onDataHandler();
          }
        })
      },

      loadImage: function(imgParam){
        var that = this;
        immagini = new immaginiCollection();
        immagini.fetch({
          data: $.param({ 
            parametri:['idImmagine','=', imgParam],
          }),
          success: function(){
              that.immagini = immagini;
              that.render();
          }
        })
      },

      arrayImg: function(){
        var that = this;
        var arrayImg = [];
        for(var i = 0; i < that.immagini.length; i++){
          arrayImg.push(that.immagini.at(i));
        }
        return arrayImg;
      },
  
      render: function(){
        var ricette = this.collection.at(0);
        var arrayImg = this.arrayImg();
        var data = {
          ricette: ricette.toJSON().data,
          immagine: arrayImg,
          _: _
        };
        var compiledTemplate = _.template( homeTemplate, data );
        this.$el.html(compiledTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
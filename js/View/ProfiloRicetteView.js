define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/ProfiloRicette.html',
    'js/Collections/RicetteCollection.js',
    'js/Collections/immaginiCollection.js'
  ], function($, _, Backbone, profiloTemplate, RicetteCollection, immaginiCollection){
  
    var ProfiloRicetteView = Backbone.View.extend({
      el: $("#page2"),

    initialize: function(model, number) {
        var that = this;
        ricette = new RicetteCollection();
        var page = number * 9;
        var onDataHandler = function() {
          var imgRicette = ricette.at(0);
          var imgParam = [];
          for(var i = 0; i < imgRicette.toJSON().total; i++){
            imgParam.push(imgRicette.toJSON().data[i].idImmagine);
          }
          that.loadImage(imgParam, number);
        }
        var limite = 9;
        ricette.fetch({
            data: $.param({
                parametri: ['autore', '=', model],
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
        ricette = this.collection.at(0);
        var total = Number(ricette.toJSON().total);
        var n = number * 9 + 9;
        if(total > n){
          var nPage = number + 1;
        } else var nPage = false;
        var pPage = number - 1;
        var arrayImg = this.arrayImg();
        var data = {
            immagine: arrayImg,
            ricette: ricette.toJSON().data,
            nRicette: ricette.toJSON().total,
            page: number,
            nextPage: nPage,
            previousPage: pPage,
            _: _
        }
        that.$el.show();
        var compiledTemplate = _.template( profiloTemplate, data );
        that.$el.html(compiledTemplate);
    }
  
    });
    return ProfiloRicetteView;
})
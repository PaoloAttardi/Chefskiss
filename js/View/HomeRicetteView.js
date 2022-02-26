define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/HomeRicette.html',
    'js/Models/immagineModel.js',
    'js/Collections/RicetteCollection.js',
    'js/Collections/immaginiCollection.js'
  ], function($, _, Backbone, homeTemplate, immagineModel, RicetteCollection, immaginiCollection){

    var HomeView = Backbone.View.extend({
      el: $("#page1"),

      initialize: function() {
        var that = this;
        var onDataHandler = function() {
          that.render();
        }
        immagine = new immagineModel();
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
          var imgRicette = ricette.at(0);
            for(var i = 0; i < ricette.length; i++){
              var parametro = imgRicette.toJSON().data[i].idImmagine;
              immagine.fetch({
                data: $.param({ 
                  parametri:['idImmagine','=', parametro],
                  offset: 0,
                  limit: 1,
              }),
              success: function(){
                  that.immagini.add(immagine.toJSON().data);
                  onDataHandler();
              }
            })
          }
          }
        })
      },
  
      render: function(){
        var ricette = this.collection.at(0);
        var image = this.immagini.at(0);
        var data = {
          ricette: ricette.toJSON().data,
          immagine: image.get(0),
          _: _
        };
        var compiledTemplate = _.template( homeTemplate, data );
        this.$el.html(compiledTemplate);
      }
  
    });
  
    return HomeView;
    
  });
  
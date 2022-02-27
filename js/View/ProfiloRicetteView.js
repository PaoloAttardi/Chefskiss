define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/ProfiloRicette.html',
    'js/Collections/RicetteCollection.js',
    'js/Models/immagineModel.js',
    'js/Collections/immaginiCollection.js'
  ], function($, _, Backbone, profiloTemplate, RicetteCollection, immagineModel, immaginiCollection){
  
    var ProfiloRicetteView = Backbone.View.extend({
      el: $("#page2"),

    initialize: function(model, number) {
        var that = this;
        immagine = new immagineModel();
        this.immagini = new immaginiCollection();
        ricette = new RicetteCollection();
        var page = number * 9;
        var onDataHandler = function() {
          that.render(Number(number));
        }
        var limite = 9;
        ricette.fetch({
            data: $.param({
                parametri: ['autore', '=', model.get('idUser')],
                order: '',
                offset: page,
                limit: limite,
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

    render: function(number){
        var that = this;
        ricette = this.collection.at(0);
        var image = this.immagini.at(0);
        var total = Number(ricette.toJSON().total);
        var n = number * 9 + 9;
        if(total > n){
          var nPage = number + 1;
        } else var nPage = false;
        var pPage = number - 1;
        var data = {
            immagine: image.get(0),
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
define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Profilo.html',
    'js/Models/utenteModel.js',
    'View/ProfiloRicetteView',
    'js/Models/immagineModel.js'
  ], function($, _, Backbone, profiloTemplate, utenteModel, ProfiloRicetteView, immagineModel){
  
    var ProfiloView = Backbone.View.extend({
      el: $("#page1"),
  
      initialize: function(page) {
        var that = this;
        var onDataHandler = function() {
            that.render(page);
        }
        immagine = new immagineModel();
        utente = new utenteModel();

        utente.fetch({
            success: function(){
                that.model = utente;
                immagine.fetch({
                  data: $.param({
                      parametri:['idImmagine','=',utente.get('idImmagine')],
                      offset: 0,
                      limit: 1,
                  }),
                  success: function(){
                      console.log(utente);
                      that.immagineRicetta = immagine
                      onDataHandler()
                  }
              })
            }
        })

      },

      render: function(page){
        var that = this;
        var immagine = this.immagineRicetta;
        var data = {
            utente: that.model.toJSON(),
            immagine: immagine.toJSON().data,
            _: _
        }
        var ricette = new ProfiloRicetteView(this.model.get('idUser'), page);
        var compiledTemplate = _.template( profiloTemplate, data );
        that.$el.html(compiledTemplate);

      }
  
    });
  
    return ProfiloView;
    
  });
  
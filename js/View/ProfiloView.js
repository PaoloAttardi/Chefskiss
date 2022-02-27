define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Profilo.html',
    'js/Models/utenteModel.js',
    'View/ProfiloRicetteView'
  ], function($, _, Backbone, profiloTemplate, utenteModel, ProfiloRicetteView){
  
    var ProfiloView = Backbone.View.extend({
      el: $("#page1"),
  
      initialize: function(page) {
        var that = this;
        var onDataHandler = function() {
            that.render(page);
        }

        utente = new utenteModel();
        utente.fetch({
            success: function(){
                that.model = utente;
                onDataHandler();
            }
        })

      },

      render: function(page){
        var that = this;
        var data = {
            utente: that.model.toJSON(),
            _: _
        }
        var ricette = new ProfiloRicetteView(this.model, page);
        var compiledTemplate = _.template( profiloTemplate, data );
        that.$el.html(compiledTemplate);

      }
  
    });
  
    return ProfiloView;
    
  });
  
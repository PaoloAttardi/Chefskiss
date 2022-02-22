define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Profilo.html',
    'text!templates/Login.html',
    'js/Models/utenteModel.js',
    'View/ProfiloRicetteView'
  ], function($, _, Backbone, profiloTemplate, loginTemplate, utenteModel, ProfiloRicetteView){
  
    var ProfiloView = Backbone.View.extend({
      el: $("#page1"),
  
      initialize: function() {
        var that = this;
        var onDataHandler = function() {
            var check = true;
            if(!that.model.has('idUser')) check = false;
            that.render(check);
        }

        utente = new utenteModel();
        utente.fetch({
            success: function(){
                that.model = utente;
                onDataHandler();
            }
        })

      },

      render: function(check){
        var that = this;
        var ricette = new ProfiloRicetteView(this.model);
        if(check){
            var data = {
                utente: that.model.toJSON(),
                _: _
            }
            var compiledTemplate = _.template( profiloTemplate, data );
            that.$el.html(compiledTemplate);
        }
        else this.$el.html(loginTemplate);
      }
  
    });
  
    return ProfiloView;
    
  });
  
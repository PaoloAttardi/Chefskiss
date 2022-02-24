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
  
      initialize: function(page) {
        var that = this;
        var onDataHandler = function() {
            var check = true;
            if(!that.model.has('idUser')) check = false;
            that.render(check, page);
        }

        utente = new utenteModel();
        utente.fetch({
            success: function(){
                that.model = utente;
                onDataHandler();
            }
        })

      },

      render: function(check, page){
        var that = this;
        if(check){
            var data = {
                utente: that.model.toJSON(),
                _: _
            }
            var ricette = new ProfiloRicetteView(this.model, page);
            var compiledTemplate = _.template( profiloTemplate, data );
            that.$el.html(compiledTemplate);
        }
        else {
          //$('#page2').attr('style', 'display: none');
          this.$el.html(loginTemplate);
        }
      }
  
    });
  
    return ProfiloView;
    
  });
  
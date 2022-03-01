define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/ProfiloUtente.html',
    'js/Models/profiloModel.js',
    'View/ProfiloRicetteView',
    'js/Models/immagineModel.js'
], function($, _, Backbone, profiloTemplate, profiloModel,ProfiloRicetteView, immagineModel){

    var ProfiloUtenteView= Backbone.View.extend({
        el: $("#page1"),

        initialize: function (id){
            var that = this;
            var onDataHandler = function() {
                that.render(id);
            }
            immagine=new immagineModel();
            autore= new profiloModel();
            autore.fetch({
                data: $.param({
                    parametri:['idUser','=',id],
                    offset: 0,
                    limit: 1,
                }),
                success: function(){
                    that.model = autore;
                    immagine.fetch({
                        data: $.param({
                            parametri:['idImmagine','=',that.model.toJSON().data[0].idImmagine],
                            offset: 0,
                            limit: 1,
                        }),
                        success: function(){
                            that.immagine = immagine
                            onDataHandler()
                        },
                        error: function (){
                            onDataHandler()
                        }
                    })
                }
            })
        },

        render: function(){
            var that = this;
            var immagine = that.immagine;
            var data = {
                utente: that.model.toJSON().data[0],
                immagine: immagine.toJSON().data[0],
                _: _
            }
            console.log(immagine.toJSON().data[0]);
            var ricette = new ProfiloRicetteView(that.model.toJSON().data[0].idUser ,0);
            var compiledTemplate=_.template(profiloTemplate, data);
            that.$el.html(compiledTemplate);
        }
        });

    return ProfiloUtenteView;
})
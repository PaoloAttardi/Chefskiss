define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Dettaglio_ricetta.html',
    'js/Models/ricettaModel.js',
    'js/Collections/autoreCollection.js',
    'js/View/RecensioneView.js',
    'js/Models/immagineModel.js'
], function($, _, Backbone, ricettaTemplate, RicettaModel, AutoreModel, RecensioneView, immagineModel) {

    var RicettaView = Backbone.View.extend({
        el: $("#page1"),

        initialize: function(id){
            var that = this;
            ricetta = new RicettaModel();
            autore = new AutoreModel();
            immagine = new immagineModel();
            var onDataHandler=function (){
                that.render()
            }

            ricetta.fetch({
                data: $.param({
                    parametri:['idRicetta','=',id],
                    offset: 0,
                    limit: 1,
                }),
                success: function(){
                    that.model=ricetta;
                    autore.fetch({
                        data: $.param({
                            parametri:['idUser','=',ricetta.toJSON().data[0].autore],
                            offset: 0,
                            limit: 1,
                        }),
                        success: function(){
                            that.model1=autore.at(0);
                            immagine.fetch({
                                data: $.param({
                                    parametri:['idImmagine','=',ricetta.toJSON().data[0].idImmagine],
                                    offset: 0,
                                    limit: 1,
                                }),
                                success: function(){
                                    that.immagineRicetta = immagine
                                    onDataHandler()
                                }
                            })
                        }
                    })
                }
            })
        },

        render: function(){
            var recensione = new RecensioneView(this.model.toJSON().data[0].idRicetta);
            var ricetta = this.model;
            var utente = this.model1;
            var immagine = this.immagineRicetta;
            var data={
                ricetta: ricetta.toJSON().data,
                utente: utente.toJSON().data,
                immagine: immagine.toJSON().data,
                _: _
            };
            var compiledTemplate= _.template(ricettaTemplate, data);
            this.$el.html(compiledTemplate);
        }
    });
    return RicettaView;
});
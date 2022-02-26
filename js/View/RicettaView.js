define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Dettaglio_ricetta.html',
    'js/Models/ricettaModel.js',
    'js/Collections/autoreCollection.js',
    'js/View/RecensioneView.js',
    'js/Models/immagineModel.js'
], function($, _, Backbone, ricettaTemplate, RicettaModel, AutoreCollection, RecensioneView, immagineModel) {

    var RicettaView = Backbone.View.extend({
        el: $("#page1"),

        initialize: function(id){
            var that = this;
            ricetta = new RicettaModel();
            autore = new AutoreCollection();
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
                            that.collection=autore;
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
            var utente = this.collection.at(0);
            var immagine = this.immagineRicetta;
            console.log(JSON.stringify(immagine.toJSON().data));
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
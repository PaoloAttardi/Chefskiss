define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Recensione_ricetta.html',
    'js/Collections/recensioneCollection.js',
    'js/Collections/autoreCollection.js'
], function($, _, Backbone, recensioneTemplate, RecensioneCollection, AutoreCollection) {

    var RecensioneView = Backbone.View.extend({
        el: $("#page2"),

        initialize: function(id){
            var that = this;
            recensione = new RecensioneCollection();
            autore=new AutoreCollection();
            var onDataHandler=function (){
                that.render()
            }

            recensione.fetch({
                data: $.param({
                    parametri:['idRicetta','=',id],
                    offset: 0,
                    limit: 1,
                }),
                success: function() {
                    that.collection1 = recensione.at(0);
                    if (that.collection1.toJSON().total !== 0){

                    autore.fetch({
                        data: $.param({
                            parametri: ['idUser', '=', recensione.at(0).attributes.data[0].autore],
                            offset: 0,
                            limit: 1,
                        }),
                        success: function () {
                            that.collection2 = autore.at(0);
                            onDataHandler()
                        }
                    })
                    }
                    onDataHandler();
                }
            })
        },

        render: function(){

            var recensione=this.collection1;
            if(this.collection2!==undefined) {
                var autore = this.collection2.toJSON().data;
            }
            else{
                var autore=null;
            }
            var data={
                recensione: recensione.toJSON().data,
                autore: autore,
                _: _
            };
            this.$el.show();
            var compiledTemplate= _.template(recensioneTemplate, data);
            this.$el.html(compiledTemplate);
        }
    });
    return RecensioneView;
});
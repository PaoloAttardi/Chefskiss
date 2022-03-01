define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Recensione_ricetta.html',
    'js/Collections/recensioneCollection.js',
    'js/Collections/autoreCollection.js',
    'js/Collections/immaginiCollection.js'
], function($, _, Backbone, recensioneTemplate, RecensioneCollection, AutoreCollection, immaginiCollection) {

    var RecensioneView = Backbone.View.extend({
        el: $("#page2"),

        initialize: function(id){
            var that = this;
            that.id = id;
            recensione = new RecensioneCollection();
            autore = new AutoreCollection();
            var onDataHandler = function (check){
                if(check){
                    var imgAutori = that.collection2;
                    var imgParam = [];
                    for(var i = 0; i < imgAutori.toJSON().length; i++){
                        imgParam.push(imgAutori.toJSON()[i].data[0].idImmagine);
                    }
                    that.loadImage(imgParam);
                } else that.render();
            }
            recensione.fetch({
                data: $.param({
                    parametri:['idRicetta','=',id],
                    offset: 0,
                    limit: 10,
                }),
                success: function() {
                    that.collection1 = recensione.at(0);
                    var check = false;

                    if (that.collection1.toJSON().total !== 0){
                        var Autori = that.collection1;

                        var arrayParam = [];
                        for(var i = 0; i < Autori.toJSON().total; i++){
                            arrayParam.push(Autori.toJSON().data[i].autore);
                        }
                        autore.fetch({
                            data: $.param({
                                parametri: ['idUser', '=', arrayParam],
                                offset: 0,
                                limit: 10,
                            }),
                            success: function () {
                                that.collection2 = autore;
                                check = true;
                                onDataHandler(check)
                            }
                        })
                    }
                    else onDataHandler(check);
                }
            })
        },

        loadImage: function(imgParam){
            var that = this;
            immagini = new immaginiCollection();
            immagini.fetch({
              data: $.param({ 
                parametri:['idImmagine','=', imgParam],
              }),
              success: function(){
                  that.immagini = immagini;
                  that.render();
              }
            })
          },
    
          arrayImg: function(){
            var that = this;
            var arrayImg = [];
            for(var i = 0; i < that.immagini.length; i++){
              arrayImg.push(that.immagini.at(i));
            }
            return arrayImg;
          },

        arrayAuthor: function(){
            var that = this;
            var arrayAuthor = [];
            for(var i = 0; i < that.collection2.length; i++){
                arrayAuthor.push(that.collection2.at(i));
            }
            return arrayAuthor;
        },

        render: function(){

            var recensione=this.collection1;
            if(this.collection2!==undefined) {
                var autore = this.arrayAuthor();
                var arrayImg = this.arrayImg();
            }
            else{
                var arrayImg = null;
                var autore=null;
            }
            var data={
                idRicetta: this.id,
                immagine: arrayImg,
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
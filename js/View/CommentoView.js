define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Commento_post.html',
    'js/Collections/commentoCollection.js',
    'js/Collections/autoreCollection.js',
    'js/Collections/immaginiCollection.js'
], function($, _, Backbone, CommentoTemplate, CommentoCollection, AutoreCollection, immaginiCollection) {

    var CommentoView = Backbone.View.extend({
        el: $("#page2"),

        initialize: function(id){
            var that = this;
            that.id=id;
            var commento = new CommentoCollection();
            var autore = new AutoreCollection();
            var onDataHandler = function (check){
                if(check){
                    var imgAutori = that.collection2;
                    var imgParam = [];
                    for(var i = 0; i < imgAutori.toJSON().total; i++){
                        imgParam.push(imgAutori.toJSON().data[i].idImmagine);
                    }
                    that.loadImage(imgParam);
                } else that.render();
            }
            commento.fetch({
                data: $.param({
                    parametri:['idPost','=',id],
                    offset: 0,
                    limit: 10,
                }),
                success: function() {
                    that.collection1 = commento.at(0);
                    var check = false;
                    if (that.collection1.toJSON().total !== 0){
                        autore.fetch({
                            data: $.param({
                                parametri: ['idUser', '=', commento.at(0).attributes.data[0].autore],
                                offset: 0,
                                limit: 10,
                            }),
                            success: function () {
                                that.collection2 = autore.at(0);
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

        render: function(){
            var commento =this.collection1;
            if(this.collection2!==undefined) {
                var autore = this.collection2.toJSON().data;
                var arrayImg = this.arrayImg();
            }
            else{
                var arrayImg = null;
                var autore=null;
            }
            var data={
                idPost:this.id,
                immagine: arrayImg,
                commento: commento.toJSON().data,
                autore: autore,
                _: _
            };
            this.$el.show();
            var compiledTemplate= _.template(CommentoTemplate, data);
            this.$el.html(compiledTemplate);
        }
    });
    return CommentoView;
});
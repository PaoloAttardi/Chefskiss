define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Post_forum.html',
    'js/Models/postModel.js',
    'js/Collections/autoreCollection.js',
    'js/View/CommentoView.js',
    'js/Models/immagineModel.js'
], function($, _, Backbone, postTemplate, postModel, AutoreCollection, CommentoView, immagineModel) {

    var PostView = Backbone.View.extend({
        el: $("#page1"),

        initialize: function(id){
            var that = this;
            post = new postModel();
            post.fetch({
                data: $.param({
                    parametri:['idPost','=',id],
                    offset: 0,
                    limit: 1,
                }),
                success: function(){
                    that.model=post;
                    that.loadData();
                }
            })
        },

        loadData: function(){
            var that = this;
            autore = new AutoreCollection();
            immagine = new immagineModel();
            var onDataHandler=function (){
                that.render()
            }
            autore.fetch({
                data: $.param({
                    parametri:['idUser','=',that.model.toJSON().data[0].autore],
                    offset: 0,
                    limit: 1,
                }),
                success: function(){
                    that.collection = autore.at(0);
                    console.log(that.collection.toJSON().data[0].idImmagine)
                    immagine.fetch({
                        data: $.param({
                            parametri:['idImmagine','=',that.collection.toJSON().data[0].idImmagine],
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
        },

        render: function(){
            new CommentoView(this.model.toJSON().data[0].idPost);
            var post=this.model;
            var utente = this.collection;
            var immagine = this.immagineRicetta;
            var data={
                post: post.toJSON().data,
                utente: utente.toJSON().data,
                immagine: immagine.toJSON().data,
                _: _
            };
            var compiledTemplate= _.template(postTemplate, data);
            this.$el.html(compiledTemplate);
        }
    });
    return PostView;
});
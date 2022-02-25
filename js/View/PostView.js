define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Post_forum.html',
    'js/Models/postModel.js',
    'js/Collections/autoreCollection.js',
    'js/View/CommentoView.js'
], function($, _, Backbone, postTemplate, postModel,AutoreCollection,CommentoView) {

    var PostView = Backbone.View.extend({
        el: $("#page1"),

        initialize: function(id){
            var that = this;
            post = new postModel();
            autore=new AutoreCollection();
            var onDataHandler=function (){
                that.render()
            }

            post.fetch({
                data: $.param({
                    parametri:['idPost','=',id],
                    offset: 0,
                    limit: 1,
                }),
                success: function(){
                    that.model=post;
                    autore.fetch({
                        data: $.param({
                            parametri:['idUser','=',post.toJSON().data[0].autore],
                            offset: 0,
                            limit: 1,
                        }),
                        success: function(){
                            that.collection=autore;
                            onDataHandler()
                        }
                    })
                }
            })
        },

        render: function(){
            var commento= new CommentoView(this.model.toJSON().data[0].idPost);
            var post=this.model;
            var utente=this.collection.at(0);
            var data={
                post: post.toJSON().data,
                utente: utente.toJSON().data,
                _: _
            };
            var compiledTemplate= _.template(postTemplate, data);
            this.$el.html(compiledTemplate);
        }
    });
    return PostView;
});
define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Commento_post.html',
    'js/Collections/commentoCollection.js',
    'js/Collections/autoreCollection.js'
], function($, _, Backbone, CommentoTemplate, CommentoCollection, AutoreCollection) {

    var CommentoView = Backbone.View.extend({
        el: $("#page2"),

        initialize: function(id){
            var that = this;
            that.id=id;
            var commento = new CommentoCollection();
            var autore=new AutoreCollection();
            var onDataHandler=function (){
                that.render()
            }

            commento.fetch({
                data: $.param({
                    parametri:['idPost','=',id],
                    offset: 0,
                    limit: 10,
                }),
                success: function() {
                    that.collection1 = commento.at(0);
                    if (that.collection1.toJSON().total !== 0){

                        autore.fetch({
                            data: $.param({
                                parametri: ['idUser', '=', commento.at(0).attributes.data[0].autore],
                                offset: 0,
                                limit: 10,
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

            var commento =this.collection1;
            if(this.collection2!==undefined) {
                var autore = this.collection2.toJSON().data;
            }
            else{
                var autore=null;
            }
            var data={
                idPost:this.id,
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
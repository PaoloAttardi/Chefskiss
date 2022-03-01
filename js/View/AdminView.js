define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Admin.html',
    '../Collections/profiloCollection.js'
], function($, _, Backbone,AdminTemplate, ProfiloCollection){

    var AdminView= Backbone.View.extend({
        el: $("#page1"),

        initialize: function (){
            var that = this;
            var onDataHandler = function() {
                that.render();
            }
            profili= new ProfiloCollection;

            profili.fetch({
                data: $.param({
                    parametri:['idUser','!=',0]
                }),
                success: function(){
                    that.collection1=profili;
                    onDataHandler();
                }
            })
        },

        render: function(){
            var that = this;
            var data = {
                profili: that.collection1.at(0).toJSON().data,
                _: _
            }
            var compiledTemplate=_.template(AdminTemplate, data);
            that.$el.html(compiledTemplate);
        }
    });

    return AdminView;
})
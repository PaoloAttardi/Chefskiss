define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Modifica_ricetta.html',
    'js/Models/ricettaModel.js',
], function($, _, Backbone, ModificaRicettaTemplate, RicettaModel){

    var ModificaRicettaView = Backbone.View.extend({
        el: $("#page1"),

        initialize: function(id) {
            var that = this;
            ricetta=new RicettaModel();
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
                    that.model = ricetta;
                    onDataHandler();
                }
            })
        },

        render: function(){
            var data = {
                ricetta: this.model.toJSON().data,
                _: _
            }
            var compiledTemplate= _.template(ModificaRicettaTemplate,data);
            this.$el.html(compiledTemplate);
        }

    });

    return ModificaRicettaView;

});
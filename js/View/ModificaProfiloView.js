define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Modifica_profilo.html',
    'js/Models/utenteModel.js',
], function($, _, Backbone, ModificaProfiloTemplate, UtenteModel){

    var ModificaProfiloView = Backbone.View.extend({
        el: $("#page1"),

        initialize: function() {
            var that = this;
            utente=new UtenteModel();
            var onDataHandler=function (){
                that.render()
            }

            utente.fetch({
                success: function(){
                    that.model = utente;
                    onDataHandler();
                }
            })
        },

        render: function(){
            var data = {
                utente: this.model.toJSON(),
                _: _
            }
            console.log(this.model.toJSON());
            var compiledTemplate= _.template(ModificaProfiloTemplate,data);
            this.$el.html(compiledTemplate);
        }

    });

    return ModificaProfiloView;

});
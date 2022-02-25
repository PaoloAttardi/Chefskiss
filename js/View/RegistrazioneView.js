define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Registrazione.html'
], function($, _, Backbone, RegistrazioneTemplate){

    var RegistrazioneView = Backbone.View.extend({
        el: $("#page1"),

        initialize: function() {
            var that = this;
            var onDataHandler=function (){
                that.render()
            }
            onDataHandler();
        },

        render: function(){
            var compiledTemplate= _.template(RegistrazioneTemplate);
            this.$el.html(compiledTemplate);
        }

    });

    return RegistrazioneView;

});
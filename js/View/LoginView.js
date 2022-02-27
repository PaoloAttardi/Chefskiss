define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Login.html',
], function($, _, Backbone, loginTemplate){

    var LoginView = Backbone.View.extend({
        el: $("#page1"),

        initialize: function(state) {
            var that = this;
            var onDataHandler = function() {
                that.render(state);
            }
            onDataHandler();

        },

        render: function(state){
            var compiledTemplate = _.template( loginTemplate);
            this.$el.html(compiledTemplate);
            if(state==='1'){
                alert('Email o password errate. Riprova');
            }
            else{
                if(state==='2'){
                    alert('Questo account è stato bannato');
                }
            }
        }
    });

    return LoginView;

});

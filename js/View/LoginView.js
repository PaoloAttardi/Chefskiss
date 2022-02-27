define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Login.html',
], function($, _, Backbone, loginTemplate){

    var LoginView = Backbone.View.extend({
        el: $("#page1"),

        initialize: function(page) {
            var that = this;
            var onDataHandler = function() {
                that.render();
            }
            onDataHandler();

        },

        render: function(){
            this.$el.html(loginTemplate);
        }

    });

    return LoginView;

});

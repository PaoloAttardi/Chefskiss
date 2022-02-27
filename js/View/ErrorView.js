define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/404.html',
], function($, _, Backbone, ErrorTemplate){

    var ErrorView = Backbone.View.extend({
        el: $("#page1"),

        initialize: function() {
            var that = this;
            var onDataHandler=function (){
                that.render()
            }
            onDataHandler();
        },

        render: function(){
            var compiledTemplate= _.template(ErrorTemplate);
            this.$el.html(compiledTemplate);
        }

    });

    return ErrorView;

});
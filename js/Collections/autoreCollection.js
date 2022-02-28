define([
    'jquery',
    'underscore',
    'backbone',
    'Models/autoreModel'
], function($, _, Backbone, autoreModel){
    var autoreCollection = Backbone.Collection.extend({
        model: autoreModel,
        url: "/chefskiss2/index.php?url=Search/getAutore",

        initialize: function(){

        }

    });

    return autoreCollection;
});
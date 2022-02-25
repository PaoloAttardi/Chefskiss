define([
    'jquery',
    'underscore',
    'backbone',
    'js/Models/commentoModel.js'
], function($, _, Backbone, commentoModel){
    var commentoCollection = Backbone.Collection.extend({
        model: commentoModel,
        url: "/chefskiss2/api.php?url=Search/getCommento",

        initialize: function(){}

    });

    return commentoCollection;
});
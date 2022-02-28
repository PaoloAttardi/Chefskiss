define([
    'jquery',
    'underscore',
    'backbone',
    'js/Models/immagineModel.js'
], function($, _, Backbone, immagineModel){
    var immaginiCollection = Backbone.Collection.extend({
        model: immagineModel,
        url: "/chefskiss2/index.php?url=Search/getImmagini",

        initialize: function(){

        }

    });

    return immaginiCollection;
});
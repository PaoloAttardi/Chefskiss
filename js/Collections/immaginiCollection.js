define([
    'jquery',
    'underscore',
    'backbone',
    'Models/immagineModel'
], function($, _, Backbone, immagineModel){
    var immaginiCollection = Backbone.Collection.extend({
        model: immagineModel,
        url: "/chefskiss2/api.php?url=Search/getImmagine",

        initialize: function(){

        }

    });

    return immaginiCollection;
});
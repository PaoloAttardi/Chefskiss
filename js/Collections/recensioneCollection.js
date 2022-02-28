define([
    'jquery',
    'underscore',
    'backbone',
    'Models/recensioneModel'
], function($, _, Backbone, recensioneModel){
    var recensioneCollection = Backbone.Collection.extend({
        model: recensioneModel,
        url: "/chefskiss2/index.php?url=Search/getRecensione",

        initialize: function(){

        }

    });

    return recensioneCollection;
});
define([
    'jquery',
    'underscore',
    'backbone',
    'Models/profiloModel'
], function($, _, Backbone, profiloModel){
    var profiloCollection = Backbone.Collection.extend({
        model: profiloModel,
        url: "/chefskiss2/index.php?url=Search/getAutore",

        initialize: function(){
        }

    });

    return profiloCollection;
});
define([
    'underscore',
    'backbone'
], function(_, Backbone) {

    var commento = Backbone.Model.extend({
        idAttribute: "idCommento",
        url: "/chefskiss2/api.php?url=Search/getCommento",

        initialize: function (){

        }

    });

    return commento;

});
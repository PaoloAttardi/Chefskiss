define([
    'underscore',
    'backbone'
], function(_, Backbone) {

    var autore = Backbone.Model.extend({
        urlRoot: "/chefskiss2/api.php?url=Search/getAutore",
        idAttribute: "idUser",

        initialize: function (){},

    });

    return autore;

});
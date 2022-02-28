define([
    'underscore',
    'backbone'
], function(_, Backbone) {

    var recensione = Backbone.Model.extend({
        urlRoot: "/chefskiss2/index.php?url=Search/getRecensione",
        idAttribute: "idRecensione",

        initialize: function (){},

    });

    return recensione;

});
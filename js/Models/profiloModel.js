define([
    'underscore',
    'backbone'
], function(_, Backbone) {

    var profilo = Backbone.Model.extend({
        urlRoot: "/chefskiss2/index.php?url=Search/getAutore",
        idAttribute: "idUser",

        initialize: function (){},

    });

    return profilo;

});
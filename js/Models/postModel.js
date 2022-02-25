define([
    'underscore',
    'backbone'
], function(_, Backbone) {

    var post = Backbone.Model.extend({
        idAttribute: "idPost",
        url: "/chefskiss2/api.php?url=Search/getPost",

        initialize: function (){

        }

    });

    return post;

});
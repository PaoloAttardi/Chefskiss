define([
    'underscore',
    'backbone'
], function(_, Backbone) {

    var post = Backbone.Model.extend({
        idAttribute: "idPost",
        url: "/chefskiss2/index.php?url=Search/getPost",

        initialize: function (){

        }

    });

    return post;

});
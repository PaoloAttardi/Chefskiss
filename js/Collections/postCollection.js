define([
    'jquery',
    'underscore',
    'backbone',
    'js/Models/postModel.js'
], function($, _, Backbone, postModel){
    var PostCollection = Backbone.Collection.extend({
        model: postModel,
        url: "/chefskiss2/api.php?url=Search/getPost",

        initialize: function(){}

    });

    return PostCollection;
});
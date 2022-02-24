define([
    'jquery',
    'underscore',
    'backbone',
    'js/Models/categoriaModel.js'
  ], function($, _, Backbone, categoriaModel){
    var CategorieCollection = Backbone.Collection.extend({
      model: categoriaModel,
      url: "/chefskiss2/api.php?url=Search/getCategorie",

      initialize: function(){}
  
    });
   
    return CategorieCollection;
  });
  
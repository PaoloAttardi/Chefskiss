define([
    'jquery',
    'underscore',
    'backbone',
    'js/Models/categoriaModel.js'
  ], function($, _, Backbone, categoriaModel){
    var CategorieCollection = Backbone.Collection.extend({
      model: categoriaModel,
      url: "/chefskiss2/index.php?url=Search/getCategorie",

      initialize: function(){}
  
    });
   
    return CategorieCollection;
  });
  
define([
    'jquery',
    'underscore',
    'backbone',
    'js/Models/ricettaModel.js'
  ], function($, _, Backbone, ricettaModel){
    var RicetteCollection = Backbone.Collection.extend({
      model: ricettaModel,
      url: "/chefskiss2/index.php?url=Search/getRicette",

      initialize: function(){}
  
    });
   
    return RicetteCollection;
  });
  
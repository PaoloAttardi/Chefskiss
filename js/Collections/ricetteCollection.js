define([
    'jquery',
    'underscore',
    'backbone',
    'js/Models/ricettaModel.js'
  ], function($, _, Backbone, ricettaModel){
    var RicetteCollection = Backbone.Collection.extend({
      model: ricettaModel,
      url: "/chefskiss2.0/api.php?url=Search/homeView",
      //Controller/CFrontController.php?Class=Search/homeView
      //chefskiss2.0/api.php?url=Search/homeView
      initialize: function(){}
  
    });
   
    return RicetteCollection;
  });
  
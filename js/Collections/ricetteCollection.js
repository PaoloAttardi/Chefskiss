define([
    'jquery',
    'underscore',
    'backbone',
    'js/Models/ricettaModel.js'
  ], function($, _, Backbone, ricettaModel){
    var RicetteCollection = Backbone.Collection.extend({
      model: ricettaModel,
      url: "/chefskiss2.0/api/Search/homeView",
      
      initialize: function(){}
  
    });
   
    return RicetteCollection;
  });

  /*ricette.fetch({
      data: {
          page: 2
      },
      success: function(){},
      error: function(){}
  })*/
  
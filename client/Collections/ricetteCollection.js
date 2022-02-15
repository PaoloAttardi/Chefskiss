define([
    'jquery',
    'underscore',
    'backbone',
    'Models/ricettaModel'
  ], function($, _, Backbone, ricettaModel){
    var ricettaCollection = Backbone.Collection.extend({
      model: ricettaModel,
      url: "/api/ricette",
      
      initialize: function(){
  
      }
  
    });
   
    return ricettaCollection;
  });

  /*var ricette = new ricettaCollection
  ricette.fetch({
      data: {
          page: 2
      },
      success: function(){},
      error: function(){}
  })*/
  
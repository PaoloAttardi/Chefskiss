define([
    'jquery',
    'underscore',
    'backbone',
    'Models/domandaModel'
  ], function($, _, Backbone, domandaModel){
    var domandaCollection = Backbone.Collection.extend({
      model: domandaModel,
      url: "/chefskiss2/api.php?url=Search/homePost",
      
      initialize: function(){
  
      }
  
    });
   
    return domandaCollection;
  });
  
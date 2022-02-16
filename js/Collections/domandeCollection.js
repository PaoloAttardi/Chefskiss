define([
    'jquery',
    'underscore',
    'backbone',
    'Models/domandaModel'
  ], function($, _, Backbone, domandaModel){
    var domandaCollection = Backbone.Collection.extend({
      model: domandaModel,
      
      initialize: function(){
  
      }
  
    });
   
    return domandaCollection;
  });
  
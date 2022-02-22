define([
    'underscore',
    'backbone'
  ], function(_, Backbone) {
    
    var ricetta = Backbone.Model.extend({
      idAttribute: "idRicetta",

    initialize: function (){
      
    }

  });
  
    return ricetta;
  
  });
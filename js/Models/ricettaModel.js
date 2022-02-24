define([
    'underscore',
    'backbone'
  ], function(_, Backbone) {
    
    var ricetta = Backbone.Model.extend({
      idAttribute: "idRicetta",
      url: "/chefskiss2/api.php?url=Search/getRicette",

    initialize: function (){
      
    }

  });
  
    return ricetta;
  
  });
define([
    'underscore',
    'backbone'
  ], function(_, Backbone) {
    
    var ricetta = Backbone.Model.extend({
      urlRoot: "/api/search/homeView",
      idAttribute: "idRicetta",

    initialize: function (){
      console.log('ciao')
    }

  });
  
    return ricetta;
  
  });

  /*var ricetta = new ricetta({ id: 1 });
  ricetta.fetch({
    success: function(){},
    error: function(){}
  });*/

  // GET Chefskiss/api/ricetta/1
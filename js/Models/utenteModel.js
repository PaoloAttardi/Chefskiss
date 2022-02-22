define([
    'underscore',
    'backbone'
  ], function(_, Backbone) {
    
    var utente = Backbone.Model.extend({
        urlRoot: "/chefskiss2/api.php?url=Utente/login", 
        idAttribute: "idUser",

        initialize: function (){},

    });
  
    return utente;
  
  });
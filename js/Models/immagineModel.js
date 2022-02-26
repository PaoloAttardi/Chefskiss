define([
    'underscore',
    'backbone'
  ], function(_, Backbone) {
    
    var immagine = Backbone.Model.extend({
      url: "/chefskiss2/api.php?url=Search/getImmagine",
    });

  
    return immagine;
  
  });
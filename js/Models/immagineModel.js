define([
    'underscore',
    'backbone'
  ], function(_, Backbone) {
    
    var immagine = Backbone.Model.extend({
      url: "/chefskiss2/index.php?url=Search/getImmagine",
    });

  
    return immagine;
  
  });
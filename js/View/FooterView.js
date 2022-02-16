define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/footerTemplate.html'
  ], function($, _, Backbone, footerTemplate){
  
    var FooterView = Backbone.View.extend({
      el: $("#footer"),
      /*template: _.template($('#footerTemplate').html()),*/
  
      render: function(){
        this.$el.html(footerTemplate);
      }
  
    });
  
    return FooterView;
    
  });
  
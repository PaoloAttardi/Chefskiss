define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/ProfiloRicette.html',
    'js/Collections/RicetteCollection.js'
  ], function($, _, Backbone, profiloTemplate, RicetteCollection){
  
    var ProfiloRicetteView = Backbone.View.extend({
      el: $("#page2"),

    initialize: function(model) {
        var that = this;
        ricette = new RicetteCollection();
        ricette.fetch({
            data: $.param({
                parametri: ['autore', '=', model.get('idUser')],
                order: '',
                offset: 0,
                limit: 9,
                like: ''
            }),
                success: function(){
                    that.collection = ricette.at(0);
                    that.render();
                }
            })
        },

    render: function(){
        var that = this;
        var data = {
            ricette: that.collection.toJSON().data,
            nRicette: that.collection.toJSON().total,
            _: _
        }
        that.$el.show();
        var compiledTemplate = _.template( profiloTemplate, data );
        that.$el.html(compiledTemplate);
    }
  
    });
    return ProfiloRicetteView;
})
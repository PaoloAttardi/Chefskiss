define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/ProfiloRicette.html',
    'js/Collections/RicetteCollection.js'
  ], function($, _, Backbone, profiloTemplate, RicetteCollection){
  
    var ProfiloRicetteView = Backbone.View.extend({
      el: $("#page2"),

    initialize: function(model, number) {
        var that = this;
        ricette = new RicetteCollection();
        var page = number * 9;
        var onDataHandler = function() {
          that.render(Number(number));
        }
        var limite = 9;
        ricette.fetch({
            data: $.param({
                parametri: ['autore', '=', model.get('idUser')],
                order: '',
                offset: page,
                limit: limite,
                like: ''
            }),
                success: function(){
                    that.collection = ricette;
                    onDataHandler();
                }
            })
        },

    render: function(number){
        var that = this;
        ricette = this.collection.at(0);
        var total = Number(ricette.toJSON().total);
        var n = number * 9 + 9;
        if(total > n){
          var nPage = number + 1;
        } else var nPage = false;
        var pPage = number - 1;
        var data = {
            ricette: ricette.toJSON().data,
            nRicette: ricette.toJSON().total,
            page: number,
            nextPage: nPage,
            previousPage: pPage,
            _: _
        }
        var compiledTemplate = _.template( profiloTemplate, data );
        that.$el.html(compiledTemplate);
    }
  
    });
    return ProfiloRicetteView;
})
define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/Forum.html',
    'js/Collections/domandeCollection.js',
    'js/Collections/categorieCollection.js',
    'text!templates/Post-template.html'
  ], function($, _, Backbone, forumTemplate, domandeCollection, categorieCollection, postTemplate){

    var HomeView = Backbone.View.extend({
      el: $("#page1"),
      events: {
        'scroll': 'checkScroll'
      },

      initialize: function(search) {
        this.remove();
        var that = this;
        this.search = search.split('=');
        this.parametro = '';
        this.like = '';
        if(this.search.length == 2){
           if(that.search[0] == 'Categoria') that.parametro = ['categoria', '=', that.search[1]];
           else that.like = that.search[1];
        }
        _.bindAll(this, 'checkScroll');
        // bind to window
        $(window).scroll(this.checkScroll);
        // isLoading is a useful flag to make sure we don't send off more than
        // one request at a time
        this.isLoading = false;
        categorie = new categorieCollection();
        categorie.fetch({
          success: function(){
            that.categorie = categorie;
            onDataHandler();
          }
        });
        var onDataHandler = function() {
          var data = {
            categorie: that.categorie.toJSON(),
            _: _
          };
          var compiledTemplate = _.template( forumTemplate, data );
          that.$el.html(compiledTemplate);
        }
        this.domande = new domandeCollection();
        this.page = 0;
        this.loadResults(this.page);
      },
  
      render: function () {
        domande = this.collection.at(0);
        var data = {
          post: domande.toJSON().data,
          _: _
        };
        var compiledTemplate = _.template( postTemplate, data );
        $("#post-widget").append(compiledTemplate);
      },

      loadResults: function (number) {
        var that = this;
        var onDataHandler = function() {
          that.render();
        }
        var page = Number(number) * 5;
        // we are starting a new load of results so set isLoading to true
        this.isLoading = true;
        var limite = 5;
        this.domande.fetch({ 
          data: $.param({
            parametri: that.parametro,
            order: '',
            offset: page,
            limit: limite,
            like: that.like
          }),
          success: function () {
            that.collection = that.domande;
            // Now we have finished loading set isLoading back to false
            that.isLoading = false;
            onDataHandler();
          }
        });      
      },
      checkScroll: function () {
          if( !this.isLoading && (window.innerHeight + window.scrollY) >= document.body.offsetHeight) { //sono alla fine della scroll bar
            this.page += 1; // Load next page
            this.loadResults(this.page);
          }
      },

      remove: function() {
        $(window).off('scroll', this.checkScroll);
        //Backbone.View.prototype.remove.apply(this);
      }
  
    });
  
    return HomeView;
    
  });
  
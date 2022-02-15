require.config({
    paths: {
      jquery: '../client/libs/jquery/jquery-min',
      underscore: '../client/libs/underscore/underscore-min',
      backbone: '../client/libs/backbone/backbone-min',
      templates: '../client/templates'
    }
  
  });
  
  require([
    // Load our app module and pass it to our definition function
    'app',
  ], function(App){
    // The "app" dependency is passed in as "App"
    // Again, the other dependencies passed in are not "AMD" therefore don't pass a parameter to this function (AMD: Asynchronous Module Definition)
    App.initialize();
    
  });
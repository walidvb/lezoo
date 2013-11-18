(function($) {
  Drupal.behaviors.lezooAngular = {};
  Drupal.behaviors.lezooAngular.attach = function(context) {

    var leZooApp = angular.module('leZooApp', ['ngResource']);

    leZooApp.factory('genresFactory', function($http){
      return {
        getGenresAsync: function(callback) {
          $http.get('json/genres').success(callback);
        }
      }
    })
    leZooApp.controller('feedFilter', function ($scope, genresFactory) {
      genresFactory.getGenresAsync(function(results){

        $scope.genres = results.genres;
        console.log($scope.genres);
        for(genre in $scope.genres)
        {
          console.log(genre);
          genre.value = 'checked';
        }
      })

      console.log($scope);  
    });
  }
})(jQuery);
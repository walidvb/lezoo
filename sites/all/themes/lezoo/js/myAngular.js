(function($) {
  Drupal.behaviors.lezooAngular = {};
  Drupal.behaviors.lezooAngular.attach = function(context) {

    var leZooApp = angular.module('leZooApp', []);

    leZooApp.factory('genresFactory', function($http){
      return {
        getGenresAsync: function(callback) {
          $http.get(Drupal.settings.basePath + 'json/genres').success(callback);
        }
      }
    })
    leZooApp.controller('feedFilter', function ($scope, genresFactory) {
      genresFactory.getGenresAsync(function(results){

        $scope.genres = results.genres;
        //console.log($scope.genres);
        for(var i = 0; i< $scope.genres.length; i++)
        {

          $scope.genres[i].selected = 'true';
        }
      });

      $scope.params = function(){
        var result = [];
        angular.forEach($scope.genres, function(item){
          //console.log(item);
          if (item.selected) 
            {
              result.push(item.tid);
            }
        });
        return (result !== "undefined" && (result.length == $scope.genres.length || result.length == 0) ) ? '' : result.join('+') + '/';
      };

    });
  }
})(jQuery);
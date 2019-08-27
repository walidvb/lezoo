(function($) {
  Drupal.behaviors.lezooAngular = {};
  Drupal.behaviors.lezooAngular.attach = function(context) {

    var leZooApp = angular.module('leZooApp', [])
    .factory('genresFactory', function($http){
      return {
        getGenresAsync: function(callback) {
          $http.get(Drupal.settings.basePath + 'json/genres').success(callback);
        }
      };
    })
    .controller('feedFilter', function ($scope, genresFactory) {
      genresFactory.getGenresAsync(function(results){
        $scope.genres = results.genres;
        for(var i = 0; i < $scope.genres.length; i++)
        {
          $scope.genres[i].selected = true;
        }

        $scope.changeAll = function(value){
          for(var i = 0; i < $scope.genres.length; i++)
          {
            $scope.genres[i].selected = value;
          }
        };
        $scope.params = function(){
          var result = [];
          angular.forEach($scope.genres, function(item){
            if (item.selected)
            {
              result.push(item.tid);
            }
          });
          return (result !== "undefined" && (result.length === $scope.genres.length || result.length === 0) ) ? 'all/' : (result.join('+') + '/');
        };
      });
    });
  };
})(jQuery);
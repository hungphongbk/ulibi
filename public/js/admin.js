(function() {
  var app;

  app = angular.module('UlibiAdmin', ['ui.router', 'ngResource']);

  app.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/dest/view');
    $stateProvider.state('home', {
      url: '/'
    }).state('dest', {
      url: '/dest',
      controller: 'DestController',
      templateUrl: 'ngtmpl/destinations.view.html'
    }).state('dest.viewMD', {
      url: '/view',
      views: {
        master: {
          templateUrl: 'ngtmpl/destinations.master.html'
        },
        detail: {
          templateUrl: 'ngtmpl/destinations.detail.html'
        }
      }
    }).state('articles', {
      url: '/articles',
      controller: 'ArticlesController',
      templateUrl: 'ngtmpl/articles.view.html'
    }).state('articles.viewMD', {
      url: '/view',
      views: {
        master: {
          templateUrl: 'ngtmpl/articles.master.html'
        },
        detail: {
          templateUrl: 'ngtmpl/articles.detail.html'
        }
      }
    });
  });

  app.directive('script', function() {
    return {
      restrict: 'E',
      scope: false,
      link: function(scope, elem, attrs) {
        var code, s, src;
        if ((attrs['lazyload'] != null)) {
          s = document.createElement('script');
          s.type = 'text/javascript';
          src = elem[0].src;
          console.log(elem);
          if (src.length > 0) {
            s.src = src;
          } else {
            code = elem[0].text;
            s.text = code;
          }
          document.body.appendChild(s);
          elem[0].parentNode.removeChild(elem[0]);
        }
      }
    };
  });

  app.directive('jqbind', function($parse) {
    return {
      restrict: 'A',
      scope: true,
      transclude: false,
      compile: function(element, attrs) {
        var modelAccessor;
        modelAccessor = $parse(attrs.ngModel);
        return function(scope, element, attrs, controller) {
          var valueChange;
          valueChange = function() {
            var v;
            console.log('yeah');
            v = element[0].value;
            scope.$apply(function(scope) {
              var arr;
              arr = v.split(', ').map(function(o) {
                return JSON.parse(o);
              });
              modelAccessor.assign(scope, arr);
            });
          };
          element.on('change', valueChange);
          scope.$watch(modelAccessor, function(val) {
            element.val(val);
          });
        };
      }
    };
  });

  app.factory('UlibiAdminApi', function($resource) {
    return {
      Dest: $resource('admin/destination/:id'),
      DestPhoto: $resource('admin/destination/:des_id/photo/:id', {
        des_id: '@des_id'
      })
    };
  });

  this.DestPhoto = function(UlibiAdminApi) {
    var destAPI, destPhotoAPI;
    destAPI = UlibiAdminApi.Dest;
    destPhotoAPI = UlibiAdminApi.DestPhoto;
    this.desId = -1;
    this.relatedPhotos = [];
    this.destinationsList = [];
    this.newDest = {
      'des_name': 'Đảo Hòn Tre',
      'des_coors': {
        'longitude': '',
        'latitude': ''
      },
      'des_instruction': '',
      'related_photos': []
    };
    this.newPhoto = {
      'photo_url': 'http://www.freelargeimages.com/wp-content/uploads/2014/12/Landscape_01.jpg'
    };
    this.uploadState = 0;
    Object.defineProperty(this, 'uploadStateStr', {
      get: function() {
        switch (this.uploadState) {
          case 0:
            return 'Upload';
          case 1:
            return 'Waiting...';
          case 2:
            return 'Completed!';
        }
      }
    });
    this.uploadComplete = function() {};
    this.selectDestinationComplete = function() {};
    Object.defineProperty(this, 'destinationId', {
      get: function() {
        return this.desId;
      },
      set: function(id) {
        if (id !== this.desId) {
          this.desId = id;
          this.relatedPhotos = destPhotoAPI.query({
            des_id: id
          });
          this.selectDestinationComplete();
        }
      }
    });
    Object.defineProperty(this, 'currentDestination', {
      get: function() {
        return this.destinationsList[this.desId - 1];
      }
    });
    this.uploadNewPhoto = (function(_this) {
      return function() {
        if ((_this.newPhoto.photo_url != null) && _this.newPhoto.photo_url.length > 0) {
          console.log('upload begin');
          _this.uploadState = 1;
          destPhotoAPI.save({
            des_id: _this.desId
          }, _this.newPhoto, function(response) {
            this.uploadState = 2;
            this.relatedPhotos.push(response);
            setTimeout(function() {
              this.uploadState = 0;
              this.newPhoto = {};
              this.uploadComplete();
            }, 1000);
          });
        }
      };
    })(this);
    this.createNewDestination = (function(_this) {
      return function() {
        destAPI.save(_this.newDest, function(response) {
          return console.log(response);
        });
      };
    })(this);
    this.destinationsList = destAPI.query();
  };

  this.DestController = function($scope, UlibiAdminApi) {
    $scope.dataSrc = new DestPhoto(UlibiAdminApi);
    $scope.dataSrc.selectDestinationComplete = function() {};
    $scope.dataSrc.uploadComplete = function() {
      return $scope.$apply();
    };
    $scope.dataSrc.destinationId = 1;
    $scope.select = function(i) {
      $scope.dataSrc.destinationId = i;
    };
    $scope.itemEditMode = false;
    $scope.saveItem = function() {};
    $scope.toggleItemMode = function() {
      if ($scope.itemEditMode) {
        $scope.saveItem();
      }
      $scope.itemEditMode = !$scope.itemEditMode;
    };
  };

  this.ArticlesController = function($scope, UlibiAdminApi) {};

  app.controller('DestController', this.DestController);

  app.controller('ArticlesController', this.ArticlesController);

}).call(this);

//# sourceMappingURL=admin.js.map

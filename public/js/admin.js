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
    });
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
    var API, that;
    that = this;
    API = UlibiAdminApi.DestPhoto;
    this.desId = -1;
    this.relatedPhotos = [];
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
    this.uploadComplete = function() {
      return console.log('upload completed');
    };
    Object.defineProperty(this, 'destinationId', {
      get: function() {
        return this.desId;
      },
      set: function(id) {
        if (id !== this.desId) {
          this.desId = id;
          this.relatedPhotos = API.query({
            des_id: id
          });
        }
      }
    });
    this.uploadNewPhoto = function() {
      if ((that.newPhoto.photo_url != null) && that.newPhoto.photo_url.length > 0) {
        console.log('upload begin');
        that.uploadState = 1;
        API.save({
          des_id: that.desId
        }, this.newPhoto, function(response) {
          that.uploadState = 2;
          console.log(response);
          that.relatedPhotos.push(response);
          setTimeout(function() {
            console.log(that);
            that.uploadState = 0;
            that.newPhoto = {};
            that.uploadComplete();
          }, 1000);
        });
      }
    };
  };

  this.DestController = function($scope, UlibiAdminApi) {
    $scope.dataSrc = UlibiAdminApi.Dest.query();
    $scope.selected = {
      index: 0,
      object: $scope.dataSrc,
      relPhotos: new DestPhoto(UlibiAdminApi)
    };
    $scope.selected.relPhotos.uploadComplete = function() {
      return $scope.$apply();
    };
    $scope.select = function(i) {
      $scope.selected.index = i;
      $scope.selected.object = $scope.dataSrc[i];
      $scope.selected.relPhotos.destinationId = i + 1;
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

  app.controller('DestController', this.DestController);

}).call(this);

//# sourceMappingURL=admin.js.map

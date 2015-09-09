var app=angular.module('Ulibi');
app.factory('UlibiApi',function($http){
    var urlBase = '/ulibi/api/';
    var h=$http;
    var api= {
        article: {
            postfix: 'article'
        },
        destinations: {
            postfix: 'dest'
        }
    };
    angular.forEach(api, function(section,_){
        section.getAll=function(param){
            param = (param === undefined)?'':'?'+param;
            return h.get(urlBase+this.postfix+'/all'+param);
        }
    });

    return api;
});
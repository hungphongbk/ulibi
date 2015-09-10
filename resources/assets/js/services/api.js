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
        },
        ulibier: {
            postfix: 'ulibier'
        }
    };
    angular.forEach(api, function(section,_){
        section.getAll=function(param){
            param = (param === undefined)?'':'?'+param;
            return h.get(urlBase+this.postfix+'/all'+param);
        }
    });

    api.ulibier.trending=function(top){
        top=top||3;
        return h.get(urlBase+this.postfix+'/trending?top='+top);
    };

    return api;
});
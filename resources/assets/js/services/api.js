var app=angular.module('Ulibi');
app.factory('UlibiApi',function($http,$location){
    function getUrlBase(loc){
        var root = loc.$$absUrl
            .split('#')[0]
            .replace(window.location.origin,'');
        if(root.endsWith('/'))
            root=root.slice(0,-1);
        if(root.endsWith('index.html'))
            root=root.replace('index.html','');
        return root;
    }
    console.log(getUrlBase($location));
    var urlBase = getUrlBase($location)+'/api/';
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
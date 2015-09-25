var app=angular.module('Ulibi');
app.directive('bootstrapCol',function(){
    return {
        restrict: 'A',
        link:function(s,e,a){
            var units=['xs','sm','md','lg'];
            var vals= a.bootstrapCol.split(' ')
                .map(function(e,i){
                    if(e==='-') return null;
                    return 'col-'+units[i]+'-'+e;
                })
                .join(' ');
            e.addClass(vals);
        }
    }
});
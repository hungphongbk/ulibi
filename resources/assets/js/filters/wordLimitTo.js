var app = angular.module('Ulibi');
function wordsLimitTo(input, limit, begin, exceedSign){
    begin = (!begin || isNaN(begin)) ? 0 : toInt(begin);
    begin = (begin < 0 && begin >= -input.length) ? input.length + begin : begin;
    limit+=begin;

    exceedSign = (typeof exceedSign!=='undefined')?exceedSign:'';

    var regex=/\s+/gi;
	var words = input.trim().replace(regex,' ').split(' ');
	//console.log(words.length,' ',begin+limit);
	var length=(begin+limit>words.length)?words.length:begin+limit;
	exceedSign=(begin+limit<words.length)?exceedSign:'';
	var rs = words.slice(0,length).join(' ')+exceedSign;
	//console.log(length);
	//console.log(words.slice(0,length).join('-'));
	return rs;
}
app.filter('wordLimit',function(){
	return wordsLimitTo;
});
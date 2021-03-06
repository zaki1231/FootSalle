!function(e,t){var n=t();"function"==typeof define&&define.amd?define([],n.Routing):"object"==typeof module&&module.exports?module.exports=n.Routing:(e.Routing=n.Routing,e.fos={Router:n.Router})}(this,function(){"use strict";function e(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var t=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},o=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),r=function(){function r(t,n){e(this,r),this.context_=t||{base_url:"",prefix:"",host:"",port:"",scheme:"",locale:""},this.setRoutes(n||{})}return o(r,[{key:"setRoutingData",value:function(e){this.setBaseUrl(e.base_url),this.setRoutes(e.routes),"prefix"in e&&this.setPrefix(e.prefix),"port"in e&&this.setPort(e.port),"locale"in e&&this.setLocale(e.locale),this.setHost(e.host),this.setScheme(e.scheme)}},{key:"setRoutes",value:function(e){this.routes_=Object.freeze(e)}},{key:"getRoutes",value:function(){return this.routes_}},{key:"setBaseUrl",value:function(e){this.context_.base_url=e}},{key:"getBaseUrl",value:function(){return this.context_.base_url}},{key:"setPrefix",value:function(e){this.context_.prefix=e}},{key:"setScheme",value:function(e){this.context_.scheme=e}},{key:"getScheme",value:function(){return this.context_.scheme}},{key:"setHost",value:function(e){this.context_.host=e}},{key:"getHost",value:function(){return this.context_.host}},{key:"setPort",value:function(e){this.context_.port=e}},{key:"getPort",value:function(){return this.context_.port}},{key:"setLocale",value:function(e){this.context_.locale=e}},{key:"getLocale",value:function(){return this.context_.locale}},{key:"buildQueryParams",value:function(e,t,o){var r=this,i=void 0,u=new RegExp(/\[\]$/);if(t instanceof Array)t.forEach(function(t,i){u.test(e)?o(e,t):r.buildQueryParams(e+"["+("object"===("undefined"==typeof t?"undefined":n(t))?i:"")+"]",t,o)});else if("object"===("undefined"==typeof t?"undefined":n(t)))for(i in t)this.buildQueryParams(e+"["+i+"]",t[i],o);else o(e,t)}},{key:"getRoute",value:function(e){var t=this.context_.prefix+e,n=e+"."+this.context_.locale,o=this.context_.prefix+e+"."+this.context_.locale,r=[t,n,o,e];for(var i in r)if(r[i]in this.routes_)return this.routes_[r[i]];throw new Error('The route "'+e+'" does not exist.')}},{key:"generate",value:function(e,n){var o=arguments.length>2&&void 0!==arguments[2]&&arguments[2],i=this.getRoute(e),u=n||{},s=t({},u),c="",a=!0,l="",f="undefined"==typeof this.getPort()||null===this.getPort()?"":this.getPort();if(i.tokens.forEach(function(t){if("text"===t[0])return c=r.encodePathComponent(t[1])+c,void(a=!1);{if("variable"!==t[0])throw new Error('The token type "'+t[0]+'" is not supported.');var n=i.defaults&&t[3]in i.defaults;if(!1===a||!n||t[3]in u&&u[t[3]]!=i.defaults[t[3]]){var o=void 0;if(t[3]in u)o=u[t[3]],delete s[t[3]];else{if(!n){if(a)return;throw new Error('The route "'+e+'" requires the parameter "'+t[3]+'".')}o=i.defaults[t[3]]}var l=!0===o||!1===o||""===o;if(!l||!a){var f=r.encodePathComponent(o);"null"===f&&null===o&&(f=""),c=t[1]+f+c}a=!1}else n&&t[3]in s&&delete s[t[3]]}}),""===c&&(c="/"),i.hosttokens.forEach(function(e){var t=void 0;return"text"===e[0]?void(l=e[1]+l):void("variable"===e[0]&&(e[3]in u?(t=u[e[3]],delete s[e[3]]):i.defaults&&e[3]in i.defaults&&(t=i.defaults[e[3]]),l=e[1]+t+l))}),c=this.context_.base_url+c,i.requirements&&"_scheme"in i.requirements&&this.getScheme()!=i.requirements._scheme){var h=l||this.getHost();c=i.requirements._scheme+"://"+h+(h.indexOf(":"+f)>-1||""===f?"":":"+f)+c}else if("undefined"!=typeof i.schemes&&"undefined"!=typeof i.schemes[0]&&this.getScheme()!==i.schemes[0]){var p=l||this.getHost();c=i.schemes[0]+"://"+p+(p.indexOf(":"+f)>-1||""===f?"":":"+f)+c}else l&&this.getHost()!==l+(l.indexOf(":"+f)>-1||""===f?"":":"+f)?c=this.getScheme()+"://"+l+(l.indexOf(":"+f)>-1||""===f?"":":"+f)+c:o===!0&&(c=this.getScheme()+"://"+this.getHost()+(this.getHost().indexOf(":"+f)>-1||""===f?"":":"+f)+c);if(Object.keys(s).length>0){var d=void 0,y=[],v=function(e,t){t="function"==typeof t?t():t,t=null===t?"":t,y.push(r.encodeQueryComponent(e)+"="+r.encodeQueryComponent(t))};for(d in s)this.buildQueryParams(d,s[d],v);c=c+"?"+y.join("&")}return c}}],[{key:"getInstance",value:function(){return i}},{key:"setData",value:function(e){var t=r.getInstance();t.setRoutingData(e)}},{key:"customEncodeURIComponent",value:function(e){return encodeURIComponent(e).replace(/%2F/g,"/").replace(/%40/g,"@").replace(/%3A/g,":").replace(/%21/g,"!").replace(/%3B/g,";").replace(/%2C/g,",").replace(/%2A/g,"*").replace(/\(/g,"%28").replace(/\)/g,"%29").replace(/'/g,"%27")}},{key:"encodePathComponent",value:function(e){return r.customEncodeURIComponent(e).replace(/%3D/g,"=").replace(/%2B/g,"+").replace(/%21/g,"!").replace(/%7C/g,"|")}},{key:"encodeQueryComponent",value:function(e){return r.customEncodeURIComponent(e).replace(/%3F/g,"?")}}]),r}();r.Route,r.Context;var i=new r;return{Router:r,Routing:i}});
var routes = {"base_url":"","routes":{"charger_equipes":{"tokens":[["variable","\/","[^\/]++","rowId",true],["text","\/charger_equipes"]],"defaults":[],"requirements":[],"hosttokens":[],"methods":[],"schemes":[]}},"prefix":"","host":"localhost","port":"","scheme":"http","locale":[]}

$(document).ready(function(){

	$('.load-more').click(function(){
        var row = Number($('#row').val()) + 3;
        var allcount = Number($('#all').val());

        Routing.setRoutingData(routes);
		var url = Routing.generate('charger_equipes', {rowId:row});	

        console.log("url", url);        
        console.log("next index", row);
        if(row <= allcount) {
            $("#row").val(row);

			$.ajax({
				url: url,
				type: 'post',
				data: {row:row},
				beforeSend:function(){
					$(".load-more").text("Charger...");
				},
				success: function(equipes){
					console.log(equipes);
					setTimeout(function() {
                        console.log("at least it works!");
                        for($i=0; $i < equipes.length;$i++) {
                            var html = `
                            <div class="col-md-4 result">
                            <div class="card-panel resultat-color">
                            <span >
                            <h3 class="mb-4">Résultat de l'équipe: ${equipes[$i].nom}</h3>'                        
                                            <p class="color-resulat-equipe">match gagné : ${equipes[$i].matchGagne}</p>
                                            <p class="color-resulat-equipe">match nul : ${equipes[$i].matchNul}</p>
                                            <p class="color-resulat-equipe">match perdu : ${equipes[$i].matchPerdu}</p>
                            </span>
                                    </div>
                                </div>
                            </div>`;

						    $(".result:last").after(html).show().fadeIn("slow");
                        }
                    
						console.log(row, allcount);

						// checking row value is greater than allcount or not
						if(row > allcount){
							// Change the text and background
							$('.load-more').text("Hide");
							$('.load-more').css("background","darkorchid");
						}else{
							$(".load-more").text("Charger plus de resultats");
						}
					}, 1000);

				}
			});
		} else {
            $(".load-more").text("Tous les résultats ont été chargés");
        }
	});
});

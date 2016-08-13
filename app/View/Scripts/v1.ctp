var tp = angular.module('TravelPAQ',[]);
tp.service('TravelPAQ', function($http) {
	var self = this;
	self.token = '<?=$token;?>';
	self.get_hola_mundo = function(params, success, error){
		$http.post("<?=FULL_BASE_URL.Router::url('/scripts/prueba');?>", params, {
			headers:  {
		        "TP-AUTH" : self.token
		    }
		}).then(function(response){
			if(success)
				success(response.data);
		},function(e){
			if(error)
				error(e);
		});
	}
});
var TravelPAQ = (function(){
	var self = this;
	return {
		init: function(){
			return "hola";
		},
		getPackageList: function(params,success,error){
			//validaciones de params 
			angular.injector(['ng', 'TravelPAQ']).get("TravelPAQ").get_hola_mundo(params,success,error);
		}
	}
})();
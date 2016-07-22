yum.define([
	PI.Url.create('Home', '/page.js')
], function(html){

	Class('App').Extend(Mvc.Component).Body({
	
		init: function(){
			this.page = new Home.Page();
		},

		viewDidLoad: function(){

		}
	
	});

});
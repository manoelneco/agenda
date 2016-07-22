yum.define([
    PI.Url.create('Modules', '/app.css'),
    PI.Url.create('Home', '/page.js')
], function(html){

    Class('App').Extend(Mvc.Component).Body({

        instances: function(){
            this.f7 = new Framework7({
                material: true,
                router: false
            });

            this.config = window.CONFIG;

            this.realtime = new PI.RealTime({
                channel: 'agenda@avo'
            });

		  	this.main = this.f7.addView('.view-main', {
		  		dynamicNavbar: true
		  	});
        },

        viewDidLoad: function(){
            var self = this;

            this.realtime.start();

            this.setPage(new Home.Page());

            $('.spinner').remove();

            this.base.viewDidLoad();
        },
        
        setPage: function(page){
            var html = Mvc.Helpers.render(page, page.view.html);
            
		  	this.main.router.load({
		  		content: html
		  	});

		  	page.view.element = $('.page[data-page="' + page.name + '"]');
		  	page.viewLoad();
		  	page.viewDidLoad();                        
        },
        
        loading: function(b){
            // b ? this.f7.showIndicator() : this.f7.hideIndicator();
            b ? this.showIndicator() : this.hideIndicator();
        },

        showIndicator: function(){
            $('body').append('<div class="loading-indicator spinner"></div>');
        },

        hideIndicator: function(){
            $('.loading-indicator').remove();
        },

    });

});
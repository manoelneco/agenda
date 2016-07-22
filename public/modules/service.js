yum.define([
    
], function (html) {

    Class('Service.Modules').Extend(PI.Service).Body({

        load: function(app){
            this.base.load(app);
        },

        routes: {
            
            'participantes': function(){
                app.loading(true);

                setTimeout(function(){
                    yum.download([ PI.Url.create('Participante', '/page.js') ], this, function() {
                        var page = new Participante.Page();
                        
                        app.setPage( page );
                    });
                }, 500);                             
            },
            
            'voltar': function() {
                app.main.router.back();
                PI.Url.Hash.to('#');
            },

        },

        events: {
            
        }

    });

});
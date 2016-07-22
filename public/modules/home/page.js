yum.define([
    PI.Url.create('Home', '/page.html'),
    PI.Url.create('Home', '/page.css'),
    PI.Url.create('Semana', '/painel.js'),    
], function(html){

    Class('Home.Page').Extend(Mvc.Component).Body({

        instances: function(){
            this.view = new Mvc.View(html);

            this.name = 'HomePage';

            this.semana = new Semana.Painel({
                dia: new Util.Date(app.config.diaInicio, app.config.mesInicio, app.config.anoInicio)                
            });
        },

    });

});
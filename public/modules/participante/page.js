yum.define([
    PI.Url.create('Participante', '/page.html'),
    PI.Url.create('Participante', '/participante.html'),
    PI.Url.create('Participante', '/page.css'),
    PI.Url.create('Participante', '/model.js'),
    PI.Url.create('Util', '/date.js'),
    PI.Url.create('Agenda', '/model.js'),
], function(html, participanteHtml){

    Class('Participante.Page').Extend(Mvc.Component).Body({

        instances: function(){
            this.view = new Mvc.View(html);

            this.name = 'participante-page';            
        },

        init: function(){
            this.dia = parseInt( PI.Url.Hash.getQuery('dia') );
            this.mes = parseInt( PI.Url.Hash.getQuery('mes') );
            this.ano = 2016;
            this.periodo = PI.Url.Hash.getQuery('periodo');

            var dia = new Util.Date(
                this.dia,
                this.mes,
                this.ano
            );

            this.weekname = dia.getWeekName();
            this.nomeMes = dia.getNomeMes();
        },

        viewDidLoad: function(){
            this.popule();

            this.base.viewDidLoad();
        },

        popule: function(){
            var ps = window.PARTICIPANTES;

            for(var i in ps){
                var p = ps[i];

                this.view.content.append(Mvc.Helpers.tpl(p, participanteHtml));
            }

            app.loading(false);
        },

        events: {
        
            '.participante-item click': function(e){
                var id = e.getAttribute('data-id');
                var agenda = new Agenda.Model();

                agenda.participanteId = parseInt(id);
                agenda.participante = Participante.Model.find( parseInt(id) )
                agenda.dia = this.dia;
                agenda.mes = this.mes;
                agenda.ano = this.ano;
                agenda.periodo = this.periodo;

                agenda.save().ok(function(){
                    app.realtime.publish();  
                });


                EventGlobal.trigger('agenda::update', agenda);
            }
        }

    });

});
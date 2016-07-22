yum.define([
    PI.Url.create('Semana', '/painel.html'),
    PI.Url.create('Semana', '/dia.html'),
    PI.Url.create('Util', '/date.js'),
    PI.Url.create('Agenda', '/model.js')
], function(html, diaHtml){

    Class('Semana.Painel').Extend(Mvc.Component).Body({

        instances: function(){
            this.view = new Mvc.View(html);

            this.realtime = app.realtime;

            this.agenda = new Agenda.Model();
        },

        viewDidLoad: function(){
            this.refresh();

            this.base.viewDidLoad();
        },

        refresh: function(){
            this.agenda.all().ok(this.popule, this);
        },

        popule: function(agendas){
            var dia = this.dia.clone();
            var diaFim = this.dia.clone().addDays(6);
            var view = '';

            while(true){
                view += Mvc.Helpers.tpl({
                    weekname: dia.getWeekName(),
                    dia: dia.getDia(),
                    mes: dia.getMes(),
                    ano: 2016
                }, diaHtml);

                if(!dia.compareTo( diaFim )) break;
                dia.addDays(1);
            }

            this.view.content.html( view );

            for(var i in agendas){
                var agenda = agendas[i];

                this.putImage(agenda);
            }

            app.loading(false);
        },

        getImage: function(dia, mes, ano, periodo){
            return this.view.element.find(Mvc.Helpers.tpl({
                dia: dia,
                mes: mes,
                ano: ano,
                periodo: periodo
            }, '[data-date="@{dia}_@{mes}_@{ano}_@{periodo}"]'));
        },

        putImage: function(agenda){
            var img = this.getImage(agenda.dia, agenda.mes, agenda.ano, agenda.periodo);

            img.attr('src', 'modules/participante/image/' + agenda.participante.photo);
        },

        events: {
        
            '{EventGlobal} agenda::update': function(agenda){
                this.putImage(agenda);
            },

            '{realtime} new::message': function(){
                this.refresh();
            },
        }

    });

});
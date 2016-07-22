yum.define([
    PI.Url.create('Home', '/page.html'),
    PI.Url.create('Home', '/select.html'),
    PI.Url.create('Home', '/page.css'),
    PI.Url.create('Agenda', '/model.js')
], function(html, selectHtml){

    Class('Home.Page').Extend(Mvc.Component).Body({

        instances: function(){
            this.view = new Mvc.View(html);

            this.agenda = new Agenda.Model();

            this.realtime = new PI.RealTime({
                channel: 'agenda@avo'
            });
        },

        viewWillLoad: function(){
            var view = Mvc.Helpers.prepare(window.PARTICIPANTES, '<option data-photo="@{photo}" value="@{id}">@{nome}</option>').toView();

            this.participantes = Mvc.Helpers.tpl({option: view}, selectHtml);

            this.base.viewWillLoad();
        },

        viewDidLoad: function(){

            this.realtime.start();

            this.view.element.find('select').select2({
                width: '100%',
                templateSelection: this.onSelect,
                templateResult: this.onSelect,
            });

            this.evidenceCurrentDay();

            this.popule();

            this.base.viewDidLoad();
        },

        popule: function(agendas){
            var self = this;

            this.agenda.all().ok(function(agendas){
                for(var i in agendas){
                    var agenda = agendas[i];

                    self.select( agenda.dia, agenda.mes, agenda.periodo, agenda.participanteId )
                }
            });
        },

        onSelect: function(state){
            if (!state.id) { return state.text; }
            
            var photo = state.element.getAttribute('data-photo');
            var $state = $(
                '<span style="text-align: center"><img src="modules/participante/image/' + photo + '" class="img-around" /></span>'
            );

            return $state;
        },

        select: function(dia, mes, periodo, participanteId){
            this.view.element.find('[data-periodo="' + periodo + '"][data-dia="' + dia + '"][data-mes="' + mes + '"] select').val(participanteId).trigger('change', true)
        },

        evidenceCurrentDay: function(){
            var dayindex = this.getCurrentDay();
            this.view.element.find('tr td:nth-child(' + dayindex + ')').css('background', '#9cf9b4');
        },

        getCurrentDay: function(){
            return new Date().getDate() - 20;
        },

        events: {
            
            'select change': function(e, evt, ignore){
                if(ignore) return;

                var self = this;
                var agenda = new Agenda.Model();

                agenda.participanteId = parseInt(e.value);;
                agenda.dia = $(e).parents('td').attr('data-dia');
                agenda.mes = $(e).parents('td').attr('data-mes');
                agenda.periodo = $(e).parents('td').attr('data-periodo');

                agenda.save().ok(function(){
                    self.realtime.publish();  
                });
            },

            '{realtime} new::message': function(content){
                this.popule();
            },

        }

    });

});
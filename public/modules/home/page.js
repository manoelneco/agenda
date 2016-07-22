yum.define([
    PI.Url.create('Home', '/page.html'),
    PI.Url.create('Home', '/select.html'),
    PI.Url.create('Home', '/page.css'),
], function(html, selectHtml){

    Class('Home.Page').Extend(Mvc.Component).Body({

        instances: function(){
            this.view = new Mvc.View(html);
        },

        viewWillLoad: function(){
            var view = Mvc.Helpers.prepare(window.PARTICIPANTES, '<option data-photo="@{photo}" value="@{id}">@{nome}</option>').toView();

            this.participantes = Mvc.Helpers.tpl({option: view}, selectHtml);

            this.base.viewWillLoad();
        },

        viewDidLoad: function(){

            this.view.element.find('select').select2({
                width: '100%',
                templateSelection: this.renderSelect,
                templateResult: this.renderSelect,
            });

            this.base.viewDidLoad();
        },

        renderSelect: function(state){
            if (!state.id) { return state.text; }
            
            var photo = state.element.getAttribute('data-photo');
            var $state = $(
                '<span style="text-align: center"><img src="modules/participante/image/' + photo + '" class="img-around" /></span>'
            );

            return $state;
        },

        events: {
            
            'select change': function(){
                console.log('1');
            },

        }

    });

});
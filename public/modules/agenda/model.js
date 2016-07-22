yum.define([
    
], function () {

    Class('Agenda.Model').Extend(Mvc.Model.Base).Body({

        instances: function () {

        },

        init: function () {
            this.base.init('/agenda');
        },

        validations: function () {
            return {
                //'': new Mvc.Model.Validator.Required('')
            };
        },

        initWithJson: function (json) {
            var model = new Agenda.Model(json);

            return model;
        },

        actions: {
            'save': '/save'
        }

    });
});
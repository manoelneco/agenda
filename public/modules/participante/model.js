yum.define([
    
], function () {

    Class('Participante.Model').Extend(Mvc.Model.Base).Static({

        find: function(id){
            var ps = window.PARTICIPANTES;

            for(var i in ps){
                var p = ps[i];

                if(p.id.toString() == id.toString()) return p;
            }
        },

    }).Body({

        instances: function () {

        },

        init: function () {
            this.base.init('/Participante');
        },

        validations: function () {
            return {
                //'': new Mvc.Model.Validator.Required('')
            };
        },

        initWithJson: function (json) {
            var model = new Participante.Model(json);

            return model;
        },


        actions: {
            
        }

    });
});
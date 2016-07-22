/**
 * Configuration Globais
 */
Application.config({

    viewcontroller: {
        react: {
            enable: false
        }
    },

	resources: {
		cache: false
	},

    environment: {
		type: 'develop'
    },

    minify: {
       ignore: ['/jquery']  
    },

    ajax: {
        contentType: 'application/json'
    },

    model: {
        id: 'id'
    }

});

/**
 * Url Alias Base
 */
PI.Url.add('Public', 'localhost');
PI.Url.add('Modules', 'Public', '/modules');


/**
 * Url Alias Library
 */

/**
 * Url Alias Resources
 */
PI.Url.add('Home', 		        'Modules', '/home');
PI.Url.add('Agenda', 		    'Modules', '/agenda');
PI.Url.add('Util', 		        'Modules', '/util');
PI.Url.add('Semana', 		    'Modules', '/semana');
PI.Url.add('Participante',      'Modules', '/participante');

/**
 * Services
 */
PI.Service.add('Modules');
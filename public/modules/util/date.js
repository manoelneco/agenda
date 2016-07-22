yum.define([
    
], function(){

    Class('Util.Date').Body({
    
        instance: function(){
            this.date = new Date();
        },

        init: function(day, month, year){

            if(day != undefined){
                
                this.day = parseInt( day );
                this.month = parseInt(month);
                this.year = parseInt( year );

                this.date = new Date(this.year, this.month - 1,  this.day, 0, 0, 0, 0);
            }
        },

        now: function(){
            return new Util.Date();            
        },

        addDays: function(qtde){
            this.date.setDate( this.date.getDate() + parseInt(qtde) );

            return this;
        },

        getWeekName: function(){
             var days = ['Domingo', 'Segunda','Terça','Quarta','Quinta','Sexta','Sábado'];

             return days[ this.date.getDay() ];
        },

        compareTo: function(date){
            return this.date - date.date;
        },

        clone: function(){
            return new Util.Date(this.day, this.month, this.year);
        },

        getDia: function(){
            return this.date.getDate();  
        },

        getMes: function(){
            return this.date.getMonth() + 1;
        },

        getNomeMes: function(){
            var meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

            return meses[ this.date.getMonth() + 1 ];
        },

        getAno: function(){
            return this.date.getFullYear();
        },

    });

});
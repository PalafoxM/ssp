var ini = window.ssa || {};

ini.inicio = (function () {
    return {
        
        descripcionFormatter: function(value, row) {
            
            return value.substring(0, 50) + "...";
        }
        
        
        
    }
})();
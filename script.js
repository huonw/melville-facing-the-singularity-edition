(function() { 
    function attach(elem, event, func) {
	if (!elem) return;

	if (elem.addEventListener) {
	    elem.addEventListener(event, func, false);
	}
	else if (elem.attachEvent) {
	    elem.attachEvent('on'+event, func);
	}
	else {    
	    elem['on'+event] = func;
	}
    }
    function makeDefaulter(id) {
	var elem = document.getElementById(id);
	
	if (!elem) return false;
	
        var def_val = elem.value,
	    focus = function() {
		if (this.value === def_val) {
		    this.value = '';
		    this.className = this.className.replace(/\bdefault\b/,'');
		}
	    },
	    blur = function() {
		if (this.value === '') {
		    this.value = def_val;
		    this.className += ' default';
		}
	    };
	attach(elem, 'focus', focus);
	attach(elem, 'blur', blur);
	
	return true;
    }
    attach(window, 'load', function() {
	makeDefaulter('trvi-trvi');
    });
})();
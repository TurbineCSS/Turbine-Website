var Editor = new Class({


	Implements: [Options, Events],
	indentionChar: '',
	editor: null,


	initialize: function(editor){
		this.editorSetup(editor);
	},


	// Setup the editor
	editorSetup: function(editor){
		this.editor = document.id(editor);
		this.editor.addEvent('keypress', function(e){
			this.handleKeypress(e);
		}.bind(this));
		this.editor.addEvent('keyup', function(e){
			this.handleKeyup(e);
		}.bind(this));
	},


	// Get indention char(s)
	getIndentionChar: function(){
		var lines = this.editor.value.split(/\n/);
		var linecount = lines.length;
		for(var i = 0; i < linecount; i++){
			line = lines[i];
			nextline = lines[i + 1];
			if(nextline && line.trim() != '' && nextline.trim() != ''){
				var matches = nextline.match(/^([\s]+)(.*?)$/);
				if(matches.length == 3 && matches[1].length > 0 && matches[2].substr(0, 1) != '@'){
					this.indentionChar = matches[1];
					return;
				}
			}
		}
	},


	// Handle keys on keypress event
	handleKeypress: function(event){
		// Get/update indention char(s)
		// Not needed as long as handleEnter() does nothing
		// this.getIndentionChar();
		// Tabs
		if(event.code == 9){
			this.handleTab(event);
		}
		// Fire keypress event for this editor
		this.fireEvent('keypress');
	},


	// Handle keys on keyup event
	handleKeyup: function(event){
		// Enter
		if(event.code == 13){
			this.handleEnter(event);
		}
		// Fire keyup event for this editor
		this.fireEvent('keyup');
	},


	// Handle tab insertion
	handleTab: function(event){
		event.stop();
		var target = event.target;
		var ss = target.selectionStart;
		var se = target.selectionEnd;
		target.value = target.value.slice(0, ss).concat("\t").concat(target.value.slice(ss, target.value.length));
		if(ss == se){
			target.selectionStart = ++ss;
			target.selectionEnd = ++ss;
		}
		else{
			target.selectionStart = ++ss;
			target.selectionEnd = ++se;
		}
	},


	// Handle line break insertion
	handleEnter: function(event){
		// TODO
	}

});


window.addEvent('domready', function(){

	// Input elements
	var turbineinput = $('cssp');
	var cssinput = $('css');
	var htmlinput = $('html');
	var interactive = $('interactive');
	var browserinputs = $$('#browservars input[type=text]');


	if(turbineinput && cssinput){


		// Evaluate code
		var evaluate = function(){
			// Request CSS code
			var csscode = '';
			var browservars = '';
			browserinputs.each(function(el){
				browservars += '&' + el.get('name') + '=' + el.value;
			});
			var csspRequest = new Request({
				url: 'getcss.php',
				data: 'css=' + turbineinput.value + browservars,
				onSuccess: function(txt){
					// Update textarea
					cssinput.value = txt
					// Apply iframe operations
					var result = new IFrame($('result'));
					result.contentDocument.getElements('body')[0].set('html', htmlinput.value);
					var css = result.contentDocument.getElements('style')[0];
					// <style>-workaround for IE, see http://www.phpied.com/dynamic-script-and-style-elements-in-ie/
					if(css.styleSheet){
						css.styleSheet.cssText = txt; // IE
					}
					else{
						css.set('text', txt); // Normal Browsers
					}
				}
			}).send();
		};


		// Evaluate on button click
		$('go').addEvent('click', evaluate);


		// Evaluate in interactive mode
		$$([turbineinput, htmlinput, browserinputs]).addEvent('keyup', function(){
			if(interactive.checked){
				evaluate();
			}
		});


		// Add editor functionality
		var turbineEditor = new Editor('cssp');
		var htmlEditor = new Editor('html');


	}


});
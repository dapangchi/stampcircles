;(function(UI, window, undefined) {
// Settings
	var bufferSize = 512;
	var increase;
	var scroll = 0;

	var Console = UI.Console = {
		time : 0,
		init : function () {},
		process : function () {},
		setupEditor: function() {
			Console.Editor = ace.edit("synthesizer-editor");
			Console.Editor.setTheme("ace/theme/monokai");
			Console.Editor.getSession().setMode("ace/mode/javascript");
			Console.Editor.setShowPrintMargin(false);
			Console.Editor.getSession().setUseWrapMode(true);
			Console.Editor.commands.addCommand({
				name: 'compile',
				bindKey: {win: 'Ctrl-Enter',  mac: 'Command-Enter'},
				//exec: Synth.parseCode
			});
		},

		
	    parseCode: function(e) {

			// Listen for nested errors which try-catch can'Synth.time find
			window.onerror = Console.error;
			var codeValue = Console.Editor.getValue();

			// Remove error class
			$codeView.className = $codeView.className.replace("error", "");

			// Remove the previous script
			var $script = $("#synthesizer-script");
			if ($script) { $script.remove(); }

			// Create new script and safely insert the code
			$script           = document.createElement("script");
			$script.id        = "synthesizer-script";
			//$script.innerHTML = "try{window.f=function(r){"+Console.XSSPreventer()+codeValue+"\n;return f}("+sampleRate+")}catch(e){Synth.error(e)}";

			// Update the URL hash if the code was parsed due to a user event
			if (e) { window.location.hash = btoa(Console.Shader.Editor.getValue()) + ";" + btoa(codeValue); }

			// Append the script
			document.body.appendChild($script);

			// Stop listening for global errors after a short time
			window.setTimeout(function() { window.onerror = null; }, 100);
		}			

	}




	


}(window.UI || (window.UI = {}), window));
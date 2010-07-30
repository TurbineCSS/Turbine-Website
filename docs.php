<?php include('header.php'); ?>


<div id="docs">


<div id="toc">
	<ul>
		<li>&darr; <a href="#intro">Introduction</a>
			<ul>
				<li><a href="#intro-goalsandfeatures">Goals and Features</a></li>
			</ul>
		</li>
		<li>&darr; <a href="#usage">Usage</a>
			<ul>
				<li><a href="#usage-setup">Installation and setup</a></li>
				<li><a href="#usage-editor">Editor setup</a></li>
				<li><a href="#usage-syntax">Basic syntax</a></li>
				<li><a href="#usage-configuration">Configuration</a></li>
				<li><a href="#usage-advanced">Advanced syntax</a></li>
				<li><a href="#usage-constantsaliases">Constants and aliases</a></li>
				<li><a href="#usage-inheritancetemplating">Inheritance and prototyping</a></li>
			</ul>
		</li>
		<li>&darr; <a href="#plugins">Core Plugins</a>
			<ul>
				<li><a href="#plugins-fontface">@font-face</a></li>
				<li><a href="#plugins-backgroundgradient">Background gradient</a></li>
				<li><a href="#plugins-borderradius">Border radius</a></li>
				<li><a href="#plugins-boxshadow">Box shadow</a></li>
				<li><a href="#plugins-boxsizing">Box sizing</a></li>
				<li><a href="#plugins-sniffer">Browser and platform sniffer</a></li>
				<li><a href="#plugins-bugfix">Browser bugfixes</a></li>
				<li><a href="#plugins-colormodels">Colormodels</a></li>
				<li><a href="#plugins-datauri">Data-URIs</a></li>
				<li><a href="#plugins-html5">HTML5</a></li>
				<li><a href="#plugins-inlineblock">Inline block</a></li>
				<li><a href="#plugins-load">Load</a></li>
				<li><a href="#plugins-minifier">Minifier</a></li>
				<li><a href="#plugins-opacity">Opacity</a></li>
				<li><a href="#plugins-quote">Quote style</a></li>
				<li><a href="#plugins-reset">Reset stylesheet</a></li>
				<li><a href="#plugins-transforms">Transforms</a></li>
				<li><a href="#plugins-meta">Meta plugins</a></li>
			</ul>
		</li>
		<li>&darr; <a href="#dev">Development</a>
			<ul>
				<li><a href="#dev-contribute">Contribute</a></li>
				<li><a href="#dev-plugins">Plugin development</a></li>
				<li><a href="#dev-styleguide">Style guide</a></li>
			</ul>
		</li>
		<li>&darr; <a href="#tools">Tools</a>
			<ul>
				<li><a href="#tools-converter">Converter</a></li>
				<li><a href="#tools-shell">Shell</a></li>
			</ul>
		</li>
		<li>&darr; <a href="#faq">FAQ</a>
			<ul>
				<li><a href="#faq-why">Why use Turbine?</a></li>
				<li><a href="#faq-tradeoffs">What are the tradeoffs?</a></li>
				<li><a href="#faq-performance">What about performance?</a></li>
				<li><a href="#faq-projects">Ready for real projects?</a></li>
				<li><a href="#faq-cssp">What's CSSP?</a></li>
				<li><a href="#faq-advice">Any general advice?</a></li>
			</ul>
		</li>
	</ul>
</div>



<h2 id="intro">Introduction</h2><div>
<p>
	Turbine is a PHP-powered tool that introduces a new way for writing CSS. It's syntax and features are designed to
	decrease css development time and web developer headache. Turbine takes this&nbsp;&hellip;
</p>
<pre class="cssp">
// Welcome to Turbine!
@media screen

#foo, #bar
    color:#FF0000
    margin-left, margin-right: 4px
    div.alpha, div.beta
        font-weight:bold
        border-radius:4px</pre>
&hellip; and turns it into&nbsp;&hellip;
<pre class="css">@media screen {
    #foo, #bar {
        color: #FF0000;
        margin-left: 4px;
        margin-right: 4px;
    }
    #foo div.alpha, #foo div.beta, #bar div.alpha, #bar div.beta {
        font-weight: bold;
        border-radius: 4px;
    }
}</pre>
<p>
	&hellip;or, if you like fast-loading websites, directly into this (which is automatically cached, gezipped and served with the correct expires headers):
</p>
<pre class="css">@media screen{#foo,#bar{color:#F00;margin-left:4px;margin-right:4px}#foo div.alpha,#foo div.beta,#bar div.alpha,#bar div.beta{font-weight:bold;-moz-border-radius:4px;-webkit-border-radius:4px;-khtml-border-radius:4px;border-radius:4px}}</pre>
<p>
	Turbine can save you a lot of typing and time <em>and</em> allow you to focus on a website's design and functionality instead of
	css's limitations, page performance or your least favourite browser's latest bugs. Think jQuery for CSS. Being fully extensible, you
	can customize Turbine to your liking.
</p>
<h3 id="intro-goalsandfeatures">Goals and Features</h3><div>
<p>
	Turbine's basic features include:
</p>
<ul>
	<li>Minmal syntax&nbsp;&ndash; the less you have to type, the more you get done</li>
	<li>Packing, gzipping and automatic minification of multiple css files</li>
	<li>Constants (also known as "css variables") and selector aliases</li>
	<li>Oop-like inheritance, extension and templating features</li>
	<li>Nested css selectors</li>
	<li>Built-in device-, browser- and os sniffing</li>
	<li>Fully exensible through a very simple plugin system</li>
</ul>
<p>
	While Turbine's basic features may save you some keystrokes, it's plugins automate and simplify some of the more tedious and complicated
	aspects of writing css. See the plugins section for details.
</p>
</div>
</div>


<h2 id="usage">Usage</h2><div>

<h3 id="usage-setup">Installation and setup</h3><div>
<h4>Installation</h4>
<p>
	Simply download the latest release from <a href="http://github.com/SirPepe/Turbine">Github</a> and unpack it to a directory on your
	web server. PHP 5.2 is required.
</p>
<h4>Global configuration</h4>
<p>
	Turbine has two sets of configuration options - one on a per-file-basis and one on a global level. These global configuration options
	are set in the file <code>config.php</code>. The following settings are availiable:
</p>
<table>
	<thead>
		<tr>
			<th>Option</th>
			<th>Effect</th>
			<th>Default</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><code>debug_level</code></td>
			<td>Disable all error messages (<code>0</code>), enable web developer debugging messages (<code>1</code>) or enable all error messages (<code>2</code>)</td>
			<td><code>1</code></td>
		</tr>
		<tr>
			<td><code>css_base_dir</code></td>
			<td>Sets the base directory for the css and cssp files</td>
			<td></td>
		</tr>
		<tr>
			<td><code>minify_css</code></td>
			<td>Leave css files unchanged by Turbine (<code>false</code>) or minify them (<code>true</code>)</td>
			<td><code>true</code></td>
		</tr>
	</tbody>
</table>


<h4>Adding Turbine files to HTML documents</h4>
<p>
	Turbine files are simple text files with the extension <abbr title="CSS Preprocessor"><code>.cssp</code></abbr>.
	To use Turbine, embed <code>css.php</code> in your HTML like a normal css file and add the <code>files</code> argument containing
	a list of Turbine files separated by semicolons.
</p>
<pre>&lt;link
	rel="stylesheet"
	href="path/to/turbine/css.php?files=file1.cssp;file2.cssp"
/&gt;</pre>
<p>
	The base path for the files can be changed in the file <code>config.php</code> (<code>css_base_dir</code>).
	You can also include regular css files, which will be output unchanged (or minified, if the <code>minify_css</code>
	configuration option is set to <code>true</code>).
</p>
<p>
	The files as processed in sequence and <strong>don't</strong> influence each other in any way. For example,
	<a href="#usage-constantsaliases">constants</a> defined in <code>file1</code> won't apply to code in <code>file2</code>. If
	you want share code between files, use the <a href="#plugins-load">loader plugin</a>.
</p>



<h3 id="usage-editor">Setting up your editor</h3>
<p>
	There's basic Turbine support for Dreamweaver, UltraEdit and GtkSourceView.
</p>
<h4>Dreamweaver</h4>
<p>
	You can find an extension for <strong>Dreamweaver</strong> in <code>resources/editors/dreamweaver</code>. This extension adds
	.cssp-files to Dreamweaver's list of supported filetypes, puts in place some code highlighting and autocompletion (code hinting)
	for Turbine files. To install the extension, just double click <code>turbine.mxp</code>, or open the Extension Manager and select
	File&nbsp;&rarr;&nbsp;Install&nbsp;Extension&hellip;, browse for <code>turbine.mxp</code> and select it.
</p>
<p>
	<img src="img/dreamweaver.png" alt="Dreamweaver code view" width="650" height="559">
</p>
<h4>UltraEdit</h4>
<p>
	Follow <a href="http://www.ultraedit.com/support/tutorials_power_tips/ultraedit/add_a_wordfile.html">this guide</a> on how to add
	the Turbine wordfile <code>resources/editors/ultraedit/turbine.uew</code> to <strong>UltraEdit</strong>. Use the tags listed in
	<code>resources/editors/ultraedit/turbine.txt</code> to complete your tag list.
</p>
<p>
	<img src="img/ultraedit.png" alt="UntraEdit source view" width="550" height="456">
</p>
<h4>GtkSourceView</h4>
<p>
	The language file for <strong>GtkSourceView</strong> adds syntax highlighting to editors like Gedit and Anjuta. Simply copy the
	file <code>turbine.lang</code> from <code>resources/editors/gtksourceview-2.0/language-specs</code> to either
	<code>~/.local/share/editors/gtksourceview-2.0/language-specs</code> or
	<code>/usr/local/share/editors/gtksourceview-2.0/language-specs</code>.
</p>
<p>
	<img src="img/gtksourceview.png" alt="GtkSourceView highlighting in action" width="498" height="500">
</p>
<h4>TextMate</h4>
<p>
	The <code>Turbine.tmbundle</code> adds syntax highlighting with a small property and plugin documentation for <strong>TextMate</strong>. Simply copy the
	file <code>Turbine.tmbundle</code> from <code>resources/editors/textmate</code> to
	<code>~/Library/Application Support/TextMate/Bundles</code>. Now select Bundles&nbsp;&rarr;&nbsp;Bundle Editor&nbsp;&rarr;&nbsp;Reload Bundles from within TextMate.
</p>
<p>
	<img src="img/textmate.png" alt="Turbine code in TextMate" width="649" height="491">
</p>


<h3 id="usage-syntax">Basic syntax</h3><div>
<p>
	The one important thing about Turbine's syntax is that it is all about <strong>lines</strong>. The context of any statements
	in the code depends of the context of the statement's line.
</p>
<h4>Selectors and rules</h4>
<p>
	Turbine's syntax works a bit like <a href="#">Python</a>&nbsp;&ndash; <strong>the level of indentation</strong> instead of curly braces
	decides the context of a given line. A simple rule looks like this:
</p>
<pre class="cssp">#foo div > p               // Selector
    color:red              // Property and value
    font-weight:bold       // Property and value</pre>
<p>
	The way Turbine determines if a given line is a selector or a property-value-pair is the indentation level of the <em>following</em>
	line:
</p>
<pre class="cssp">#foo div > p               // Next line is indented = this is a selector
    color:red
    font-weight:bold
    span                   // Next line is indented = this is a selector
        color:blue</pre>
<p>
	This behavior allows nested selectors, which can be quite powerful (see <a class="smoothscroll" href="#usage-nested">nested selectors</a>).
	You can use any number or combination of spaces and tabs for indentation, but be careful to keep your indentation constistent in the whole
	file.
</p>
<p>
	Semicolons at the end of values are not required, but you can use them to put multiple declarations in one line:
</p>
<pre class="cssp">#foo div > p
    color:red; font-weight:bold
    span
        color:blue; font-style:italic</pre>
<h4>Comments</h4>
<p>
	There a two kinds of comments available: single line comments that start with <code>//</code>&nbsp;&hellip;
</p>
<pre class="cssp">// Hello world</pre>
<p>
	&hellip; and block comments that start with a line containing nothing but <code>--</code> and end with the same:
</p>
<pre class="cssp">--
Hello world
This is a block comment
--</pre>
<h4>@media rules</h4>
<p>
	<code>@media</code>-rules in Turbine a simple switches. Each <code>@media</code> line ends the previous <code>@media</code> block
	and opens a new one.
<pre class="cssp">@media screen // Open screen block
#foo
    background:red

@media print // Close screen block, open print block
#foo
    background:green

@media projection // Close print block, open projection block
#foo
    background:blue

@media screen // Close projection block, open screen block
#bar
    font.weight:bold</pre>
<p>
	<code>@media</code> block of the same type will be merged, so the resulting css looks like the following:
</p>
<pre class="css">@media screen {
    #foo {
        background: red;
    }
    #bar {
        font.weight: bold;
    }
}

@media print {
    #foo {
        background: green;
    }
}

@media projection {
    #foo {
        background: blue;
    }
}

</pre>
</p>
<h4 id="usage-syntax-prefixes">Prefixes</h4>
<p>
	There a a few reserved prefixes for properties, values and selectors:
</p>
<table>
	<thead>
		<tr>
			<th>Prefix</th>
			<th>Context</th>
			<th>Effect</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th rowspan="2">$</th>
			<td>Selector</td>
			<td>Selector alias, will be replaced by the selector defined in <code>@aliases</code> (see <a class="smoothscroll" href="#usage-constantsaliases">Constants and aliases</a>)</td>
		</tr>
		<tr>
			<td>Value</td>
			<td>Constant, will be replaced by the value defined in <code>@constants</code> (see <a class="smoothscroll" href="#usage-constantsaliases">Constants and aliases</a>)</td>
		</tr>
		<tr>
			<th>$_</th>
			<td>Value</td>
			<td>Special constant (<code>$_SCRIPTPATH</code>, <code>$_FILEPATH</code>, see <a class="smoothscroll" href="#usage-constantsaliases">Constants and aliases</a>)</td>
		</tr>
		<tr>
			<th>?</th>
			<td>Selector</td>
			<td>Template - whole element will be removed before output but properties can be inherited from it (see <a class="smoothscroll" href="#usage-inheritancetemplating-templating">Templating</a>)</td>
		</tr>
		<tr>
			<th>&amp;</th>
			<td>Value</td>
			<td>Expression (currently not used by Turbine or any plugin)</td>
		</tr>
	</tbody>
</table>
</div>


<h3 id="usage-configuration">Configuration</h3><div>
<p>
	The configuration options of Turbine can be set in the stylesheets themselves&nbsp;&ndash a <code>@turbine</code> block (called
	<strong>configuration block</strong>) allows for options to be set like properties and values in normal CSS code. There are
	at the moment two things that can be controlled there: compression and plugins.
</p>
<h4>Compression</h4>
<p>
	Turbine can output CSS code in a minified form.
</p>
<pre class="cssp">@turbine
    compress:1
#foo
    color:red
    background:blue</pre>
<p>
	Becomes
</p>
<pre class="css">#foo{color:red;background:blue}</pre>
<p>
	That's a good thing to have since everybody likes smaller downloads and the CSS code generates tends to be more verbose than
	handwritten CSS anyway. To enable compression simply add <code>compress:1;</code> to your configuration block.
</p>
<h4>Plugins</h4>
<p>
	To active a plugin, simply add it's name to the <code>plugins</code> property (the order doesn't matter):
</p>
<pre class="cssp">@turbine
    plugins:resetstyle, datauri, borderradius</pre>
<p>
	Turbine has a set of <a class="smoothscroll" href="#plugins">core plugins</a> that greatly enhance the functionality of Turbine. If
	you know a bit of PHP you can <a class="smoothscroll" href="#dev-plugins">easily build your own plugins</a>.
</p>
<h5>Plugin configuration</h5>
<p>
	Some plugins have configuration options. To use them, simply add the plugin's name as a property to the <code>@turbine</code> block
	and list the options you want to use as values. If for example the filters that simulate <code>box-shadow</code> in Internet Explorer
	are too ugly for your liking, you can pass a <code>noie</code> option to the <a href="#plugins-boxshadow" class="smoothscroll">box
	shadow plugin</a>:
</p>
<pre class="cssp">@turbine
    plugins:boxshadow
    boxshadow:noie    // Don't display box shadows in IE</pre>
</div>


<h3 id="usage-advanced">Advanced syntax features</h3><div>
<h4>Expanding properties</h4>
<p>
	if you want to use multiple properties with the same value inside a selector, you can take advantage of expanding properties. This
	allows you to use properties as a comma-separated list&nbsp;&hellip;
</p>
<pre class="cssp">#foo
    position:absolute
    top, left:4px</pre>
<p>
	which Turbine expands into multiple css rules:
</p>
<pre class="css">#foo {
    position: absolute;
    top: 4px;
    left: 4px;
}</pre>
</div>
<h4>Nested selectors</h4>
<p>
	Turbine implements nested css selectors using a simple principle: whenever the <em>next</em> line is indented, to current line
	is used as a selector and combined with it's parent selectors.
</p>
<pre class="cssp">#foo div > p
    color:red
    font-weight:bold
    a:link, a:visited
        text-decoration:underline
    a:hover, a:active
        text-decoration:none
    a:focus
        outline:1px dotted #CCC</pre>
<p>
	The nested code above compiles to the following css:
</p>
<pre class="css">#foo div > p {
    color: red;
    font-weight: bold;
}
#foo div > p a:link, #foo div > p a:visited {
    text-decoration: underline;
}
#foo div > p a:hover, #foo div > p a:active {
    text-decoration: none;
}
#foo div > p a:focus {
    outline: 1px dotted #CCC;
}</pre>
<p>
	Without nested selectors you would have to have typed a lot more <code>#foo div > p</code>. Nested selectors <em>can</em> become a
	bit confusing if you overuse them, but with a bit of moderation they can save quite a bit of typing. Consider this example:
</p>
<pre class="cssp">#header, #footer
    ul, ol, p
        a:link, a:visited
            text-decoration:underline
        a:active, a:hover
            text-decoration:none</pre>
<p>
	Result:
</p>
<pre class="css">#header ul a:link, #header ul a:visited,
#header ol a:link, #header ol a:visited,
#header p a:link, #header p a:visited,
#footer ul a:link, #footer ul a:visited,
#footer ol a:link, #footer ol a:visited,
#footer p a:link, #footer p a:visited {
	text-decoration: underline;
}
#header ul a:active, #header ul a:hover,
#header ol a:active, #header ol a:hover,
#header p a:active, #header p a:hover,
#footer ul a:active, #footer ul a:hover,
#footer ol a:active, #footer ol a:hover,
#footer p a:active, #footer p a:hover {
	text-decoration: none;
}</pre>
<h4>Multi-line selectors</h4>
<p>
	A selector can span multiple lines if each line except the last one ends with a comma:
</p>
<pre class="cssp">#header,
#footer,
#foobar
    color:red</pre>
<p>
	To avoid confusion it is recommended to use <a class="smoothscroll" href="usage-constantsaliases">aliases</a> for complex selectors
	instead.
</p>
<h4>CSS injection</h4>
<p>
	In case you need to insert css without Turbine messing with it, you can use the <code>@css</code> prefix. Any lines that begin with
	<code>@css</code> will appear in the output completely unchanged (except for the <code>@css</code> prefix which is removed).
</p>
<pre class="cssp">@css @-moz-document url-prefix(http://), url-prefix(https://), url-prefix(ftp://){

#foo
    color:red

@css }</pre>
<p>
	Result:
</p>
<pre class="css">@-moz-document url-prefix(http://), url-prefix(https://), url-prefix(ftp://){
#foo {
	color: red;
}
}</pre>
<p>
	If you have to use css hacks, this is the way to go.
</p>
</div>



<h3 id="usage-constantsaliases">Constants and aliases</h3><div>


<h4>Constants</h4>
<p>
	Constants (also known as "css variables") allow you to define your own easy-to-remember shortcuts for complicated hex colors
	or long font stacks. They can be used for any css property and are <strong>case-sensitive</strong>.
</p>
<pre class="cssp">@constants
    myRed:#C02222
    imagePath:/assets/images

#foo
    color:$myRed
    background:url($imagePath/foo.png) top left no-repeat</pre>
<pre class="css">#foo {
    color: #C02222;
    background: url(/assets/images/foo.png) top left no-repeat;
}</pre>
<h4>Special constants</h4>
<p>
	The constants defined in in an <code>@turbine</code> block only apply to the current .cssp file. There are two special constants
	that apply globally and that are always made availiable by Turbine:
</p>
<ol>
	<li><code>$_SCRIPTPATH</code>: The path to <code>css.php</code></li>
	<li><code>$_FILEPATH</code>: The path to the current .cssp file</li>
</ol>
<h4>Aliases</h4>
<p>
	Aliases are constants applied to selectors insted of values. Don't want to remember the complicated <code>#wrapper #header > div ul</code>?
	You don't have to:
</p>
<pre class="cssp">@aliases
    mainNavigation: #wrapper #header > div ul

$mainNavigation
    list-style:none</pre>
<p>
	The <code>@aliases</code> block defines <code>mainNavigation</code> as an alias of <code>#wrapper #header > div ul</code>, which
	results us to the following css code:
</p>
<pre class="css">#wrapper #header > div ul {
    list-style: none
}
</pre>
<p>
	Aliases, like constants, are <strong>case-sensitive</strong>.
</p>
<h4>Scope</h4>
<p>
	All <code>.cssp</code> are processed completly independent from each other. Inside the files, constants and aliases apply only to
	the <code>@media</code>-block they are defined in. The exception is the set of constents defined outside of any block&nbsp;&ndash;
	they apply to the whole file.
</p>
<p>
	<img src="img/scope.png">
</p>
<p>
	Example:
</p>
<pre class="cssp">@constants
    mycolor:#F00 // Defined outside of any @media block = applies _globally_

@media screen

@constants
    myothercolor:#00F // Defined in @media block = applies _only_ in the screen block

#foo
    color:$mycolor
    background:$myothercolor

@media print

#foo
    color:$mycolor
    background:$myothercolor // Won't work as "myothercolor" is only defined for the "screen" block, but not for "print"</pre>
<p>
	Result:
</p>
<pre class="css">@media screen {
    #foo {
        color: #F00;
        background: #00F;
    }
}

@media print {
    #foo {
        color: #F00;
        background: $myothercolor;
    }
}</pre>
</div>



<h3 id="usage-inheritancetemplating">Inheritance and Prototyping</h3><div>
<p>
	Turbine's inheritance, prototyping and copying features allow you to pass around chunks of properties and values between elements in
	your code. Note that <code>@font-face</code> and <code>@import</code> elements can copy and interit properties from other elements,
	but they cannot be copied or inherited from.
</p>
<h4>Copying values from other elements</h4>
<p>
	To simply copy a value from a property in another selector, you can use the <code>copy(selector property)</code> syntax:
</p>
<pre class="cssp">#foo
    color:#F00

#bar
    color:copy(#foo color)</pre>
<p>
	Result:
</p>
<pre class="css">#foo {
    color: #F00
}
#bar {
    color: #F00
}</pre>
<h4>Copying from other properties</h4>
<p>
	The copied and copying properties don't have to be the same:
</p>
<pre class="cssp">#foo
    background:#F00

#bar
    color:copy(#foo background)</pre>
<p>
	Result:
</p>
<pre class="css">#foo {
    color: #F00
}
#bar {
    background: #F00
}</pre>
<h4>Copying with aliases</h4>
<p>
	Copying works with aliases too. If you want to copy the <code>color</code> value from $foo to #bar, you can simple use
	<code>copy($foo color)</code>:
</p>
<pre class="cssp">@aliases
    foo: #header > div.foobar

$foo
    color:blue

#bar
    background:copy($foo color)</pre>
<p>
	Result:
</p>
<pre class="css">#header > div.foobar {
    color: blue;
}
#bar {
    background: blue;
}</pre>

<h4>Extending other elements</h4>
<p>
	Turbine's <code>extends</code> let elements inherit complete sets of properties from other elements, which are merged with the
	element's own properties:
</p>
<pre class="cssp">#parent
    color:red
    font-weight:bold

div.child
    extends:#parent
    margin:4px</pre>
<p>
	Result:
</p>
<pre class="css">#parent {
	color: red;
	font-weight: bold;
}
div.child {
	margin: 4px;
	color: red;
	font-weight: bold;
}</pre>
<p>
	If a property is already defined in a element <code>extends</code> will <strong>not</strong> overwrite it:
</p>
<pre class="cssp">#parent
    color:red
    font-weight:bold

div.child
    extends:#parent
    font-weight:normal</pre>
<p>
	Result:
</p>
<pre class="css">#parent {
	color: red;
	font-weight: bold;
}
div.child {
	font-weight: normal;
	color: red;
}</pre>
<p>
	For inheritance from multiple sources, the parent elements <strong>must</strong> be quoted because of the comma character (which
	otherwise might be part of a selector as well as a list sepperator):
</p>
<pre class="cssp">#parent1
    color:red

#parent2
    font-weight:bold

div.child
    extends:"#parent1", "#parent2"</pre>
<p>
	Result:
</p>
<pre class="css">#parent1 {
	color: red;
}
#parent2 {
	font-weight: bold;
}
div.child {
	color: red;
	font-weight: bold;
}
</pre>
<h3 id="usage-inheritancetemplating-prototyping">Prototyping</h3>
<h4>Using prototypes</h4>
<p>
	The <code>?</code> prefix allows you to define elements that will be removed before output but from which properties can be inherited
	or copied from (see <a class="smoothscroll" href="#usage-syntax-prefixes">prefixes</a>). These elements can be used to declare complete
	building blocks for your real css elements:
</p>
<pre class="cssp">// Prototypes

?box
    margin, padding:4px

?blackBox
    background:#000

?whiteBox
    background:#FFF

?roundedBox
    border-radius:8px

// "Real" elements

div.whiteSqare
    extends:"?box", "?whiteBox"

div.blackRound
    extends:"?box", "?blackBox", "?roundedBox"</pre>
<p>
	Result:
</p>
<pre class="css">div.whiteSqare {
	margin: 4px;
	padding: 4px;
	background: #FFF;
}
div.blackRound {
	margin: 4px;
	padding: 4px;
	background: #000;
	border-radius: 8px;
}</pre>


<h4 id="usage-inheritancetemplating-prototyping-recycling">Recycling prototypes</h4>
<p>
	The <a href="#plugins-load" class="smoothscroll">loader plugin</a> allows you (among other things) to build a library of prototypes,
	store them in an external file and include them when you need them. The code for the black and white boxes above could then be shortend
	to the following:
</p>
<pre class="cssp">@load url(myBoxTemplates.cssp)

div.whiteSqare
    extends:"?box", "?whiteBox"

div.blackRound
    extends:"?box", "?blackBox", "?roundedBox"</pre>
<p>
	An additional bonus of building external libraries is that you can re-use them in all of your coming projects.
</p>

</div>



</div>



<h2 id="plugins">Core plugins</h2><div>



<h3 id="plugins-fontface">Simple @font-face</h3><div>
<p class="abstract">
	Generates @font-face declarations from a simplified syntax.
</p>
<p>
	<a href="http://paulirish.com/2009/bulletproof-font-face-implementation-syntax/">Bulletproof @font-face syntax</a> is a syntax
	for embedding web fonts in a manner that works for all browsers and takes care of numerous browser quirks. Its only downside is that
	it's rather complicated:
</p>
<pre class="css">@font-face {
	font-family: 'Graublau Web';
	src: url('GraublauWeb.eot');
	src: local('Graublau Web Regular'), local('Graublau Web'),
		url("GraublauWeb.woff") format("woff"),
		url("GraublauWeb.otf") format("opentype"),
		url("GraublauWeb.svg#grablau") format("svg");
}</pre>
<p>
	The @font-face syntax plugin generates <strong>browser-specific @font-face declarations</strong> from a very simplified syntax.
</p>
<h4>Usage</h4>
<ol>
	<li>Add <code>fontface</code> to <code>@turbine</code> plugin list</li>
	<li>Put all different font-files into one directory and give them the same basename, e.g. "<code>SaginaMedium</code>":
		<ul>
			<li>SaginawMedium.eot</li>
			<li>SaginawMedium.woff</li>
			<li>SaginawMedium.otf</li>
			<li>SaginawMedium.ttf</li>
			<li>SaginawMedium.svg</li>
		</ul>
	</li>
	<li>Build a special <code>@font-face</code>-rule with a single <code>src</code>-property pointing not to a real
	file but to the common basename, e.g. "<code>src:url('fonts/SaginawMedium')</code>"</li>
	<li>The plugin will look after any known fontfile format by appending the suffixes
	<code>.eot, .woff, .otf, .ttf</code> and <code>.svg</code>.
	<ul>
		<li>For IE &lt;= 8 it will serve the .eot-file if there is one named <code>fonts/SaginawMedium.eot</code>.</li>
		<li>For the other browser it will serve as many of the other flavors as available.<br />
		A truetype-file will only be served when there is no opentype-file available.</li>
	</ul>
</ol>
<h4>Example</h4>
<pre class="cssp">@turbine
	plugins:fontface

@font-face
	font-family:'SaginawMedium'
	src:url('fonts/SaginawMedium')
	font-weight:bold
	font-style:italic</pre>
<p>
	Result for IE &lt;= 8:
</p>
<pre class="css">@font-face {
	font-family: 'SaginawMedium';
	src: url("fonts/SaginawMedium.eot");
	font-weight: bold;
	font-style: italic;
}</pre>
<p>
	Result for all other browsers:
</p>
<pre class="css">@font-face {
	font-family: 'SaginawMedium';
	src: url("fonts/SaginawMedium.woff") format("woff"),
	   url("fonts/SaginawMedium.ttf") format("truetype"),
	   url("fonts/SaginawMedium.svg#SaginawMedium") format("svg");
	font-weight: bold;
	font-style: italic;
}</pre>
</div>



<h3 id="plugins-backgroundgradient">Background gradient</h3><div>
<p class="abstract">
	Converts proprietary gradient code into vendor-specific gradient code.
</p>
<p>
	This plugin creates a cross-browser linear vertical or horizontal background gradient 
	(angles or radial gradient not supported). As this CSS3 property is still very alpha 
	we pick up W3C's current draft's syntax for a simple two-colored linear gradients.<br />
	For Mozilla, WebKit and Konquror we use their very differing vendor-specific gradient 
	implementation syntax, for Opera we assign a dynamically created SVG-file as background-image, 
	and for IE we make use of a gradient-filter.
</p>
<h4>Usage</h4>
<p>
	Add <code>backgroundgradient</code> to your <code>@turbine</code> plugins rule and start using 
	<code>linear-gradient</code> following W3C's current draft's syntax for a simple two-colored 
	linear gradient within a <code>background-image</code> or <code>background</code> property:
</p>
<pre>
    background: linear-gradient(&lt;direction&gt;,&lt;startcolor&gt;,&lt;endcolor&gt;);
</pre>
<h5>Possible values for the direction</h5>
<ul>
	<li><code>top</code>: Gradient starting at the top, going to the bottom</li>
	<li><code>left</code>: Gradient starting at the left, going to the right</li>
</ul>
<h5>Possible values for the colors</h5>
<ul>
	<li>HEX, e.g. <code>#FFF</code></li>
	<li>RGB, e.g. <code>rgb(255,255,255)</code></li>
	<li>RGBA, e.g. <code>rgba(255,255,255,0.3)</code></li>
</ul>
<h4>Examples</h4>
<h5>Vertical gradient, from top to bottom, from white to black</h5>
<pre class="cssp">@turbine
    plugins:backgroundgradient

#foo
    background-image: linear-gradient(top,#FFF,#000)</pre>
<p>
	Result for Mozilla:
</p>
<pre>#foo {
    background-image: -moz-linear-gradient(top,#FFF,#000);
}
</pre>
<p>
	Result for WebKit:
</p>
<pre>#foo {
    background-image: -webkit-gradient(linear,left top,left bottom,from(#FFF),to(#000));
}
</pre>
<p>
	Result for Konqueror:
</p>
<pre>#foo {
    background-image: -khtml-gradient(linear,left top,left bottom,from(#FFF),to(#000));
}
</pre>
<p>
	Result for Opera:
</p>
<pre>#foo {
    background-image: url(/turbine/plugins/backgroundgradient/svg.php?direction=top&startcolor=#fff&endcolor=#000) 0 0 repeat;
}
</pre>
<p>
	Result for IE 6 &amp; 7:
</p>
<pre>#foo {
    background-image: linear-gradient(top,#FFF,#000);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFFFFFF,endColorstr=#FF000000,gradientType=0);
}
</pre>
<p>
	Result for IE 8:
</p>
<pre>#foo {
    background-image: linear-gradient(top,#FFF,#000);
    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFFFFFF,endColorstr=#FF000000,gradientType=0)";
}
</pre>
</div>



<h3 id="plugins-borderradius">Border radius</h3><div>
<p class="abstract">
	Automatically adds vendor-specific versions of <code>border-radius</code> and implements some shortcuts.
</p>
<p>
	Webkit and Mozilla browsers require vendor-specific prefixes for the CSS3 property <code>border-radius</code>. This plugin
	automatically inserts all of them wherever a <code>border-radius</code> property is found. Additionally, the plugin provides
	shortcuts for adding rounded corners only on the left, right, top or bottom side of an element: <code>border-left-radius</code>,
	<code>border-right-radius</code>, <code>border-top-radius</code>, <code>border-bottom-radius</code>.
</p>
<h4>Usage</h4>
<p>
	Add <code>borderradius</code> to your <code>@turbine</code> plugins rule and start using <code>border-radius</code> like the
	standard <code>border-radius</code> CSS3 property.
</p>
<h4>Examples</h4>
<h5>Automatic vendor-specific versions</h5>
<pre class="cssp">@turbine
    plugins:borderradius

#foo
    border-radius:4px</pre>
<p>
	Result:
</p>
<pre>#foo {
    -moz-border-radius: 4px;
    -khtml-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
}
</pre>
<h5>Left side only shortcut</h5>
<pre class="cssp">#foo
    border-left-radius:4px;</pre>
<p>
	Result:
</p>
<pre class="css">#foo {
    -moz-border-radius-topleft: 4px;
    -moz-border-radius-bottomleft: 4px;
    -khtml-border-top-left-radius: 4px;
    -khtml-border-bottom-left-radius: 4px;
    -webkit-border-top-left-radius: 4px;
    -webkit-border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}</pre>
</div>



<h3 id="plugins-boxshadow">Box shadow</h3><div>
<p class="abstract">
	Automatically adds vendor-specific versions of <code>box-shadow</code>.
</p>
<p>
	Webkit and Mozilla browsers require vendor-specific prefixes for the CSS3 property <code>box-shadow</code>. This plugin automatically
	inserts them wherever a <code>box-shadow</code> property is found and also adds proprietary filters for Internet Explorer.
</p>
<h4>Usage</h4>
<p>
	Add <code>boxshadow</code> to your <code>@turbine</code> plugins rule and start using <code>box-shadow</code> like the
	standard <code>box-shadow</code> CSS3 property.
</p>
<h4>Options</h4>
<ul>
	<li><code>noie</code>: Don't display shadows in Internet Explorer</li>
</ul>
<h4>Example</h4>
<pre class="cssp">@turbine
    plugins:boxshadow

#foo
    box-shadow:2px 2px 8px #000</pre>
<p>
	Result:
</p>
<pre class="css">#foo {
    box-shadow: 2px 2px 8px #000;
    -moz-box-shadow: 2px 2px 8px #000;
    -webkit-box-shadow: 2px 2px 8px #000;
    -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Color='#000000',Direction=135,Strength=2)";
    filter: progid:DXImageTransform.Microsoft.Shadow(Color='#000000',Direction=135,Strength=2);
}
</pre>
</div>




<h3 id="plugins-boxsizing">Box sizing</h3><div>
<p class="abstract">
	Automatically adds vendor-specific versions of <code>box-sizing</code>.
</p>
<p>
	Webkit and Mozilla browsers require vendor-specific prefixes for the CSS3 property <code>box-sizing</code>. This plugin automatically
	inserts them wherever a <code>box-sizing</code> property is found and also adds a proprietary behavior for Internet Explorer.
</p>
<h4>Usage</h4>
<p>
	Add <code>boxshadow</code> to your <code>@turbine</code> plugins rule and start using <code>box-shadow</code> to declare which box model
	to use. The following values are available:
</p>
<ul>
	<li><code>content-box</code>: Standard W3C box model</li>
	<li><code>border-box</code>: The width and height properties of an element include the padding and border, but not the margin</li>
	<li><code>inherit</code>: Same as the parant element (default)</li>
</ul>
<h4>Example</h4>
<pre class="cssp">@turbine
    plugins:boxsizing

#foo
    box-sizing:border-box</pre>
<p>
	Result:
</p>
<pre class="css">#foo {
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	behavior: url(plugins/boxsizing/boxsizing.htc);
	box-sizing: border-box;
}</pre>
</div>




<h3 id="plugins-sniffer">Browser and platform sniffer</h3><div>
<p class="abstract">
	Includes or excludes css rules based on the viewer's browser, operating system or platform.
</p>
<p>
	The browser and platform sniffer allows you to use Turbine's build-in browser sniffer for your cssp files. It allows you to include or exclude css
	rules based on the viewer's browser, operating system or platform, precisely targeting browser, engine or os versions (windows only).
</p>
<p class="warning">
	<strong>Warning</strong>: Browser sniffing is <em>always</em> a complicated, messy and unreliable business. Don't use this plugin unless you
	think you <em>really</em> know what you're doing!
</p>
<h4>Usage</h4>
<p>
	Add add <code>sniffer</code> to your <code>@turbine</code> plugins rule and use the <code>browser</code>, <code>engine</code>, <code>os</code> and
	<code>device</code> properties.
</p>
<h5>Use cases</h5>
<ul>
	<li>Progressive enhancement</li>
	<li>Hide <code>@font-face</code> from Windows XP to circumvent XP's rendering problems with non-windows fonts</li>
	<li>Hide or display nagging <q>Update your browser!</q> messages to IE6 users</li>
</ul>
<h4>Examples</h4>
<h5><code>device</code> property</h5>
<p>
	The <code>device</code> property allows you to target mobile devices or desktop computers:
</p>
<pre class="cssp">// Show red text only for dektop computers
#foo
    device:desktop
    color:red

// Show green text only for mobile devices
#foo
    device:mobile
    color:green</pre>
<p>
	To exclude devices, use the <code>^</code> operator at the beginning of the value of a <code>device</code> property:
</p>
<pre class="cssp">// No red text for mobile devices
#foo
    device:^mobile
    color:red</pre>
<p>
	You can use the following values for the <code>device</code> property:
</p>
<ul>
	<li><code>desktop</code></li>
	<li><code>mobile</code></li>
</ul>
<h5><code>os</code> property</h5>
<p>
	The <code>os</code> property allows you to target operating systems:
</p>
<pre class="cssp">// Show red text only for windows
#foo
    os:windows
    color:red

// Show green text only for mac os
#foo
    os:mac
    color:green</pre>
<p>
	You can target the different versions of windows (and <em>only</em> windows) too:
</p>
<pre class="cssp">// Show red text only for windows versions equal or newer than vista
#foo
    os:windows&gt;=vista
    color:red

// Show green text only for windows xp
#foo
    os:windows=xp
    color:green</pre>
<p>
	To exclude operating systems, use the <code>^</code> operator as usual:
</p>
<pre class="cssp">// No red text for linux
#foo
    os:^linux
    color:red</pre>
<p>
	You can use the following values for the <code>os</code> property:
</p>
<ul>
	<li><code>windows</code></li>
	<li><code>mac</code></li>
	<li><code>linux</code></li>
	<li><code>unix</code> (Includes FreeBSD, OpenBSD etc)</li>
	<li>Some mobile phone vendors (BlackBerry, NetFront) <em>may</em> also work as a value for <code>os</code> but this is <em>really</em> unreliable.</li>
</ul>
<p>
	The following windows versions can be targeted:
</p>
<ul>
	<li><code>95</code></li>
	<li><code>nt4</code></li>
	<li><code>98</code></li>
	<li><code>me</code></li>
	<li><code>2000</code> or <code>2k</code></li>
	<li><code>xp</code></li>
	<li><code>2003</code> or <code>2k3</code></li>
	<li><code>vista</code></li>
	<li><code>windows7</code> or <code>win7</code> or <code>7</code></li>
</ul>
<h5><code>browser</code> property</h5>
<p>
	The browser property doesn't target individual browsers but rather browser families. For example Flock, Songbird, Minefield and Firefor are all members
	of the firefox family. To target one or multiple families, simply add their names to the <code>browser</code> property of an element:
</p>
<pre class="cssp">// Show red text only for firefox and opera
#foo
    browser:firefox opera
    color:red</pre>
<p>
	You can target browser versions too:
</p>
<pre class="cssp">// Show red text only for firefox versions newer than 3.5
#foo
    browser:firefox&gt;3.5
    color:red

// Show green text only for safari 4
#foo
    browser:safari=4
    color:green</pre>
<p>
	This also works for all browsers from the Firefox family with engine versions that are on par with firefox versions newer than 3.5. Version numbers must be
	floats (e.g. to target Firefox 3.6.4 you have to write <code>browser:firefox=3.64</code>).
</p>
<p>
	To exclude browsers, use the <code>^</code> operator as usual:
</p>
<pre class="cssp">// No red text for chrome
#foo
    browser:^chrome
    color:red</pre>
<p>
	The device <code>browser</code> property can, like all properties of this plugin, also be used inside the <code>@turbine</code> element. This will affect the
	stylesheet as a whole:
</p>
<pre class="cssp">// We don't want to bother with IE6, so we simply hide ALL STYLES from it.
// That makes the page somewhat useable without much work
@turbine
    browser:^ie&lt;7</pre>
<h5><code>engine</code> property</h5>
<p>
	Engine detection is a messy business because not all browsers anounce their engine and engine versions in the user agent string. To make the <code>engine</code>
	property work, <strong>in some cases it has to be passed the browser name an version number instead of the actual engine!</strong> 
</p>
<pre class="cssp">// Webkit browsers usually tell us their engine, so we can target them easily
#foo
    engine:webkit&lt;525
    color:red

// IE7 doesn't tell us that it uses an engine called Trident 3.1, so we have to use the browser name and version number as a fallback
#foo
    engine:ie=7
    color:green</pre>
<p>
	As with browser versions, engine version numbers must be floats too. To target WebKit 525.27.1 you have to write <code>engine:webkit=525.271</code>.
</p>
<p>
	To exclude engines, use the <code>^</code> operator as usual:
</p>
<pre class="cssp">// No red text for webkit
#foo
    engine:^webkit
    color:red</pre>
<p>
	You can use the following values for the <code>engine</code> property:
</p>
<ul>
	<li><code>gecko</code></li>
	<li><code>webkit</code></li>
	<li><code>khtml</code></li>
</ul>
<p>
	For all other engines (like Presto in Opera and Trident in IE) you have no choice but to target the Browser and its Version.
</p>
</div>



<h3 id="plugins-bugfix">Automatic browser bugfixes and enhancements</h3><div>
<p class="abstract">
	Tries to fix some common browser rendering and behavior bugs automatically.
</p>
<h4>Bugs fixed and enhancements by this plugin</h4>
<ul>
	<li>IE6: Image margin bottom bug</li>
	<li>IE6: Background image flickers on hover</li>
	<li>IE6: Float double margin bug</li>
	<li>IE6: Adding support for <code>min-height</code></li>
	<li>IE6: Adding support for transparent PNG files (<a href="http://www.twinhelix.com/css/iepngfix/">Source</a>)</li>
	<li>IE6: Adding support for <code>:hover</code> on all elements (<a href="http://www.xs4all.nl/~peterned/csshover.html">Source</a>)</li>
	<li>IE6 and 7: <code>&lt;button&gt;</code> styleability (<a href="http://www.sitepoint.com/forums/showthread.php?t=547059">Source</a>)</li>
	<li>Firefox: Ghost margin around buttons (<a href="http://www.sitepoint.com/forums/showthread.php?t=547059">Source</a>)</li>
</ul>
<p>
	Note: there is no guarantee that the plugin will catch all cases in which a bug from the above list will occour. The goal is
	to <em>reduce</em> the time spent on fixing css, not to do away with manual bugfixing completly.
</p>
<h4>Usage</h4>
<p>
	Just add <code>bugfixes</code> to your <code>@turbine</code> plugins rule. Done!
</p>
</div>



<h3 id="plugins-colormodels">Colormodels</h3><div>
<p class="abstract">
	Smart color models for older browsers
</p>
<p>
	The colormodels plugin enables the CSS color declarations <code>rgba()</code>, </code>hsl()</code> and <code>hsla()</code> for browsers
	that usually don't support them. It works by transforming the original declarations to somthing the browser that is currently used
	can understand.
</p>
<h4>Usage</h4>
<p>
	Just add <code>colormodels</code> to your <code>@turbine</code> plugins rule. Done!
</p>
<h4>Examples</h4>
<p>
	The following turbine code&nbsp;&hellip;
</p>
<pre class="cssp">p
    background:hsla(200, 20%, 20%, 0.5)</pre>
<p>
	&hellip; is recalculated to RGBA for Opera 9, which doesn't support <code>hsla()</code>:
</p>
<pre class="css">p {
    background: rgba(40, 54, 61, 0.5);
}</pre>
<p>
	For IE, the HSLA declaration is transformed into a proprietary filter:
</p>
<pre class="css">p {
    background: none;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#8028363D,endColorstr=#8028363D);
    zoom: 1;
}</pre>
<p>
	If neither filters nor anything else would work (e.g. in really prehistoric browsers or in IE for non-background properties), a solid
	color is used:
</p>
<pre class="css">p {
    background: rgb(40, 54, 61);
}</pre>
<h4>Troubleshooting</h4>
<p>
	Background transparency in IE works with Microsoft's proprietary <code>filter</code> property which may cause unwanted effects
	in some scenarios. Consider the following:
</p>
<pre class="cssp">p
    background:rgba(200, 0, 0, 0.5)

p.foo
    background:rgb(200, 0, 0)</pre>
<p>
	Turbine will insert <code>filter</code> property for <code>p</code>:
</p>
<pre class="css">p {
    background:none;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#80C80000,endColorstr=#80C80000);
}
p.foo {
    background: rgb(200, 0, 0);
}</pre>
<p>
	The problem is that in the browser <strong>the filter will also affect <code>p.foo</code></strong> because the <code>p</code>
	selector of course also matches <code>p.foo</code>. The solution is to explicitly remove any filters from <code>p.foobar</code>:
</p>
<pre class="cssp">p
    background:rgba(200, 0, 0, 0.5)

p.foobar
    background:rgb(200, 0, 0)
    filter:none</pre>
</div>



<h3 id="plugins-datauri">Data URIs</h3><div>
<p class="abstract">
	Inlines images into the css output.
</p>
<p>
	The Data URI plugin inlines all images smaller than 24kb as base64 encoded as a data URI or, for Internet Explorer, as MHTML. This
	significantly reduces the number of HTTP requests.
</p>
<h4>Usage</h4>
<p>
	Just add <code>datauri</code> to your <code>@turbine</code> plugins rule. Done!
</p>
<h4>Example</h4>
<pre class="cssp">@turbine
    plugins:datauri

#foo
    background:#FFF url(test.png) top left</pre>
<p>
	Result:
</p>
<pre>#foo {
    background: #FFF url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAGCAMAAADXEh96AAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAAGUExURf///8zjYPWWfS0AAAARSURBVHjaYmAAAUYiSIAAAwAAqAAH4ng45wAAAABJRU5ErkJggg==') top left;
}</pre>
</div>



<h3 id="plugins-html5">HTML5</h3><div>
<p class="abstract">
	Adds the correct default styles for HTML5 elements
</p>
<p>
	The HTML5 plugin adds most of the correct default styles for HTML5 elements according to <a href="http://www.whatwg.org/specs/web-apps/current-work/multipage/rendering.html#the-css-user-agent-style-sheet-and-presentational-hints">the specifications</a>.
	Some parts of the specifications (like the font size for headlines in sectioning content) are ignored because they would require an
	insane amount of css code to implement correctly. Note that for this plugin to work in Internet Explorer you still have to
	<a href="http://code.google.com/p/html5shiv/">enable HTML5 elements via javascript</a>.
</p>
<h4>Usage</h4>
<p>
	Just add <code>html5</code> to your <code>@turbine</code> plugins rule. Done!
</p>
</div>



<h3 id="plugins-inlineblock">Legacy inline block support</h3><div>
<p class="abstract">
	Enables <code>display:inline-block</code> in older Browsers
</p>
<p>
	This plugin enables <code>display:inline-block</code> in older IE and Gecko Browsers by automatically setting <code>display</code> to
	<code>-moz-inline-stack</code> rule for Gecko or setting <code>display</code> to <code>inline</code> and adding <code>zoom:1</code> for IE &lt; 8.
</p>
<h4>Usage</h4>
<p>
	Just add <code>inlineblock</code> to your <code>@turbine</code> plugins rule. Done!
</p>
<h4>Example</h4>
<pre class="cssp">@turbine
    plugins:inlineblock

#foo
    display:inline-block</pre>
<p>
	Result in browsers using Gecko &lt; 1.9:
</p>
<pre>#foo {
	display: -moz-inline-stack;
}</pre>
<p>
	Result in IE &lt; 8:
</p>
<pre>#foo {
	display: inline;
	zoom: 1;
}</pre>
</div>




<h3 id="plugins-load">Load</h3><div>
<p class="abstract">
	Loads another .cssp file.
</p>
<p>
	Loader loads the contents of another .cssp file at the exact location where <code>@load</code> ist placed. It inserts the
	code of the loaded file before parsing anything, so the contents of the file is subject to all of Turbines operations in
	the file it is inserted into.
</p>
<p>
	The plugin will automatically take care of any differences in indentation style between the loaded code and the code it is
	loaded into.
</p>
<h4>Usage</h4>
<p>
	Add <code>load</code> to your <code>@turbine</code> plugins rule and add a <code>@load url(path/to/file.cssp)</code> line
	where you want a file to be included. Done!
</p>
<h5>Use cases</h5>
<ul>
	<li>Building protype libraries (see <a href="#usage-inheritancetemplating-prototyping-recycling">Recycling prototypes</a>)</li>
	<li>Share the same set of constants between multiple files (eg. a mobile, print and screen stylesheet)</li>
</ul>
<h4>Example</h4>
<p>
	This is an example of using the loader plugin to create a module to create a module that contains all the colors used in a project.
</p>
<p>
	File <code>style.cssp</code>:
</p>
<pre class="cssp">@load url(/modules/colors.cssp)

#foo
    color:$textcolor
    background:$bgcolor</pre>
<p>
	File <code>/modules/colors.cssp</code>:
</p>
<pre class="cssp">@constants
    textcolor:#C00000
    bgcolor:#EEE</pre>
<p>
	Result:
</p>
<pre>#foo {
	color: #C00000;
	background: #EEE;
}</pre>
</div>



<h3 id="plugins-minifier">Minifier</h3><div>
<p class="abstract">
	Performs a number of micro-optimizations.
</p>
<p>
	The minifier plugins shortens hex color declarations, replaces hex colors with shorter named colors when possible, removes units from zero values, removes
	leading zeros from floats, shortens long margin and padding notation (<code>8px 4px 8x 4px</code> is turned into <code>8px 4px</code>) and removes whitespace
	from comma-sepparated strings, saving a bit of space and loading time.
</p>
<h4>Usage</h4>
<p>
	Just add <code>minifier</code> to your <code>@turbine</code> plugins rule. Done!
</p>
<h3>Example</h3>
<pre class="cssp">#foo
    font-family: Georgia, "Times New Roman", serif
    color: #FF0000
    background: #F0FFFF
    margin: 0.5em 0em
    padding: 8px 4px 8px 4px</pre>
<p>
	Result (pretty-printed):
</p>
<pre>#foo {
	font-family: Georgia,"Times New Roman",serif;
	color: #F00;
	background: azure
	margin: .5em 0;
	padding: 8px 4px;
}</pre>
<p>
	Compressed result:
</p>
<pre>#foo{font-family:Georgia,"Times New Roman",serif;color:#F00;background:azure;margin:.5em 0;padding:8px 4px}</pre>
</div>



<h3 id="plugins-opacity">Opacity</h3><div>
<p class="abstract">
	Automatically adds vendor-specific versions of <code>opacity</code>.
</p>
<p>
	This plugin automatically inserts all existing vendor prefixed opacity-properties, as well as the corresponding alpha-filter for IE.
</p>
<h4>Usage</h4>
<p>
	Add <code>opacity</code> to your <code>@turbine</code> plugins rule and start using <code>opacity</code> like the
	standard <code>opacity</code> CSS3 property.
</p>
<h4>Examples</h4>
<h5>Automatic vendor-specific versions</h5>
<pre class="cssp">@turbine
    plugins:opacity

#foo
    opacity:0.3</pre>
<p>
	Result:
</p>
<pre>#foo {
    -moz-opacity: 0.3;
    -khtml-opacity: 0.3;
    -webkit-opacity: 0.3;
    opacity: 0.3;
}
</pre>
<p>
	plus, for IE 8:
</p>
<pre>
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(opacity=30)";
</pre>
<p>
	or for IE 6 &amp; 7:
</p>
<pre>
	filter: progid:DXImageTransform.Microsoft.Alpha(opacity=30);
</pre>
</div>



<h3 id="plugins-quote">Quotes</h3><div>
<p class="abstract">
	Inserts language- and country-specific quotation marks.
</p>
<p>
	Different languages and countries use different quotation marks. The quote style plugin allows you to set
	the contents for the <code>quotes</code> property by language and/or country.
</p>
<h4>Usage</h4>
<p>
	Include <code>quotes</code> in your <code>@turbine</code> plugins rule and start using the <code>quotes</code> property with
	the values listed below.
</p>
<h4>Possible <code>quotes</code> values</h4>
<table>
	<thead>
		<tr>
			<th>Value</th>
			<th>Result</th>
			<th>Glyphs</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><code>german</code></td>
			<td><code>#foo { quotes:'\201E \201C \201A \2018'; }</code></td>
			<td>„ “ ‚ ‘</td>
		</tr>
		<tr>
			<td><code>german-alt</code></td>
			<td><code>#foo { quotes:'\00BB \00AB \203A \2039'; }</code></td>
			<td>» « › ‹</td>
		</tr>
		<tr>
			<td><code>swiss</code></td>
			<td><code>#foo { quotes:'\00AB \00BB \2039 \203A'; }</code></td>
			<td>« » ‹ ›</td>
		</tr>
		<tr>
			<td><code>english-uk</code></td>
			<td><code>#foo { quotes:'\2018 \2019 \201C \201D'; }</code></td>
			<td>‘ ’ “ ”</td>
		</tr>
		<tr>
			<td><code>english-us</code></td>
			<td><code>#foo { quotes:'\201C \201D \2018 \2019'; }</code></td>
			<td>“ ” ‘ ’</td>
		</tr>
	</tbody>
</table>
</div>



<h3 id="plugins-reset">Reset stylesheet</h3><div>
<p class="abstract">
	Includes a reset stylesheet.
</p>
<p>
	Auto-includes a handy set of css rules that unset the default styling for all elements.
</p>
<h4>Usage</h4>
<p>
	Just add <code>resetstyle</code> to your <code>@turbine</code> plugins rule. Done!
</p>
<h4>Options</h4>
<ul>
	<li><code>force-scrollbar</code>: Always display a vertical scrollbar to prevent a horizontally jumping page when navigating</li>
</ul>
<h4>Custom reset stylesheets</h4>
<p>
	To use a custom reset stylesheet, rename <code>_custom.css</code> in the directory <code>plugins/resetstyle</code> to
	<code>custom.css</code> and add your own reset rules there.
</p>
<h4>Default reset stylesheet</h4>
<pre class="css">html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
    color: inherit;
    margin: 0;
    padding: 0;
    border: 0;
    outline: 0;
    font-size: 100%;
    vertical-align: baseline;
    background: transparent;
    font-weight: normal;
    text-decoration: none;
}
body {
    line-height: 1;
}
ol, ul {
    list-style: none;
}
blockquote, q {
    quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
    content: '';
    content: none;
}
:focus {
    outline: 0;
}
ins {
    text-decoration: none;
}
del {
    text-decoration: line-through;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}</pre>
</div>



<h3 id="plugins-transforms">Transforms</h3><div>
<p class="abstract">
	Automatically adds vendor-specific versions of <code>transform</code>.
</p>
<p>
	Webkit, Opera and Mozilla browsers require vendor-specific prefixes for the CSS3 property <code>transform</code>. This plugin automatically
	inserts them wherever a <code>transform</code> property is found and also adds a proprietary filter in conjunction with a behavior for Internet Explorer.
</p>
<p>
	For it to work in Internet Explorer the transformed object needs to have <code>width</code> and <code>height</code> set. Also, if you queue up transforms, 
	limit yourself to a maximum of one of each sort (translate, rotate, scale), e.g. <code>transform: rotate(25deg) translate(100px,0) scale(0.5)</code>.
</p>
<h4>Usage</h4>
<p>
	Add <code>transform</code> to your <code>@turbine</code> plugins rule and start using <code>transform</code> to declare a single one, or a sequence of
	transforms. The following values are available:
</p>
<h5><code>rotate(angle)</code></h5>
<p>
	Rotates the element clockwise around its center by the specified angle, e.g. <code>rotate(30deg)</code>. Accepted values: positive and negative integers and floats. Accepted units: <code>deg</code>, <code>rad</code> or <code>grad</code>.
</p>
<h5><code>scale(sx[, sy])</code></h5>
<p>
	Specifies a 2D scaling operation on X and Y axes as described by <code>[sx, sy]</code>, e.g. <code>scale(2.1,4)</code>. If <code>sy</code> isn't specified, it is assumed to be equal to <code>sx</code>, e.g. <code>scale(2.1)</code>. Accepted values: positive integers and floats. Accepted units: no unit needed.</li>
</p>
<h5><code>scaleX(sx)</code></h5>
<p>
	Specifies a 2D scaling solely on the X axis, e.g. <code>scaleX(2.7)</code>. Accepted values: positive integers and floats. Accepted units: no unit needed.</li>
</p>
<h5><code>scaleY(sy)</code></h5>
<p>
	Specifies a 2D scaling solely on the Y axis, e.g. <code>scaleY(0.3)</code>. Accepted values: positive integers and floats. Accepted units: no unit needed.</li>
</p>
<h5><code>translate(tx[, ty])</code></h5>
<p>
	Specifies a 2D translation as described by <code>[tx, ty]</code>, e.g. <code>translate(100px,20px)</code>. Accepted values: positive and negative integers and floats. Accepted units: <code>px</code>, <code>em</code>, <code>%</code>, <code>pt</code> or <code>ex</code>.</li>
</p>
<h5><code>translateX(tx)</code></h5>
<p>
	Translates the element by the given amount along the X axis, e.g. <code>translate(100px)</code>. Accepted values: positive and negative integers and floats. Accepted units: <code>px</code>, <code>em</code>, <code>%</code>, <code>pt</code> or <code>ex</code>.</li>
</p>
<h5><code>translateY(ty)</code></h5>
<p>
	Translates the element by the given amount along the Y axis, e.g. <code>translate(20px)</code>. Accepted values: positive and negative integers and floats. Accepted units: <code>px</code>, <code>em</code>, <code>%</code>, <code>pt</code> or <code>ex</code>.</li>
</p>
<h5><code>skew(ax[, ay])</code></h5>
<p>
	Skews the element around the X and Y axes by the specified angles, e.g. <code>skew(30deg,-10deg)</code>. If <code>ay</code> isn't provided, no skew is performed on the Y axis., e.g. <code>skew(30deg)</code>. Accepted values: positive and negative integers and floats. Accepted units: <code>deg</code>, <code>rad</code> or <code>grad</code>.</li>
</p>
<h5><code>skewX(angle)</code></h5>
<p>
	Skews the element around the X axis by the given angle., e.g. <code>skewX(30deg)</code>. Accepted values: positive and negative integers and floats. Accepted units: <code>deg</code>, <code>rad</code> or <code>grad</code>.</li>
</p>
<h5><code>skewY(angle)</code></h5>
<p>
	Skews the element around the Y axis by the given angle., e.g. <code>skewY(-10deg)</code>. Accepted values: positive and negative integers and floats. Accepted units: <code>deg</code>, <code>rad</code> or <code>grad</code>.
</p>
<h5><code>matrix(a, c, b, d, tx, ty)</code></h5>
<p>
	Specifies a 2D transformation matrix comprised of the specified six values
</p>
<h5>Multiple transforms</h5>
<p>
	Multiple transforms may be queued together, separated by a whitespace, e.g. <code>transform: rotate(25deg) translate(100px,0) scale(0.5)</code>. Note that the parts will get processed one by one from left to right. So in the mentioned example the translation won't happen along the X axis but on a virtual axis that is rotated 25 degrees clockwise.
</p>
<h4>Example</h4>
<pre class="cssp">@turbine
    plugins:transform

#foo
    width: 200px;
    height: 100px;
    transform: rotate(25deg) translate(100px,0) scale(0.5)</pre>
<p>
	Result for non-IE-browsers:
</p>
<pre class="css">#foo {
	width: 200px;
	height: 100px;
	-moz-transform: rotate(25deg) translate(100px,0) scale(0.5);
	-o-transform: rotate(25deg) translate(100px,0) scale(0.5);
	-webkit-transform: rotate(25deg) translate(100px,0) scale(0.5);
	transform: rotate(25deg) translate(100px,0) scale(0.5);
}</pre>
<p>
	Result for IE8-browsers:
</p>
<pre class="css">#foo {
	width: 200px;
	height: 100px;
	position: relative;
	transform: rotate(25deg) translate(100px,0) scale(0.5);
	left: 91px;
	top: 38px;
	behavior: url(/Turbine/plugins/transform/transform.htc);
	-ms-filter: "progid:DXImageTransform.Microsoft.Matrix(Dx=1.0,Dy=1.0,M11=0.453153895,M12=-0.21130913,M21=0.21130913,M22=0.453153895,sizingMethod='auto expand')";
	zoom: 1;
}</pre>
<p>
	Result for IE6/7-browsers:
</p>
<pre class="css">#foo {
	width: 200px;
	height: 100px;
	position: relative;
	transform: rotate(25deg) translate(100px,0) scale(0.5);
	left: 91px;
	top: 38px;
	behavior: url(/Turbine/plugins/transform/transform.htc);
	filter: progid:DXImageTransform.Microsoft.Matrix(Dx=1.0,Dy=1.0,M11=0.453153895,M12=-0.21130913,M21=0.21130913,M22=0.453153895,sizingMethod='auto expand');
	zoom: 1;
}</pre>
</div>



<h3 id="plugins-meta">Meta plugins</h3><div>
<p class="abstract">
	Meta plugins enable a group of other plugins.
</p>
<p>
	Meta plugins enable a group of related plugins. If, for expample, you wanted to use lots of CSS3 properties, you don't have to
	write <code>plugins:boxshadow, borderradius, transform, transistion</code> and simply use <code>plugins:css3</code>, which will
	enable all plugins from the previous list. There are four core meta plugins available: CSS3, Performance, Legacy and Utility.
</p>
<h4>CSS3</h4>
<p>
	Activates all other plugins that enable advanced CSS properties:
</p>
<ul>
	<li>Background gradient</li>
	<li>Box sizing</li>
	<li>Border radius</li>
	<li>Box shadow</li>
	<li>Colormodels</li>
	<li>Opacity</li>
	<li>Transform</li>
</ul>
<h4>Performance</h4>
<p>
	Activates all other plugins that improve performance:
</p>
<ul>
	<li>DataURI</li>
	<li>Minifier</li>
</ul>
<h4>Legacy</h4>
<p>
	Activates all other plugins that help you to support older browsers:
</p>
<ul>
	<li>Bugfixes</li>
	<li>Inline block</li>
</ul>
<h4>Utility</h4>
<p>
	Activates all other plugins that add helpful utilities:
</p>
<ul>
	<li>Simple @font-face</li>
	<li>Quote style</li>
</ul>
</div>



<!--<h3 id="plugins-experimental">Experimental plugins</h3><div>
<p>
	Some experimental plugins are not yet officially part of Turbine but you can play with them (or improve them) if you like. They
	are available via the <a href="http://github.com/SirPepe/Turbine/tree/experimental">experimental development branch</a> on Github.
</p>
<ul>
	<li><strong>borderradius</strong>: <code>border-radius</code> with support for IE</li>
	<li><strong>multicolumn</strong>: CSS3 multi column layouts</li>
	<li><strong>backgroundsize</strong>: CSS3 background sizing</li>
	<li><strong>colortools</strong>: Functions to manipulate color in cssp files</li>
	<li><strong>transition</strong>: CSS3 transitions</li>
</ul>
</div>-->



</div>



<h2 id="dev">Development</h2><div id="development">



<h3 id="dev-contribute">Contribute</h3><div>
<p>
	Turbine is free open source software (LGPL) and development takes place on <a href="http://github.com/">GitHub</a>,
	a hosting platform for the excellent distributed version control system <a href="http://git-scm.com/">Git</a>. 
	Github membership is free and makes helping your favourite open source project really easy. See the following
	video for details.
</p>
<div class="embed">
	<embed width="576" height="324" allowFullScreen="true" src="http://d.yimg.com/m/up/ypp/default/player.swf" type="application/x-shockwave-flash" flashvars="vid=15004396&"></embed>
	<br />
</div>
<p>
	<a href="http://developer.yahoo.com/yui/theater/video.php?v=prestonwerner-github">Tom Preston-Werner, Chris Wanstrath and Scott Chacon — Git, GitHub and Social Coding</a>
</p>
<p>
	Everybody is welcome to <a href="http://github.com/SirPepe/Turbine">fork Turbine</a> and start contributing!
</p>
</div>



<h3 id="dev-plugins">Plugin development</h3><div>
<p>
	Plugin development for Turbine is rather simple. All you need is a file called <code>plugin_name.php</code> containing
	a function of some sort (usually named <code>plugin_name()</code>), located in the plugins directory. The function must
	accept only one argument, which is passed <strong>as a reference</strong> (see <a href="http://php.net/manual/en/language.references.pass.php">the PHP manual on references</a>).
	The contents of this argument depends on the hook the plugin is assigned to:
</p>
<table>
	<thead>
		<tr>
			<th>Hook</th>
			<th>Time of execution</th>
			<th>Argument</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><code>before_parse</code></td>
			<td>Before the .cssp files are parsed</td>
			<td>Reference to an array containing the lines of the original .cssp files</td>
		</tr>
		<tr>
			<td><code>before_compile</code></td>
			<td>After compilation, before applying Turbine core features (inheritance and the like)</td>
			<td>Reference to an array containing the parsed Turbine code</td>
		</tr>
		<tr>
			<td><code>before_glue</code></td>
			<td>After compilation and cssp magic, just before the output ist generated</td>
			<td>Reference to an array containing the parsed Turbine code</td>
		</tr>
		<tr>
			<td><code>before_output</code></td>
			<td>After generating the output of one .cssp file, before combining the output with other files</td>
			<td>Reference to a string containing the final css output from the current .cssp file</td>
		</tr>
	</tbody>
</table>
<h4>Hooks</h4>
<p>
	To hook into Turbine you need to call the <code>register_plugin()</code> function using three arguments: the hook, an
	execution priority and your plugin function's name:
</p>
<pre class="php">&lt;?php
    register_plugin('before_compile', 0, 'mypluginfunction');
?&gt;</pre>
<p>
	It is recommended to leave the execution priority at 0 unless early oder late execution of the plugin is <strong>really</strong>
	important. A higher priority means earlier execution.
</p>
<h4>Array structure</h4>
<p>
	When using <code>before_compile</code> or <code>before_glue</code> the array recieved as the argument for the plugin
	function will look like this:
</p>
<pre>Array
(
    [@media foo] => Array
    (
        [#bar] => Array
        (
            [property1] => Array
            (
                [0] => value
            )
            [property2] => Array
            (
                [0] => value
            )
        )
    )
    [@media bar] => Array
    (
        [#bar] => Array
        (
            [property1] => Array
            (
                [0] => value
            )
            [property2] => Array
            (
                [0] => value1
                [1] => value2
                [2] => value3
            )
        )
    )
)</pre>
<p>
	CSS rules that are not part of any <code>@media</code> block a stored in the <code>global</code> block. A property may contain more
	than one value. Properties that start with an underscore are considered hidden/special properties. They will usually not apprar in
	the final css output like normal properties.
</p>
<h5>Exceptions</h5>
<ul>
	<li>
		All <code>@font-face</code> and <code>@import</code> statements are stored in sepperate arrays in the <code>global</code> block.
	</li>
	<li>
		All <code>@cssp</code> statements appear in their respective blocks as <code>@css-X</code> elements with <code>X</code> being a
		consecutive number. All <code>@css-X</code> elements have only one property, <code>_value</code>, which contains the raw CSS code
		from the<code>@cssp</code> statement.
	</li>
</ul>
<h4>Example array</h4>
<p>
	Given the following Turbine input code&nbsp;&hellip;
</p>
<pre class="cssp">@import url(foobar.css);

span.test
    color:blue

span.test
    color:green

@font-face
    font-family:"Example"
    src:url("example.otf")

@media screen

#foo
    div.bar
        margin, padding:4px</pre>
<p>
	&hellip; the array that plugin functions recieve on <code>before_compile</code> will be the following:
</p>
<pre>Array
(
    [global] => Array
    (
        [@import] => Array
        (
            [0] => Array
            (
                [0] => url(foobar.css);
            )
        )
        [@font-face] => Array
        (
            [0] => Array
            (
                [font-family] => Array
                (
                    [0] => "Example"
                )
                [src] => Array
                (
                    [0] => url("example.otf")
                )
            )
        )
        [span.test] => Array
        (
            [color] => Array
            (
                [0] => blue
                [1] => green
            )
        )
    )
    [@media screen] => Array
    (
        [#foo div.bar] => Array
        (
            [margin, padding] => Array
            (
                [0] => 4px
            )
        )
    )
)</pre>
<p>
	The array that plugin functions recieve on <code>before_glue</code> will most likely be slightly different because Turbine and some
	plugins will by then have already done their work. The <code>margin, padding</code> property would for example already be expanded to
	two sepperate properties:
</p>
<pre>[@media screen] => Array
(
    [#foo div.bar] => Array
    (
        [margin] => Array
        (
            [0] => 4px
        )
        [padding] => Array
        (
            [0] => 4px
        )
    )
)</pre>
<h4>Plugin example</h4>
<p>
	In case you wanted your plugin to remove all occurences of <code>background-image</code> from your stylesheets,
	this would be the code:
</p>
<pre class="php">&lt;?php
    /**
     * remove_background_image.php
     * Remove all occurences of background-image
     */
    function remove_background_image(&$parsed){
        // Loop through the @media blocks
        foreach($parsed as $block => $css){
            // Loop through the selectors
            foreach($parsed[$block] as $selector => $styles){
                // Look for background-image in the styles
                if(isset($parsed[$block][$selector]['background-image'])){
                    // Be gone!
                    unset($parsed[$block][$selector]['background-image']);
                }
            }
        }
        // No need to return anything
    }

    // Hook into Turbine
    $cssp->register_plugin('before_compile', 0, 'remove_background_image');
?&gt;</pre>
<p>
	Don't be afraid to do anything CPU- or memory consuming in your plugins - in production mode, everything is calculated
	only once and is served from the cache afterwards.
</p>
<h4>Useful classes and methods for plugin development</h4>

<h5><code>$cssp->report_error(string $message)</code></h5>
<p>
	Reports a big ugly error message when in debug mode.
</p>
<pre>$cssp->report_error('Something went wrong!');</pre>
<p>
	<img src="img/error.png">
</p>
<h5><code>static CSSP::comment(array $element, string $property, string $comment)</code></h5>
<p>
	Adds a css comment to an element when not compressing. If <code>$property</code> is <code>null</code>, the comment is added to the selector, otherwise to
	the property <code>$property</code>.
</p>
<pre>CSSP::comment($parsed['global']['#foo'], 'color', 'Changed by my plugin!');</pre>
<p>
	Result:
</p>
<pre>#foo {
    color: red; /* Changed by my plugin! */
}</pre>
<h5><code>$cssp->get_final_value(array $values [, string $property [, bool $compressed]])</code></h5>
<p>
	From an array of css values this method returns the value with the highest rank, i.e. the last value or the last value with <code>!important</code>.
</p>
<pre>// Returns "green"
$cssp->get_final_value(array(
    'red',
    'blue',
    'green'
));

// Returns "blue !important"
$cssp->get_final_value(array(
    'red',
    'blue !important',
    'green'
));</pre>
<p>
	The property parameter can be used to handle special cases like <code>-ms-filter</code> where values must be combined:
</p>
<pre>// Returns "foo bar"
$cssp->get_final_value(array(
    'foo',
    'bar'
), '-ms-filter');</pre>
<p>
	If <code>$compressed</code> is true, the method will return a minified output.
</p>
<h5><code>$cssp->insert(array $elements, string $block [, string $before[, string $after]])</code></h5>
<p>
	Inserts <code>$elements</code> in the block <code>$block</code> before the element with the selector <code>$before</code> or after the element with the
	selector <code>$after</code>.
</p>
<pre>$example_element = array(
	'#foo' = array(
		'color' => array('red')
	)
);

// Insert before "#bar" in the global block
$cssp->insert($example_elements, 'global', 'bar');

// Insert after "#bar" in the "@media print" block
$cssp->insert($example_elements, '@media print', null, 'bar');</pre>
<p>
	This only works directly with <code>$cssp->parsed</code> and not with the reference passed to the plugin function!
</p>


<h5>The <code>$browser</code> instance</h5>
<p>
	Turbine's browser sniffer is developed as <a href="http://github.com/SirPepe/Turbine-Browser">a subproject</a>. By the time any plugin in Turbine gets
	executed, the browser sniffer will already have parsed the visitor's user agent string. The following variables might be useful:
</p>
<table>
	<thead>
		<tr>
			<th>Variable</th>
			<th>Contains</th>
			<th>Possible values</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th><code>$browser->browser</code></th>
			<td>Browser name (Lowercase string)</td>
			<td>A browser name (e.g. "safari") or the name of the larger family the browser belogs to. For example Flock and Songbird would be detected as "firefox"</td>
		</tr>
		<tr>
			<th><code>$browser->browser_version</code></th>
			<td>Browser version (Float)</td>
			<td>The browser's version number as a float value. Firefox 3.6.4 would be detected as "3.64".</td>
		</tr>
		<tr>
			<th><code>$browser->engine</code></th>
			<td>Browser engine (lowercase string)</td>
			<td>Contains the browser's engine if this information is available from the user agent string (usually the case in Webkit and Gecko browsers) or otherwise the browser's family name (Opera, IE)</td>
		</tr>
		<tr>
			<th><code>$browser->engine_version</code></th>
			<td>Browser engine version (Float)</td>
			<td>The browser's engine version number as a float value. Gecko 1.9.2.3 would be detected as "1.923".</td>
		</tr>
		<tr>
			<th><code>$browser->platform</code></th>
			<td>OS name (lowercase string)</td>
			<td>Contains the user's operating system name (e.g. "Windows", "Mac", "Linux" or "Unix")</td>
		</tr>
		<tr>
			<th><code>$browser->platform_version</code></th>
			<td>OS version (Float)</td>
			<td>Contains the user's operating system version if this information is available from the user agent string (eg. "5.1" for Windows XP or "10.5" for OS X Leopard)</td>
		</tr>
		<tr>
			<th><code>$browser->platform_type</code></th>
			<td>Platform type (Lowercase string)</td>
			<td>Either "Desktop" or "Mobile"</td>
		</tr>
	</tbody>
</table>
<p>
	When the browser sniffer failes to detect one of the above properties, the lowercase string "unknown" is used.
</p>
</div>



<h3 id="dev-styleguide">Style guide</h3><div>
<h4>Requirements</h4>
<ol>
	<li><strong>Comment your Code!</strong> Seriously. Do it!</li>
	<li><a href="http://manual.phpdoc.org/">PHPDoc</a> is required for all functions and class methods/variables. Describe what your code does, provide
	a usage example, tells us if it is stable or alpha/beta, which version it is, which parameters it takes and what it returns.</li>
	<li><strong>Indentation</strong> is tabs only. See code example for brace positioning.</li>
	<li>No omitting of <strong>braces around blocks</strong>. The ternary operator is allowed for simple cases only.</li>
	<li>Most important: <strong>Use Common Sense!</strong> Don't write spaghetti code. Don't let lines run too long. Break up complex stuff into subroutines </li>
	<li><strong>Class names:</strong> CamelCase, initial majuscule</li>
	<li><strong>Method, function, variable and plugin names:</strong> Lowercase, initial minuscule</li>
</ol>


<h4>Example code</h4>
<pre>&lt?php

/**
 * example
 * A great example. Does something cool.
 * @param array $param1 The first param
 * @param int $param2 The second param
 * @return bool
*/
function example($param1, $param2){
    global $g1, $g2;
    $length = count($param1);
    for(i = 0; i < $length; $i++){
        // A helpful comment explaining why the sub function is called
        example_subfunction($param1[$i]);
    }
    return false;
}

/**
 * example_subfunction
 * A secondary example. Related to example somehow
 * @param string $param Some explanation
 * @return void
*/
function example_subfunction($param){
    if($param == 1){
        foo();
    }
    else{
        bar();
    }
}

?&gt;</pre>
</div>



</div>



<h2 id="tools">Tools</h2><div>


<h3 id="tools-converter">CSS to Turbine converter</h3><div>
<p>
	<a href="http://turbine.peterkroener.de/converter.php">The CSS to Turbine Converter</a> transforms normal CSS code into ready-to-use Turbine code.
	<strong>Note that the converter is a rather simple script and only changes the syntax of the input code!</strong> It doesn't use any of the more
	sophisticated Turbine features. It can help you migrate a project to Turbine but should not be used for more as a starting point.
</p>
<h4>Usage</h4>
<p>
	Paste code, change indentation settings, click "Convert!". Done!
</p>
</div>



<h3 id="tools-shell">Turbine shell</h3><div>
<p>
	<a href="http://turbine.peterkroener.de/shell.php">The Turbine Shell</a> is a simple playground for Turbine. Simply enter some HTML and Turbine code,
	configure the browser variables, click "Go!" and see the results! You can use all turbine plugins, constants, aliases and all other features. After
	checking the "Interactive mode" checkbox at the bottom the result frames will be updated after every keystroke.
</p>
<h4>Usage</h4>
<p>
	Add code, change browser variables, click "Go!". Done!
</p>
</div>



</div>



<h2 id="faq">FAQ</h2><div>


<h3 id="faq-why">Why should I use Turbine?</h3><div>
<p>
	Turbine speeds up your CSS development. It allows you to build more websites in less time, charge more for less work or just concentrate on things
	that are more important than tweaking CSS code, like design or content. That's pretty much it.
</p>
</div>


<h3 id="faq-tradeoffs">What are the tradeoffs?</h3><div>
<ol>
	<li>
		Turbine uses the input css files to generate <em>completely</em> new CSS code that won't necessarily look very much like it's source.
		That means that css debugging tools like Firebug may not be very useful anymore, depending on how many of Turbine's
		features and plugins you actually use.
	</li>
	<li>
		The CSS selectors generated by Turbine are usually not as efficent as human-written CSS would be.
	</li>
</ol>
</div>


<h3 id="faq-performance">What about performance?</h3><div>
<p>
	For most cases, Turbine does more good to your website's performance than it does have a negative impact on it. Not only can Turbine output
	<a class="smoothscroll" href="#usage-configuration">compressed CSS code</a>, but all the calculations in Turbine only happen once per file
	and user agent. This result is then cached and used for as long as you don't change the source file, and if it already served that particular
	user agent. The resulting files are served compressed using Zlib output compression in 2KB chunks if available, or alternatively GZIP. Additionally
	Turbine checks whether a user agent already downloaded our current styles and, if that's true, tells it to use its cached version. This way Turbine
	uses as little processing time on the server as possible, reduces transfer times and saves traffic.
</p>
<p>
	In order to improve performance even more, you can minify CSS with the <a class="smoothscroll" href="#plugins-minifier">Minifier plugin</a>,
	and replace all images referenced in your CSS code with embedded data URIs using the <a class="smoothscroll" href="#plugins-datauri">DataURI plugin</a>.
</p>
<p>
	So unless you are a complete performance nerd that knows every trick by heart and has too much time at hands, Turbine will <em>improve</em>
	your website's performance.
</p>
</div>


<h3 id="faq-projects">Is Turbine ready for real projects?</h3><div>
<p>
	Of course! The following websites all use Turbine:
</p>
<ul>
	<li><a href="http://www.initiative-fuer-ausbildung.de/">Initiative für Ausbildung</a></li>
	<li><a href="http://html5-buch.de/">HTML5 - Webseiten innovativ und zukunftssicher</a></li>
	<li><a href="http://beware-energy.com/">BeWare Energy GmbH</a></li>
	<li><a href="http://www.lhg-garten.de/">LHG Gartengestaltung</a></li>
</ul>
</div>


<h3 id="faq-cssp">What does "CSSP" stand for?</h3><div>
<p>
	CSSP stands for "CSS Plus", Turbine's rather unimaginative working title.
</p>
</div>


<h3 id="faq-advice">Any general advice?</h3><div>
<ol>
	<li>
		This is more a disclaimer then a real problem but: Turbine is beta software. Expect stuff to break everywhere, all the time. If you
		encounter bugs, <a href="http://github.com/SirPepe/Turbine/issues">report them</a>!
	</li>
	<li>
		Try not to mess up your indentation! Turbine is not <em>that</em> good at catching incorrectly indented lines and they
		<em>will</em> destroy your css in places you'll never expect. So just pay attention to your whitespace.
	</li>
</ol>
</div>



</div>


<?php include('footer.php'); ?>

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
				<li><a href="#usage-syntax">Basic syntax</a></li>
				<li><a href="#usage-configuration">Configuration</a></li>
				<li><a href="#usage-advanced">Advanced syntax</a></li>
				<li><a href="#usage-constantsaliases">Constants and aliases</a></li>
				<li><a href="#usage-inheritancetemplating">Inheritance and prototyping</a></li>
			</ul>
		</li>
		<li>&darr; <a href="#plugins">Core Plugins</a>
			<ul>
				<li><a href="#plugins-borderradius">Border radius</a></li>
				<li><a href="#plugins-boxshadow">Box shadow</a></li>
				<li><a href="#plugins-fontface">@font-face</a></li>
				<li><a href="#plugins-browser">Browser detection</a></li>
				<li><a href="#plugins-bugfix">Browser bugfixes</a></li>
				<li><a href="#plugins-colormodels">Colormodels</a></li>
				<li><a href="#plugins-datauri">Data-URIs</a></li>
				<li><a href="#plugins-html5">HTML5</a></li>
				<li><a href="#plugins-iee">IE enhancements</a></li>
				<li><a href="#plugins-minifier">Minifier</a></li>
				<li><a href="#plugins-load">Load</a></li>
				<li><a href="#plugins-os">OS and Device detection</a></li>
				<li><a href="#plugins-quote">Quote style</a></li>
				<li><a href="#plugins-reset">Reset stylesheet</a></li>
				<li><a href="#plugins-transforms">Transforms</a></li>
				<li><a href="#plugins-meta">Meta plugins</a></li>
				<!--<li><a href="#plugins-experimental">Experimental plugins</a></li>-->
			</ul>
		</li>
		<li>&darr; <a href="#dev">Development</a>
			<ul>
				<li><a href="#dev-contribute">Contribute</a></li>
				<li><a href="#dev-plugins">Plugin development</a></li>
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
				<li><a href="#faq-advice">Any general advice?</a></li>
				<li><a href="#faq-tradeoffs">What are the tradeoffs?</a></li>
			</ul>
		</li>
	</ul>
</div>



<h2 id="intro">Introduction</h2><div>
<p>
	Turbine is a PHP-powered tool that introduces a new way for writing CSS. It's syntax and features are designed to
	decrease css devolopment time and web developer headache. Turbine takes something like this&nbsp;&hellip;
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
&hellip; and turns it into this&nbsp;&hellip;
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
	Turbine can save you a lot of typing and time <em>and</em> allow you to concentrate on a website's design and functionality instead of
	css's limitations, page performance or your least favourite browser's latest bugs. Think jQuery for CSS. Being fully extensible, you
	can customize Turbine to your liking.
</p>
<h2 id="intro-goalsandfeatures">Goals and Features</h3><div>
<p>
	Turbine's basic features include:
</p>
<ul>
	<li>Minmal syntax&nbsp;&ndash; the less you have have to type, the more you get done</li>
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


<h1 id="usage">Usage</h2><div>

<h2 id="usage-setup">Installation and setup</h3><div>
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
			<td>Sets the base directory for the style files</td>
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
	a list of Turbine files sepperated by semicolons.
</p>
<pre>&lt;link
	rel="stylesheet"
	href="path/to/turbine/css.php?files=file1.cssp;file2.cssp"
/&gt;</pre>
<p>
	The base path for the files can be changed in the file <code>config.php</code> (<code>css_base_dir</code>).
	You can also include regular css files, which will be added to the output unchanged (or minified, if the <code>minify_css</code>
	configuration option is set to <code>true</code>).
</p>
<p>
	The files as processed in sequence and do <strong>not</strong> influence each other in any way. For example,
	<a href="#usage-constantsaliases">constants</a> defined in <code>file1</code> won't apply to code in <code>file2</code>. If
	you want share code between files, use the <a href="#plugins-load">loader plugin</a>.
</p>


<h2 id="usage-syntax">Basic syntax</h3><div>
<p>
	The one important thing about Turbine's syntax is that it is all about <strong>lines</strong>. The context of any statements
	in the code depends of the context of the statement's line.
</p>
<h4>Selectors and rules</h4>
<p>
	Turbine's syntax works a bit like <a href="#">Python</a>&nbsp;&ndash; <strong>the level of indention </strong>instead of curly braces
	decides the context of a given line. A simple rule looks like this:
</p>
<pre class="cssp">#foo div > p               // Selector
    color:red              // Property and value
    font-weight:bold       // Property and value</pre>
<p>
	The way Turbine determines if a given line is a selector or a property-value-pair is the indention level of the <em>following</em>
	line:
</p>
<pre class="cssp">#foo div > p               // Next line is indented = this is a selector
    color:red
    font-weight:bold
    span                   // Next line is indented = this is a selector
        color:blue</pre>
<p>
	This behaviour allows nested selectors, which can be quite powerful (see <a class="smoothscroll" href="#usage-nested">nested selectors</a>).
	You can use any number or combination of spaces and tabs for indention, but be careful to keep your indention constistent in the whole
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
	There a two kinds of comments available: singe line comments that start with <code>//</code>&nbsp;&hellip;
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
	<code>@media</code> block of the same type are merged, so the resulting css looks like the following:
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
<h3 id="usage-syntax-prefixes">Prefixes</h4>
<p>
	There a a few reserved profixes for properties, values and selectors:
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


<h2 id="usage-configuration">Configuration</h3><div>
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
</div>


<h2 id="usage-advanced">Advanced syntax features</h3><div>
<h4>Expanding properties</h4>
<p>
	if you want to use multiple properties with the same value inside a selector, you can take advantage of expanding properties. This
	allows you to use properties as a comma-sepperated list&nbsp;&hellip;
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
</div>



<h2 id="usage-constantsaliases">Constants and aliases</h3><div>


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
	<li><code>$_SCRIPTATH</code>: The path to <code>css.php</code></li>
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
	<img src="scope.png">
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



<h2 id="usage-inheritancetemplating">Inheritance and Prototyping</h3><div>
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
    color:copy(#bar color)</pre>
<p>
	Result:
</p>
<pre class="css">#foo {
    color: #F00
}
#bar {
    color: #F00
}</pre>
<h5>Copying from other properties</h5>
<p>
	The copied and copying properties don't have to be the same:
</p>
<pre class="cssp">#foo
    background:#F00

#bar
    color:copy(#bar background)</pre>
<p>
	Result:
</p>
<pre class="css">#foo {
    color: #F00
}
#bar {
    background: #F00
}</pre>
<h5>Copying with aliases</h5>
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
<h3 id="usage-inheritancetemplating-prototyping">Prototyping</h4>
<h5>Using prototypes</h5>
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


<h4 id="usage-inheritancetemplating-prototyping-recycling">Recycling prototypes</h5>
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



<h1 id="plugins">Core plugins</h2><div>



<h2 id="plugins-borderradius">Border radius</h3><div>
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



<h2 id="plugins-boxshadow">Box shadow</h3><div>
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



<h2 id="plugins-fontface">Simple @font-face</h3><div>
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



<h2 id="plugins-browser">Browser detection</h3><div>
<p class="abstract">
	TODO
</p>
<p>
	TODO
</p>
<h4>Usage</h4>
<p>
	TODO
</p>
<h5>Use cases</h5>
<ul>
	<li>TODO</li>
</ul>
</div>



<h2 id="plugins-bugfix">Automatic browser bugfixes</h3><div>
<p class="abstract">
	Tries to fix some common browser rendering bugs automatically.
</p>
<h4>Bugs fixed by this plugin</h4>
<ul>
	<li>IE6: Image margin bottom bug</li>
	<li>IE6: Background image flickers on hover</li>
	<li>IE6: Float double margin bug</li>
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



<h2 id="plugins-colormodels">Colormodels</h3><div>
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



<h2 id="plugins-datauri">Data URIs</h3><div>
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
    background:#FFF url(test.png) top left;</pre>
<p>
	Result:
</p>
<pre>#foo {
    background: #FFF url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAGCAMAAADXEh96AAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAAGUExURf///8zjYPWWfS0AAAARSURBVHjaYmAAAUYiSIAAAwAAqAAH4ng45wAAAABJRU5ErkJggg==') top left;
}</pre>
</div>



<h2 id="plugins-html5">HTML5</h3><div>
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



<h2 id="plugins-iee">IE enhancements</h3><div>
<p class="abstract">
	Enables a bunch of usually absent features in IE 6 and 7
</p>
<h4>Features enabled by this plugin</h4>
<ul>
	<li>IE6: transparent PNG files (<a href="http://www.twinhelix.com/css/iepngfix/">Source</a>)</li>
	<li>IE6: <code>:hover</code> on all elements (<a href="http://www.xs4all.nl/~peterned/csshover.html">Source</a>)</li>
	<li>IE6 and 7: <code>opacity</code> property (Through a proprietary filter)</li>
</ul>
<h4>Usage</h4>
<p>
	Just add <code>ieenhancements</code> to your <code>@turbine</code> plugins rule. Done!
</p>
</div>



<h2 id="plugins-minifier">Minifier</h3><div>
<p class="abstract">
	Performs a number of micro-optimizations.
</p>
<p>
	The minifier plugins shortens hex color declarations, removes units from zero values and removes whitespace from comma-sepparated
	strings, saving a (tiny) bit of space and loading time.
</p>
<h4>Usage</h4>
<p>
	Just add <code>minifier</code> to your <code>@turbine</code> plugins rule. Done!
</p>
<h4>Example</h4>
<pre class="cssp">#foo
    font-family: Verdana, Arial, sans-serif
    color: #FF0000
    margin: 1em 0em</pre>
<p>
	Result:
</p>
<pre>#foo {
	font-family: Verdana,Arial,sans-serif;
	color: #F00;
	margin: 1em 0;
}</pre>
</div>



<h2 id="plugins-load">Load</h3><div>
<p class="abstract">
	Loads another .cssp file.
</p>
<p>
	Loader loads the contents of another .cssp file at the exact location where <code>@load</code> ist placed. It inserts the
	code of the loaded file before parsing anything, so the contents of the file is subject to all of Turbines operations in
	the file it is inserted into.
</p>
<p>
	The plugin will automatically take care of any differences in indention style between the loaded code and the code it is
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



<h2 id="plugins-os">OS and device detection</h3><div>
<p class="abstract">
	TODO
</p>
<p>
	TODO
</p>
<h4>Usage</h4>
<p>
	TODO
</p>
<h5>Use cases</h5>
<ul>
	<li>TODO</li>
</ul>
</div>



<h2 id="plugins-quote">Quotes</h3><div>
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



<h2 id="plugins-reset">Reset stylesheet</h3><div>
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



<h2 id="plugins-transforms">Transforms</h3><div>
<p class="abstract">
	TODO
</p>
<p>
	TODO
</p>
</div>



<h2 id="plugins-meta">Meta plugins</h3><div>
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
	<li>Border radius</li>
	<li>Box shadow</li>
	<li>Colormodels</li>
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
	<li>IE enhancements</li>
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



<!--<h2 id="plugins-experimental">Experimental plugins</h3><div>
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



<h1 id="dev">Development</h2><div id="development">



<h2 id="dev-contribute">Contribute</h3><div>
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



<h2 id="dev-plugins">Plugin development</h3><div>
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
<h5>Example array</h5>
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
<h5>The <code>$cssp</code> instance</h5>
<p>
	TODO
</p>
<h5>The browser class</h5>
<p>
	TODO
</p>


</div>



</div>



<h1 id="tools">Tools</h2><div>


<h2 id="tools-converter">CSS to Turbine converter</h3><div>
<p>
	TODO
</p>
</div>



<h2 id="tools-shell">Turbine shell</h3><div>
<p>
	TODO
</p>
</div>



</div>



<h1 id="faq">FAQ</h2><div>


<h2 id="faq-advice">Any general advice?</h3><div>
<ul>
	<li>
		Turbine is beta software. Expect stuff to break everywhere, all the time. If you encounter bugs, <a href="http://github.com/SirPepe/Turbine/issues">report them</a>!
	</li>
	<li>
		Try not to mess up your indention! Seriously. Turbine is not <em>that</em> goot at catching incorrectly indented lines and they
		<em>will</em> destroy your css in places you'll never expect. So just pay attention to your whitespace!
	</li>
	<li>
		Don't use constants only for colors! If you use them for font stacks and paths, you can save yourself a lot of typing&nbsp;&ndash;
		<code>font-family:$serif</code> is so much shorter than <code>font-family:Georgia, "Times New Roman", serif</code>.
	</li>
</ul>
</div>



<h2 id="faq-tradeoffs">What are the tradeoffs?</h3><div>
<ul>
	<li>
		Turbine uses the input css files to generate <em>completely</em> new CSS code that won't necessarily look very much like it's source.
		That means that css debugging tools like Firebug may not be very useful anymore, depending on how many of Turbine's
		features and plugins you actually use.
	</li>
	<li>
		The CSS selectors generated by Turbine are usually not as efficent as human-written CSS would be.
	</li>
</ul>
</div>



</div>


<?php include('footer.php'); ?>
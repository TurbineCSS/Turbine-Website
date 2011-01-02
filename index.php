<?php include('header.php'); ?>


<div id="index">


<h2>Turbine</h2>
<p>
	Turbine is a collection of PHP-powered tools that are designed to decrease css development time and web developer headache. This includes:
</p>
<ul>
	<li>A new, minmal syntax – the less you have have to type, the more you get done</li>
	<li>Packing, gzipping and automatic minification of multiple style files</li>
	<li>Constants (also known as "css variables") and selector aliases as well as nested css selectors</li>
	<li>Oop-like inheritance, extension and templating features</li>
	<li>Built-in device-, browser- and os sniffing</li>
	<li>Many automatic bugfixes and enhancements for older browsers</li>
	<li>Fully exensible through a very simple plugin system. A basic understanding of PHP is enough to add completely new features to Turbine</li>
	<li>A CSS to Turbine converter and a shell app for experiments and development</li>
</ul>


<h3>Example</h3>
<p>
	Turbine takes code like this&nbsp;&hellip;
</p>
<pre class="turbine">// Welcome to Turbine!
@media screen
#foo, #bar
    color:#FF0000
    margin-left, margin-right: 4px
    div.alpha, div.beta
        font-weight:bold
        border-radius:4px</pre>
<p>
	&hellip;and turns it into:
</p>
<pre class="css">@media screen {
    #foo, #bar {
        color: #FF0000;
        margin-left: 4px;
        margin-right: 4px;
    }
    #foo div.alpha, #foo div.beta, #bar div.alpha, #bar div.beta {
        font-weight: bold;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        -khtml-border-radius: 4px;
        border-radius: 4px;
    }
}</pre>
<p>
	It is somewhat compareable to <a href="http://sass-lang.com/">Sass</a> and <a href="http://lesscss.org/">Less</a>, but more radically geared towards getting as much done as possible in as few keystrokes as possible.
</p>


<h3>We need your help!</h3>
<p>
	Turbine is still in active development. Help us to make it better!
</p>
<ul>
	<li>Download Turbine, test it and <a href="http://github.com/SirPepe/Turbine/issues">report any bugs you find</a></li>
	<li><a href="http://github.com/SirPepe/Turbine">Fork it</a> and tackle some <a href="http://github.com/SirPepe/Turbine/issues">open issues</a></li>
	<li>Add some more <a href="http://github.com/SirPepe/Turbine/blob/master/tests/browser.php">browser test cases</a>
</ul>


</div>


<?php include('footer.php'); ?>

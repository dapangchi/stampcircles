<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


	<meta name="description" content="Calendar: a Javascript class for Mootools that adds accessible and unobtrusive date-pickers to your form elements">
 	<meta http-equiv="content-type" content="text/html; charset=utf-8"><title>Calendar: a Javascript class for Mootools that adds accessible and unobtrusive date pickers to your form elements</title>
	
	<script type="text/javascript" src="calendar_files/mootools.js"></script>
	<script type="text/javascript" src="calendar_files/tools.js"></script>
	<link rel="stylesheet" type="text/css" href="calendar_files/default.css" media="screen">	
	<script type="text/javascript">
	//<![CDATA[
		window.addEvent('domready', function() { new hover(); });
	//]]>
	</script></head><body>
	<div id="header">
		<h1><img src="calendar_files/h1.gif" alt="Calendar: a Javascript class for Mootools that adds accessible and unobtrusive date-pickers to your form elements" title="Calendar: a Javascript class for Mootools" height="33" width="241"></h1>
	
		<h2><strong>Calendar</strong> A Javascript class for Mootools</h2>

		<ul class="">
			<li><a href="#overview">Overview</a></li>
			<li><a href="#features">Features</a></li>
			<li><a href="#download">Download</a></li>
			<li><a href="#manual">Manual</a></li>
			<li><a href="#contact">Contact</a></li>
		</ul>
	</div>

	<div id="body">
		<noscript><p class="noscript">This website requires Javascript enabled in your browser to function properly.</p></noscript>
	
		<h3 id="overview">Overview</h3>

		<p class="">Calendar is a Javascript class that adds <strong>accessible and unobtrusive date-pickers</strong>
to your form elements. This class is a compilation of many date-pickers
I have implemented over the years and has been completely re-written
for <em>Mootools</em>. I have tried to include all the <strong>features</strong> that have been most useful while <strong>streamlining</strong>
the class itself to keep it as small as possible. Use the links below
to see what features are available in Calendar and how it might <strong>enhance the accessibility, usability and validation</strong> of form elements on your website.</p>		

		<h3 id="features">Features</h3>

		<ul class="columns">
			<li><a href="http://www.electricprism.com/aeron/calendar/_semantic.html" target="demo">Style-able and semantic XHTML</a></li>
			<li><a href="http://www.electricprism.com/aeron/calendar/_directional.html" target="demo">Future / past calendar restrictions (and more)</a></li>
			<li><a href="http://www.electricprism.com/aeron/calendar/_inputs_selects.html" target="demo">Highly configurable use of inputs and selects</a></li>
			<li><a href="http://www.electricprism.com/aeron/calendar/_multi_calendar.html" target="demo">Multi-calendar support (with padding)</a></li>
			<li><a href="http://www.electricprism.com/aeron/calendar/_navigation.html" target="demo">Variable navigation options</a></li>
			<li><a href="http://www.electricprism.com/aeron/calendar/_multi_lingual.html" target="demo">Multi-lingual and fancy date formatting</a></li>
		</ul>

		<iframe id="demo" name="demo" src="calendar_files/_semantic.htm" frameborder="0" scrolling="no"></iframe>

		<h3 id="download">Download</h3>

		<h4>Requirements</h4>
		
		<p class="">Calendar has been successfully tested in <em>Safari</em>, <em>Firefox</em>, <em>Opera</em> and <em>Internet Explorer</em>. The class requires <a href="http://mootools.net/download">Mootools 1.1</a> with <em>Fx.Style</em>, <em>Element</em> and <em>Window</em>. In order <strong>to enable dragging</strong>, the class also requires the <em>Drag</em> component.</p>

		<h4>Links</h4>

		<p class="">You are downloading <em>Release Candidate 4</em> (<strong>fixes</strong>: bug with blocked dates, calendar placement, selects in IE6, day-of-the-week offset and more; <strong>added</strong>:
N and w formatting, dash meta character to blocked dates, tweaking,
event handlers and css for today and all the days between 2 or more
dates with multi-calendar functionality).</p>

		<ul class="">
			<li><a href="http://www.electricprism.com/aeron/calendar/js/calendar.js">calendar.js</a> - yui'd (15k)</li>
			<li><a href="http://www.electricprism.com/aeron/calendar/js/calendar.rc4.js">calendar.rc4.js</a> - raw with comments (33k)</li>
			<li><a href="http://www.electricprism.com/aeron/calendar/js/mootools.js">mootools.js</a> - jsmin'd with above components (43k)</li>
		</ul>

		<h4>Share</h4>

		<p class="">If you like Calendar, also check out <a href="http://www.electricprism.com/aeron/slideshow/">Slideshow: a javascript class to stream and animate the presentation of images on your website</a>. Show your support by <em>clicking the Digg button</em> below!</p>

		<script type="text/javascript">
			digg_url = 'http://digg.com/programming/Sleek_Javascript_Calendar_Date_Picker_for_Mootools';
			digg_bgcolor = '#CCCCCC';
			digg_skin = 'compact';
		</script>
		<script src="calendar_files/diggthis_002.htm" type="text/javascript"></script><iframe src="calendar_files/diggthis.htm" frameborder="0" height="18" scrolling="no" width="120"></iframe>

		<h4>Contribute</h4>

		<p>Developing Calendar takes a lot of blood, sweat and tears. If you would like to do something to encourage production, consider <strong>donating</strong>
below. Donors always receive personal notice of new releases in
addition to access to beta versions before the general public... <em>and my gratitude!</em></p>
		  
    <form class="donation" action="https://www.paypal.com/cgi-bin/webscr" method="post">
      <input name="cmd" value="_s-xclick" type="hidden">
      <input src="calendar_files/donate.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" border="0" type="image">
      <img alt="" src="calendar_files/pixel.gif" border="0" height="1" width="1">
      <input name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
      " type="hidden">
    </form>
    
		<h3 id="manual">Manual</h3>

		<h4>Important</h4>

		<p>Using Calendar <strong>requires</strong> at the very least knowledge of <a href="http://www.w3schools.com/xhtml/default.asp" title="XHTML Tutorial">XHTML</a> and <a href="http://www.w3schools.com/css/default.asp" title="CSS Tutorial">CSS</a> and some experience using <a href="http://www.w3schools.com/js/default.asp" title="Javascript Tutorial">Javascript</a> in web pages. If you meet those requirements first make sure you have downloaded <a href="http://mootools.net/download" title="Mootools Download">Mootools</a> with the components listed <a href="#download">above</a>. Then follow the instructions below to begin using Calendar!</p>

		<h4>Installation</h4>

		<p>Link the <em>calendar.js</em> javascript file from within the head of your HTML document. Be sure to link calendar.js <strong>after</strong> mootools.js in the order they appear. <strong>Note</strong> remember to adjust the <em>src</em> to reflect the location of the javascripts on your website.</p>

		<code>
			&lt;head&gt;<br>
			&nbsp;&nbsp;...<br>
			&nbsp;&nbsp;&lt;script type="text/javascript" src="mootools.js"&gt;&lt;/script&gt;<br>
			&nbsp;&nbsp;&lt;script type="text/javascript" src="calendar.js"&gt;&lt;/script&gt;<br>
			&lt;/head&gt;
		</code>

		<h4>Usage</h4>

		<p>Execute the class from within the head of your HTML document. Calendar has <strong>one</strong> required parameter: an <em>object</em> containing the <strong>element_id: 'format'</strong> pairs of the inputs or selects the class will be applied to. An object in Javascript is a collection of <em>key: value</em> pairs separated by <em>commas</em> and contained within <em>curly-brackets {}</em>. In this case, assuming the element you wanted to apply the class to was the following:</p>

		<code>
			&lt;input id="date" name="date" type="text" /&gt;
		</code>

		<p>An example of a valid execution of Calendar would be:</p>

		<code>
			&lt;head&gt;<br>
			&nbsp;&nbsp;...<br>
			&nbsp;&nbsp;&lt;script type="text/javascript"&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;window.addEvent('domready', function() { myCal = new Calendar({ date: 'd/m/Y' }); });<br>
			&nbsp;&nbsp;&lt;/script&gt;<br>
			&lt;/head&gt;
		</code>

		<p>In this case the <strong>function() { ... }</strong> is the execution call: we are attaching it to the <a href="http://docs.mootools.net/Window/Window-DomReady.html">domready</a>
event of the window, which means it will be run as soon as the webpage
has been loaded, without waiting for images. Of the function statement <strong>myCal = new Calendar({ ... });</strong> itself: we are setting a <em>new</em> Calendar instance to a variable named <strong>myCal</strong>. Of the object <strong>{ date: 'd/m/Y' }</strong> we are passing in as the required parameter: <strong>date</strong> is the <em>id</em> of the element and <strong>'d/m/Y'</strong> is the <em>format</em> the date will appear as. Calendar accepts the following characters for date formatting: <em>d, D, j, l, N, w, S, F, m, M, n, Y, y</em> borrowing syntax from <a href="http://www.php.net/manual/en/function.date.php" target="_blank">PHP's date function</a>. Some other examples are as follows:</p>

		<code>
			new Calendar({ year: { day: 'd', month: 'm', year: 'Y' }});
		</code>

		<p>Where <strong>day</strong>, <strong>month</strong> and <strong>year</strong> are the <em>ids</em> of 3 inputs or selects and <strong>'d'</strong>, <strong>'m'</strong> and <strong>'Y'</strong> are their corresponding <em>formats</em>. The preceding <strong>year</strong> indicates the element the calendar <em>button</em> will be appended to–see <strong>Styling Your Calendar</strong> below for more information.</p>

		<code>
			new Calendar({ day: { day: 'd', monthyear: 'm-Y' }});
		</code>
		
		<p>Similar to above, in this case there is one element for the <em>day</em> and one element for the combined <em>month</em> and <em>year</em> values. The button is appended to the <em>day</em> element.</p>

		<code>
			new Calendar({ date1: 'd/m/Y', date2: 'd/m/Y' });
		</code>
		
		<p>Here the class is applied to <strong>two different</strong> date elements, resulting in <a href="http://www.electricprism.com/aeron/calendar/_multi_calendar.html" target="demo">multi-calendar functionality</a> as demonstrated in the <a href="#features">features</a> above.</p>

		<code>
			new Calendar({ day1: { day1: 'd', monthyear1: 'm-Y' }, day2: { day2: 'd', monthyear2: 'm-Y' }});
		</code>

		<p>Similar to example two, but with <strong>multi-calendar</strong> functionality as well.</p>

		<h4>Properties</h4>

		<p>Following the first object, the class also accepts an optional second object that may contain any of the following <strong>properties</strong> to help customize Calendar to your website:</p>

		<ul>
			<li><strong>blocked</strong> - An array of blocked (disabled) dates in the following format: <strong>'day month year'</strong>. The syntax is similar to <em>cron</em>: the values are separated by <strong>spaces</strong> and may contain <strong>* (asterisk) - (dash)</strong> and <strong>, (comma) delimiters</strong>. For example <strong>blocked: ['1 1 2007']</strong> would disable <em>January 1, 2007</em>; <strong>blocked: ['* 1 2007']</strong> would disable <em>all days (wildcard) in January, 2007</em>; <strong>blocked: ['1-10 1 2007']</strong> would disable <em>January 1 through 10, 2007</em>; while <strong>blocked: ['1,10 1 2007']</strong> would disable <em>January 1 and 10, 2007</em>. In combination: <strong>blocked: ['1-10,20,22,24 1-3 *']</strong> would disable <em>1 through 10, plus the 22nd and 24th of January through March for every (wildcard) year</em>. There is an optional additional value which is <strong>day of the week</strong> (0 - 6 with 0 being Sunday). For example <strong>blocked: ['0 * 2007 0,6']</strong> would disable <em>all weekends (saturdays and sundays) in 2007</em>.</li>
			<li><strong>classes</strong> - An array of 12 CSS classes that are applied to the calendar construct: <em>calendar, prev, next, month, year, today, invalid, valid, inactive, active, hover, hilite</em>. It is not necessary (as of RC3) to pass all 11 classes in the array: if you only wanted to change the 1st class you would set <strong>classes: ['alternate']</strong>; if you only wanted to change the 1st and 4th classes you would need to set <strong>classes: ['alternate', '', '', 'mes']</strong>. The first class, by default <strong>'calendar'</strong>, is applied to the <strong>div</strong> that contains the calendar element, the calendar <strong>button</strong> and the <strong>input or select</strong> it is appended to. The <strong>'hilite'</strong> class (as of RC4) is applied to all days between 2 or more selected dates in multi-calendar functionality - see the <a href="http://www.electricprism.com/aeron/calendar/_multi_calendar.html" target="demo">demo</a> for an example.</li>
			<li><strong>days</strong> - An array of the 7 names of the days of the week, starting with sunday.</li>
			<li><strong>direction</strong> - A positive or negative integer that determines the calendar's direction: <em>n</em> (a positive number) the calendar is future-only beginning at <em>n</em> days after today; <em>-n</em> (a negative number) the calendar is past-only ending at <em>n</em> days before today; <em>0</em> (zero) the calendar has <em>no</em>
future or past restrictions (default). Note if you would like the
calendar to be directional starting from today–as opposed to (1)
tomorrow or (-1) yesterday–use a positive or negative fraction, such as
direction: .5 (future-only, starting today).</li>
			<li><strong>draggable</strong>
- A boolean value, true or false, to indicate if the calendar element
will be draggable–useful in case the calendar obstructs (or is
obstructed by) some other element on the page. <strong>Note</strong>, requires <em>Mootools</em> to be compiled with the <em>Drag</em> component.</li>
			<li><strong>months</strong> - An array of the 12 names of the month, starting with january.</li>
			<li><strong>navigation</strong> - An integer–0, 1 or 2–indicating which navigation method the class will use: traditional navigation (<em>1</em>) where left and right arrows allow the user to <em>navigate by month</em> (default); improved navigation (<em>2</em>) where the user can <em>navigate by month or year</em>; and static navigation (<em>0</em>) which is actually <em>no navigation</em> at all.</li>
			<li><strong>offset</strong> - An integer that indicates the first day of the week, with 0 being Sunday (default).</li>
			<li><strong>onHideStart, onHideComplete, onShowStart, onShowComplete</strong> - Event handlers that can be used to trigger your own scripts.</li>
			<li><strong>pad</strong> - An integer, the minimum number of days between calendars with <strong>multi-calendar</strong> functionality. For example: <em>1</em> (default) would enforce multiple calendars to space <strong>at least 1 day</strong> between picked dates; <em>7</em> would enforce a space of <strong>at least 1 week</strong>; while <em>0</em> (<strong>no padding</strong>) would allow multiple calendars to occupy the same date.</li>
			<li><strong>tweak</strong> - An object with <em>{ x: 0, y: 0}</em> values that will "tweak" the calendar's placement on the page by <em>x</em> number of pixels <strong>horizontally</strong> and <em>y</em> number of pixels <strong>vertically</strong>.</li>
		</ul>

		<p>Therefore, it's possible that your Calendar initialization actually looks something like this:</p>

		<code>
myCal = new Calendar({ date1: 'F j, Y', date2: 'F j, Y' }, { blocked:
['20-25,31 12 *'], direction: 1, navigation: 2, pad: 2 }); </code>

		<h4>Styling Your Calendar</h4>

		<p>As described above in the <strong>classes</strong> property, Calendar uses the following CSS classes to stylize elements or functionality: <em>calendar, prev, next, month, year, invalid, valid, inactive, active, hover</em>. The first class, in this case <strong>'calendar'</strong>, is applied to the <strong>div</strong> that contains the calendar element, the calendar <strong>button</strong> and the <strong>form element</strong>
it is appended to. Since it usually looks better to reduce the size of
the form element to accommodate the button, an example of styles might
be:</p>

		<code>
			input {<br>
			&nbsp;&nbsp;width: 100px;<br>
			}<br>
			input.calendar {<br>
			&nbsp;&nbsp;width: 74px;<br>
			}<br>
			button.calendar {<br>
			&nbsp;&nbsp;background: url(calendar-icon.gif);<br>
			&nbsp;&nbsp;border: 0;<br>
			&nbsp;&nbsp;cursor: pointer;<br>
			&nbsp;&nbsp;float: left;<br>
			&nbsp;&nbsp;height: 20px;<br>
			&nbsp;&nbsp;margin-right: 6px;<br>
			&nbsp;&nbsp;width: 20px;<br>
			}<br>
			button.calendar:hover,<br>
			button.calendar.active {<br>
			&nbsp;&nbsp;background-position: left bottom;<br>
			}
		</code>

		<p>Here you can see the default <em>width</em> of a form <strong>input</strong> is 100px. In this case, the element that the <strong>calendar button</strong> will be appended to has a <em>width of 74px</em> - that's the default <em>width (100)</em> minus the <em>width (20)</em> and <em>margin (6)</em> of the calendar button. The <em>XHTML</em> of the calendar element itself depends slightly on the navigation mode set. The default, <strong>navigation: 1</strong>, generates the following:</p>

		<code>
			&lt;div class="calendar"&gt;<br>
			&nbsp;&nbsp;&lt;div&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&lt;table&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;caption&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class="prev"&gt;&amp;lt;&lt;/a&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;span class="month"&gt;[Month]&lt;/span&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;span class="year"&gt;[Year]&lt;/span&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class="next"&gt;&amp;gt;&lt;/a&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/caption&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;thead&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;th&gt;S&lt;/th&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;th&gt;M&lt;/th&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;th&gt;T&lt;/th&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;th&gt;W&lt;/th&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;th&gt;T&lt;/th&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;th&gt;F&lt;/th&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;th&gt;S&lt;/th&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/tr&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/thead&gt;<br>			
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tbody&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;30&lt;/td&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td&gt;31&lt;/td&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td class="invalid"&gt;1&lt;/td&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td class="invalid"&gt;2&lt;/td&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td class="valid"&gt;3&lt;/td&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td class="inactive"&gt;4&lt;/td&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;td class="active"&gt;5&lt;/td&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/tr&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt; ... &lt;/tr&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt; ... &lt;/tr&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt; ... &lt;/tr&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt; ... &lt;/tr&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;tr&gt; ... &lt;/tr&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/tbody&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&lt;/table&gt;<br>
			&nbsp;&nbsp;&lt;/div&gt;<br>
			&lt;/div&gt;
		</code>
		
		<p><strong>Note</strong> that the calendar is <strong>padded</strong> with the ending days of the previous month and starting days of the next month, however these table cells are <em>unclassed</em>. Days that are within the current month but <em>disabled or blocked</em> are classed as <strong>'invalid'</strong>. Days that are within the current month and <em>clickable</em> are classed as <strong>'valid'</strong>. The day that has been <em>set</em> is classed <strong>'active'</strong>. In multi-calendar mode, days that have been <em>set by other calendars</em> appear classed as <strong>'inactive'</strong>. All clickable days–which may include days classed as <strong>inactive</strong> or <strong>active</strong>–receive the <strong>'hover'</strong> class on <em>mouseover</em>.</p>

		<p>Depending on the navigation mode set, the <em>CAPTION</em> element may be created differently. For <strong>navigation: 2</strong>, the caption element is generated as following:</p>

		<code>
			&lt;caption&gt;<br>
			&nbsp;&nbsp;&lt;span class="month"&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class="prev"&gt;&amp;lt;&lt;/a&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&lt;span&gt;[Month]&lt;/span&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class="next"&gt;&amp;gt;&lt;/a&gt;<br>
			&nbsp;&nbsp;&lt;/span&gt;<br>
			&nbsp;&nbsp;&lt;span class="year"&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class="prev"&gt;&amp;lt;&lt;/a&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&lt;span&gt;[Year]&lt;/span&gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class="next"&gt;&amp;gt;&lt;/a&gt;<br>
			&nbsp;&nbsp;&lt;/span&gt;<br>
			&lt;/caption&gt;
		</code>

		<p>For <strong>static or no navigation</strong> (<em>0</em>) the caption element is:</p>

		<code>
			&lt;caption&gt;<br>
			&nbsp;&nbsp;&lt;span class="month"&gt;[Month]&lt;/span&gt;<br>
			&nbsp;&nbsp;&lt;span class="year"&gt;[Year]&lt;/span&gt;<br>
			&lt;/caption&gt;
		</code>

		<h4>Tips &amp; Tricks</h4>

		<ul>
			<li>In case you noticed the XHTML contains an extra <em>div</em> between the <em>table</em> and the <em>calendar wrapper</em>: briefly, any element that does not have a typical <strong>block</strong> or <strong>inline</strong> CSS display property, results in a lot of rendering disparities between the browsers. In this case, the <em>caption</em> element has it's own <strong>display: table-caption</strong> which seems to share qualities with <strong>both</strong> block and inline. Anyway I found that by adding the extra div I was able to resolve all CSS problems <strong>without</strong> needing separate stylesheets or CSS hacks–hope it helps someone else the same way.</li>
		</ul>

		<h3 id="contact">Contact</h3>

		<p>Questions? Comments? Join the discussion <a href="http://forum.mootools.net/viewtopic.php?pid=33384" title="Mootools forums">here</a> or at <em>#mootools</em> in irc.freenode.net (chat).</p>

		<p>I am <em>available</em> on occasion for contract work as well–please visit my <a href="http://www.electricprism.com/aeron">portfolio page</a>. Please <strong>do not</strong> email me directly regarding problems with the script, rather use the link above so that others can benefit from the <em>bugs / solutions</em> you have uncovered–<strong>support open source by being open</strong>.</p>
	</div>
</body></html>
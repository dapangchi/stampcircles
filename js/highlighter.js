goog.require('goog.dom.annotate');

tinyHighlighter = function (options) { //implied global
  var defaults = {
    version: "2.2",
    automatic: true,
    //automaticSelector: 'js1',
    lineNumbers: true,
    zebraLines: false,
    recipeLoading: true,
    cssFolder: "",
    // if not in recipes folder
    highLights: ['plugins', 'jQuery']
    // within the code
  }

  var empty = {};
  var settings = $.extend(empty, defaults, options || {});

  // shorter variables
  id = settings.automaticSelector;

  // a function to match a non-empty string
  function matcher(regExpr, aString) {
      if (aString.isEmpty) return null;
      var result=aString.match(regExpr);
      return (result)?result:null;
  }

  function doAnnotation(termIndex, termHtml) {
    return '<span class="str" style="color:rgb(206,123,0)" >' + termHtml + '</span>';
  }

  function doAnnotationKeyword(termIndex, termHtml) {
    return '<span class="keyword" style="color:rgb(255,255,0);font-style:italic" >' + termHtml + '</span>';
  }

  function doAnnotationComment(termIndex, termHtml) {
    return '<span class="comment" style="color:rgb(206,123,0)"; >' + termHtml + '</span>'; //120,120,120
  }

  // does everything on a page
  function doAnnotationLineComment(termIndex, termHtml) {
    return '<span class="lineComment" style="color:rgb(206,123,0)" >' + termHtml + '</span>';
  }

  function doAnnotationRegularExpression(termIndex, termHtml) {
    return '<span class="regex" style="color:maroon" >' + termHtml + '</span>';
  }

  function doAnnotationBrace(termIndex, termHtml) {
    return '<span class="keyword" style="color:rgb(255,255,0);font-style:italic" >' + termHtml + '</span>';
  }

  function doAnnotationObject(termIndex, termHtml) {
    return '<span class="regex" style="color:green" >' + termHtml + '</span>';
  }
  var result;
  var HTML;
  //id='js1';
  // get the HTML using jQuery (text onley to avoid css?
      HTML = $('#' + id).text();
// alert(HTML);
 
  // get the node
  var _$e = goog.dom.getElement(id);

  // python stuff only experimental here must be moved
  var python_comment=/\#+\s*[^\n]*[\n]/g;  // starts from #
  var html = matcher(python_comment, HTML);
  if (html !== null) {
    for (var i = 0; i < html.length; i++) {
      result = goog.dom.annotate.annotateTerms(_$e, [
        [html[i], false]], doAnnotationComment, false, ['lineComment']);
    }
  }

  // python stuff only experimental here must be moved
  var lua_comment=/\--\s*.*[\n]/g;  // starts from #
  var html = matcher(lua_comment, HTML);
  if (html !== null) {
    for (var i = 0; i < html.length; i++) {
      result = goog.dom.annotate.annotateTerms(_$e, [
        [html[i], false]], doAnnotationComment, false, ['lineComment']);
    }
  }

  /* lisp
  var lisp_comment=/;\s*.*[\n]/g;  // starts from ;
  var html = matcher(lisp_comment, HTML);
  if (html !== null) {
    for (var i = 0; i < html.length; i++) {
      result = goog.dom.annotate.annotateTerms(_$e, [
        [html[i], false]], doAnnotationComment, false, ['lineComment']);
    }
  }
*/

  // needs a better expression
  var python_triple_quote=/u*\"\"\"\s*[^\"]+\"\"\"/g;
      html = matcher(python_triple_quote, HTML);
  if (html !== null) {
    for (var i = 0; i < html.length; i++) {
      result = goog.dom.annotate.annotateTerms(_$e, [
        [html[i], false]], doAnnotation, false, ['lineComment']);
    }
  }

 // needs a better expression
 // if t enclose d=' ' will not work
  var python_triple_single_quote=/u*\'\'\'\s*[^\']+\'\'\'/g;
      html = matcher(python_triple_single_quote, HTML);
  if (html !== null) {
    for (var i = 0; i < html.length; i++) {
      result = goog.dom.annotate.annotateTerms(_$e, [
        [html[i], false]], doAnnotation, false, ['lineComment']);
    }
  }


  //alert(_$e);
  // catch block comments
  var _comment = /\/\*[^*]*\*+(?:[^\/][^*]*\*+)*[\/]/g;
      html = matcher(_comment, HTML);
  //alert(html);
  //alert(html);
  if (html !== null) {
    for (var i = 0; i < html.length; i++) {
      result = goog.dom.annotate.annotateTerms(_$e, [
        [html[i], false]], doAnnotationComment, false, ['lineComment']);
    }
  }
  //alert(html);
  // catch line comments
  var _lineComment = /\/\/.*/g;
  html = matcher(_lineComment, HTML);
  if (html !== null) {
    for (var j = 0; j < html.length; j++) {
         result = goog.dom.annotate.annotateTerms(_$e, [
        [html[j], true]], doAnnotationLineComment, false, ['comment']);
    }
  }
 // alert('line comments' +html);
  // annotate strings
  var _string = /(?:\'[^\'\\\n]*(?:\\.[^\'\\\n]*)*\')|(?:\"[^\"\\\n]*(?:\\.[^\"\\\n]*)*\")/g;
  html = matcher(_string, HTML);
     if (html !== null) {
  for ( i = 0; i < html.length; i++) {
      var r=html[i];
      result = goog.dom.annotate.annotateTerms(_$e, [
        [r, false]], doAnnotation, false, ['comment', 'regex', 'lineComment']);
    }
  }

  //alert('string'+html);
  // annotate regular expressions
  var regex = /\/[^\/\\\n]*(?:\\.[^\/\\\n]*)*\/[gim]*/g;
  html = matcher(regex, HTML);
  //alert('regex '+html);
  if (html !== null) {
   var length= html.length;
    for ( i = 0; i < length; i++){
        var regs=html[i];
        result = goog.dom.annotate.annotateTerms(_$e, [
        [regs, false]], doAnnotationRegularExpression, false, ['comment', 'lineComment', 'str']);
    }
  }

  //alert('REGEX'+html)
  //annotate all keywords
  var keywords = [
    ['with', true],
    ['while', true],
    ['try', true],
    ['throw', true],
    ['switch', true],
    ['finally', true],
    ['else', true],
    ['do', true],
    ['default', true],
    ['continue', true],
    ['const', true],
    ['catch', true],
    ['case', true],
    ['function', true],
    ['var', true],
    ['if', true],
    ['for', true],
    ['return', true],
    ['null', true],
    ['undefined',true],
    ['break', true],
    ['true', true],
    ['false', true],
    ['eval',true],
    ['def',true],         //python
    ['except',true],
    ['class',true],
    ['from',true],
    ['import',true],
    ['elif',true],
    ['print',true],//python
    ['end',true],//lua
    ['then',true],//lua
    ['local',true],//lua
    ['or',true],
    ['defn',true], //lisp
    ['main',true], //C/C++
    ['int',true],
    ['printf',true],
    ['char',true],
    ['strcpy',true],
    ['free',true],
    ['float',true]
    
];

  var all = ['comment', 'lineComment', 'str', 'regex', 'keyword'];
  result = goog.dom.annotate.annotateTerms(_$e, keywords, doAnnotationKeyword, false, all);

  // objects in global space?
  // mock first
  result = goog.dom.annotate.annotateTerms(_$e, [
    ['google', false],
    ['String',true],
    ['goog',true]  //for Google Application Engine
    ], doAnnotationObject, false, ['comment', 'lineComment', 'str']);

  // braces
  result = goog.dom.annotate.annotateTerms(_$e, [
    ['{', false],
    ['}', false]], doAnnotationBrace, false, ['comment', 'lineComment', 'str', 'regex']);

  // operators
  var operators = [
    ['void', true],
    ['typeof', true],
    ['this', true],
    ['$this', true],
    ['new', true],
    ['instanceof', true],
    ['in', true],
    ['delete', true],
    ['-',true]];
  result = goog.dom.annotate.annotateTerms(_$e, operators, doAnnotationBrace, false, all);

};





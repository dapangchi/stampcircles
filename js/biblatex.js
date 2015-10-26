function Biblatex() {
  this.regularEntryTypes = function () {
    return['article', 'book', 'mvbook', 'inbook', 'bookinbook', 'suppbook', 'booklet', 'collection', 'mvcollection', 'incollection', 'suppcollection', 'manual', 'misc', 'online', 'patent', 'periodical', 'suppperiodical', 'proceedings', 'mvproceedings', 'inproceedings', 'reference', 'mvreference', 'inreference', 'report', 'set', 'thesis', 'unpublished', 'customa']
  };

  this.unsupportedTypes = function () {
    return[];
  }

  this.typeAliases = function () {
    return['conference', 'electronic', 'masterthesis', 'phdthesis', 'techreport', 'www', 'artwork', 'audio', 'bibnote', 'commentary', 'image', 'jurisdiction', 'legislation', 'legal', 'letter', 'movie', 'music', 'performance', 'review', 'softaware', 'standard', 'video']
  }

}

article = {
  'title': 'em',
  'author': 'author',
  'url': 'url',
  'journal': 'journal',
  'urlTerminator': '. '
};

function Citation(obj) {
  if (! (this instanceof arguments.callee)) return new Citation();
  this.data = [];
  this.labels = [];
  this.count = 1;
}

Citation.prototype.pushFields = function (obj) {
  this.data.push('\n [' + (this.count++) + '] ');
  for (var key in obj) {
    log(key, ' ', article[key], article[key + 'Terminator']);
    var el = key;
    var terminator = '. ';
    if (key !== 'type' && key !== 'label') {
      if (article[key.concat('Terminator') !== 'undefined']) terminator = article[key.concat('Terminator')]
      else {
        terminator = ', ';
       };
      var s = '<' + el + '>' + obj[key] + terminator + '  </' + el + '> '
      this.data.push(s);
    }
  }
  this.data.push(' <p></p>');
};

Citation.prototype.render = function () {
  return this.data.join('');
};

Citation.prototype.add = function (obj) {
  // add name in array of citation labels
  // this acts as a cache to speed things up
  for (var k = 0; k < obj.length; k++) {
    this.labels.push(obj[k].label);
    var tempObj = {};
    for (var prop in obj[k]) {
      tempObj[prop] = obj[k][prop];
    };
    this.pushFields(tempObj);
  }
}

t = Citation();
t.add([{
  type: 'article',
  label: 'Quinlan86',
  author: 'Quinlan, J. R.',
  articletitle: 'Induction of decision trees',
  year: '1986',
  journal: 'Machine Learning 1(1)',
  pages: '81-106'
},
{
  type: 'article',
  label: 'Shannon48',
  author: 'Shannon, C.E.',
  articletitle: 'A mathematical theory of communication',
  journal: 'Bell System Technical Journal',
  volume: '27',
  pages: '379-456',
  url: 'http://cm.bell-labs.com/cm/ms/what/shannonday/paper.html'
}]);

//log(t.labels);
log(t.render());

function parse_names(&$text){
//
$pattern='/
(
 (\(            #main pattern bracket
 Mr.\s|
 Mr\s|
 Mrs\s|
 Mrs.\s|
 Miss.\s|
 Miss\s|
 Prof.\s|
 Prof\s|
 Dr[.\s]|
 Sra.\s|
 Sra\s|The\sReverend|
 h|de\s|van\s|van\sder\s|
 von\s|
 al\s|
 al-|
 Al\s|
 ibn\s|
 ibn\sal-|
 bin\s|
 bint\s|
 d\'|
 de\s|
 da\s|
 das\s|
 dos\s|
 \'t\s|      #more rare Dutch for example Maarten \'t Hart
 \úr\s|      #more rare Icelandic
 \‘|
 \'|
 )? #optional prenoms
([[:upper:]][\.\s]?)+?    #starts with upper

[[:alpha:]\'\-\.\&][[:alpha:]|’|\-\,]*   #allows for most Le Ni etc two characters
[\s|\.|\'|\)|\(|\‘]?
(\"|Ltd|Ltd\.|\(Pty\)|AG)?   #suffixes for companies
){2,}+/sx';

  preg_match_all($pattern,$text,$values);
  $text=preg_replace($pattern,'<strong> $0 </strong>',$text);
  echo_array($values);
  //echo markdown($text);
  return $values;
}



function parse_names(&$text){
//
$pattern=/
(
 (\(            /*main pattern bracket*/
 Mr.\s|         /* */
 Mr\s|
 Mrs\s|
 Mrs.\s|
 Miss.\s|
 Miss\s|
 Prof.\s|
 Prof\s|
 Dr[.\s]|
 Sra.\s|
 Sra\s|The\sReverend|
 h|de\s|van\s|van\sder\s|
 von\s|
 al\s|
 al-|
 Al\s|
 ibn\s|
 ibn\sal-|
 bin\s|
 bint\s|
 d\'|
 de\s|
 da\s|
 das\s|
 dos\s|
 \'t\s|      #more rare Dutch for example Maarten \'t Hart
 \úr\s|      #more rare Icelandic
 \‘|
 \'|
 )? #optional prenoms
([[:upper:]][\.\s]?)+?    #starts with upper

[[:alpha:]\'\-\.\&][[:alpha:]|’|\-\,]*   #allows for most Le Ni etc two characters
[\s|\.|\'|\)|\(|\‘]?
(\"|Ltd|Ltd\.|\(Pty\)|AG)?   #suffixes for companies
){2,}+/sx';

  preg_match_all($pattern,$text,$values);
  $text=preg_replace($pattern,'<strong> $0 </strong>',$text);
  echo_array($values);
  //echo markdown($text);
  return $values;
}
























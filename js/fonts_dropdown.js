/* 
 * Font drop downs and manipulation
 * with javascript
 * version 1.0
 * Dr Y Lazarides  2011
 * Based broadly on weebly's
 * javascript uses prototype and scriptaculous $H
 */

// First define the available fonts
var fonts = {
    "Arial":{
        "bold":true,
        "italic":true,
        "bolditalic":true,
        "system":"Arial"
    },
    "Comic Sans":{
        "bold":true,
        "system":"Comic Sans MS"
    },
    "Courier New":{
        "bold":true,
        "italic":true,
        "bolditalic":true,
        "system":"Courier New"
    },
    "Georgia":{
        "bold":true,
        "italic":true,
        "bolditalic":true,
        "system":"Georgia"
    },
    "Impact":{
        "system":"Impact"
    },
    "Times New Roman":{
        "bold":true,
        "italic":true,
        "bolditalic":true,
        "system":"Times New Roman"
    },
    "Trebuchet":{
        "bold":true,
        "italic":true,
        "bolditalic":true,
        "system":"Trebuchet MS"
    },
    "Verdana":{
        "bold":true,
        "italic":true,
        "bolditalic":true,
        "system":"Verdana"
    },
    "Cantarell":{
        "bold":true,
        "italic":true,
        "bolditalic":true
    },
    "Cardo":[],
    "Crimson Text":[],
    "Droid Sans":{
        "bold":true
    },
    "Droid Sans Mono":[],
    "Droid Serif":{
        "bold":true,
        "italic":true,
        "bolditalic":true
    },
    "IM Fell":{
        "italic":true
    },
    "Inconsolata":[],
    "Josefin Sans Std":[],
    "Lobster":[],
    "Molengo":[],
    "OFL Sorts Mill Goudy":{
        "italic":true
    },
    "Reenie Beanie":[],
    "Tangerine":[],
    "Vollkorn":{
        "bold":true
    },
    "Yanone Kaffeesatz":[],
    "Windsong":[],
    "Aller":{
        "bold":true,
        "italic":true,
        "bolditalic":true
    },
    "Sansation":{
        "bold":true
    },
    "Marketing Script":[],
    "Journal":[],
    "Ubuntu":[],
    "PT Sans":{
        "bold":true,
        "italic":true,
        "bolditalic":true
    },
    "Daniel":{
        "bold":true
    },
    "NeoRetroDraw":[],
    "Bebas":[],
    "Saginaw":{
        "bold":true
    },
    "BlackJack":[],
    "Junkos Typewriter":[],
    "Rabiohead":[],
    "UglyQua":{
        "italic":true
    },
    "Gentium Basic":{
        "bold":true,
        "italic":true,
        "bolditalic":true
    },
    "Angelina":[],
    "Aquiline":[],
    "CAC Champagne":[],
    "Riesling":[],
    "Note this":[],
    "Beautiful ES":[],
    "Sapir":{
        "italic":true
    },
    "Chopin":[],
    "Freebooter":[],
    "Amadeus":[],
    "Honey Script":[],
    "Capture it":[],
    "Universal fruitcake":[],
    "Flux":{
        "bold":true,
        "italic":true,
        "bolditalic":true
    },
    "Snickles":[],
    "Komika Axis":[],
    "Forelle":[],
    "Kingthings Calligraphica":[],
    "Louisianne":[],
    "SeasideResort":[],
    "Lilly":[],
    "Folks Light":{
        "bold":true
    },
    "Forque":[],
    "Virgo 01":[],
    "DayPosterBlack":[],
    "Distant Galaxy":[],
    "Minotaur":[],
    "Vanilla":[],
    "Cambria":{
        "bold":true,
        "italic":true,
        "bolditalic":true
    }
}; //fonts object

// Group the fonts in font groups
var fontGroups = {
    "Sans Serif":["Aller","Arial","Cantarell","Droid Sans","Folks Light",
        "Inconsolata","Lilly","Molengo","PT Sans","Sansation","Sapir","Trebuchet",
        "Ubuntu","Verdana","Yanone Kaffeesatz"],
    "Serif":["Cardo","Crimson Text","Droid Serif","Gentium Basic","Georgia",
        "IM Fell","OFL Sorts Mill Goudy","Times New Roman","UglyQua","Vollkorn"],
    "Monospace":["Courier New","Droid Sans Mono"],
    "Handwritten":["Angelina","Beautiful ES","BlackJack","CAC Champagne","Chopin",
        "Comic Sans","Daniel","Forelle","Freebooter","Honey Script","Journal",
        "Marketing Script","Note this","Rabiohead","Reenie Beanie","Saginaw",
        "Tangerine","Windsong"],
    "Bold Block":["Bebas","DayPosterBlack","Distant Galaxy","Forque",
        "Impact","Minotaur"],
    "Decorative":["Amadeus","Aquiline","Capture it","Flux","Junkos Typewriter",
        "Kingthings Calligraphica","Komika Axis","Lobster","Louisianne",
        "NeoRetroDraw","Riesling","SeasideResort","Snickles",
        "Universal fruitcake","Vanilla","Virgo 01"]
    };



function getFontDropdownRow(i) {
    if (i == 0) {
        return ['', '<span style="">Default</span>'];
    }else{
        var fontName = flattenedFontGroups[i-1];
        if (fontName) {
            var groupStart;
            if (typeof fontName == 'object') { // array
                groupStart = fontName[1];
                fontName = fontName[0];
            }
            var font = fonts[fontName]; // don't need to use getFont b/c we know it's exact
            if (font) {
                var rowInfo;
                if (font.system) {
                    rowInfo = [
                        font.system,
                        '<span style="padding-left:2px;font-family:' + font.system + '">' + fontName + '</span>'
                    ];
                }else{
                    rowInfo = [
                        "'" + fontName + "'",
                        "<img src='" + getFontPreview(fontName) + "' />"
                    ];
                }
                if (groupStart) {
                    // if a 3rd item is specified, prepended before the dropdown row
                    rowInfo.push(
                        new Element('div', { 'class': 'font-group-heading' }).update(groupStart)
                    );
                }
                return rowInfo;
            }
        }
    }
}

var flattenedFontGroups = [];
$H(fontGroups).each(function(pair) {
    var n = pair[0];
    var a = pair[1];
    if (a.length) {
        flattenedFontGroups.push([a[0], n]);
        for (i=1; i<a.length; i++) {
            flattenedFontGroups.push(a[i]);
        }
    }
});

function getFont(fontName) {
    var res;
    fontName = stripFontName(fontName).toLowerCase();
    $H(fonts).each(function(pair) {
        if (fontName == stripFontName(pair[0]).toLowerCase()) {
            res = pair[1];
        }
    });
    return res;
}

function getFontPreview(fontName) {
    return '/weebly/fonts/' + stripFontName(fontName).replace(/\s+/g, '_') + '/preview.png';
}

function isExternalFont(name) {
    var f = getFont(name);
    return !f || !f.system;
    // if we remove a system font from the font_groups list, it will think it's external. bad. oh well
}

var externalFontsLoaded = {};

function loadExternalFont(name) {
    name = stripFontName(name);
    var url = '/weebly/fonts/' + name.replace(/ /g, '_') + '/font.css?2';
    if (!externalFontsLoaded[url]) {
        var e = new Element('div').update("<link rel='stylesheet' type='text/css' href='" + url + "'/>");
        $$('head')[0].insert(e.down());
        externalFontsLoaded[url] = true;
    }
}

function stripFontName(fontName) {
    return fontName.replace(/(^['"\s]*|['"\s]*$)/g, '');
}


function renderFontDropDown(){
    var dHTML='<options>'+'</options>';
    return dHTML
}



 


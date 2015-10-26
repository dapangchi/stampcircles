/**
 *  The Render object renders the form from a set of
 *  attribute values
 *  @toHTML
 *  @toText
 */
Render = function(){};
Render.prototype.html = function (type, attr, options) {
var ATTR = ['name', 'value', 'checked', 'disabled',
            'readonly', 'size', 'maxlength',
            'src', 'alt', 'usemap', 'ismap',
            'tabindex', 'accesskey', 'onfocus',
            'onselect', 'onchange', 'accept',
            'id', 'style', 'class'];
var ELEMENTS = ['input', 'textarea', 
                'form', 'label', 'button',
                'fieldset'
            ];
// This should be the strength of the routines
// that by simply adding types, provides they are
// plugged it any form and any widget will be rendered
// 
var customElements = ['country', 'fonts', 'flags', 'other',
                      'states'];
/**
  * Builds the attributes of a string
  *
  *
  */
function buildAttrString(attr) {
  var tempStr = '';
  for (var key in attr) {
    tempStr += key + ' = "' + attr[key] + '"  ';
  }
  return tempStr;
};
/** Renders elements that are self contained
 *  such as input etc, closed elements such
 *  as textarea are handled by control
 */
function renderElement (element, attrs) {
  var temp = '<' + element + ' type="text" value="sample" />';
  return temp;
};
// renders an element such as textarea
function renderControl (element, attrs) {
  return '<'+ element +'placeholder="This is a hint" >Sample</' + element + '>';
};

function renderForm (attrs){
  var tempS = buildAttrString(attrs);
  return '<form '+ tempS + '>';
};

function main(type){
  switch (type) {
    case 'form' :
      renderForm();
      break;
    case 'text':
    case 'email':
    case 'other':
      log(renderElement());
    break;
    case 'textarea':
    case 'button':
    case 'label':
      log(renderControl());
    break;
    case 'meter':
      log('meter');
    default:
    //code to be executed if n is different
  }

// main program
// call main
// call render
// returns values
}

}//Render object

//render.toHTML('text', 'attr', 'options');
//render.toHTML('textarea', 'attr', 'options');
//render.toHTML('meter', 'attr', 'options');


/**
   *  frmDesigner
   *  parent object for creating forms programmatically
   *
   *
   */
frmDesigner = function (name) {
  this.name = name;
};

frmDesigner.prototype.form = function () {};

frmDesigner.prototype.form.data = {};
/**
 * Holds the HTML in an array of strings
 * top string <form>
 * fields     ....
 * bottom string  </form>
 * @top - top string
 * @bottom - bottom string
 */
frmDesigner.prototype.form.renderedData = function (){
  var htmlStrings = {
        top: '<form>',
        middle:'<input type = "text" value="sample" >',
        bottom:'</form>'
    }
  return this.htmlStrings;
};
/**
 * Stores, manipulates the form attributes
 * validates that the information is correct
 * creates and stores form top string
 * wraps innerhtml later on
 * @data key:value pairs with form attributes
 */
frmDesigner.prototype.form.attr = function (data){

};

frmDesigner.prototype.form.addData = function (data) {
  return this.data;
}
frmDesigner.prototype.form.fieldset = function () {};
// This is the highlevel getters and
// setters for the form rendering
frmDesigner.prototype.form.fieldset.add = function (data) {
  for (var i in data) {
    var aName = data[i].name;
    aValue = data[i].value;
    aType = data[i].type;
    log(aName);
    if (aType.toLowerCase() == 'text') log('INPUT FIELD');
    if (aType.toLowerCase() == 'textarea') log('TEXTAREA');
  }
}

var options = {
  'type': 'form',
  'attr': {
    'name': 'firstName',
    'type': 'text',
    'value': 'Yiannis',
    'action': 'enctype'
  },
  'actions': 'onclick'
};

var data = [{
  'name': 'firstName',
  'type': 'text',
  'value': 'Yiannis'
},
{
  'name': 'secondName',
  'type': 'text',
  'value': 'Lazarides'
},
{
  'name': 'address',
  'type': 'textarea'
}

];
var d = new frmDesigner('New Form');
    d.form.attr(options);
    d.form.fieldset.add(data);


function getAttribute(key, value){
  var s = value;
  var htmlAttributes = {
                   'accesskey':'accesskey="%s" ',
                   'name':'name ="'+s+'" ',
                   'id':'id="'+s+'" ',
                   'class':'class="'+s+'" ',
                   'value':'value="'+s+'" ',
                   'checked':'checked="%s" ',
                   'disabled':'disabled ',
                   'readonly':'readonly ',
                   'maxlength':s,
                   'alt':'alt="'+s+'" ',
                   'usemap':'',
                   'ismap':'',
                   'accept':'accept',
                   'submit':'type="submit"',
                   'reset':'reset',
                   'file':'',
                   'hidden':'hidden',
                   'image':'',
                   'label':'',
                   'size':'size="%s" ',
                   'style':'style="%s" ',
                   'title':'title="%s" ',
                   'onclick':'onclick="%s;" ',
                   'onfocus':'onfocus="%s;" ',
                   'onblur':'onblur="%s;" ',
                   'onkeypress':'onkeypress="%s;" ',
                   'onkeyup':'onkeyup="%s;" ',
                   'onchange':'onchange="%s;" ',
                   'ondblclick':'ondblclick="%s;" ',
                   'onselect':'onselect="'+s+'"',
                   'src':'src="'+s+'" ',
                   'tabindex':'tabindex="'+s+'" ',
                   'button':'<button %s>%s </button>',
                   'rows':'rows="'+s+'" ',
                   'cols':'cols="'+s+'" ',
                   'textarea':'<%s  %s>%s </%s>',
                   'select':'<%s  %s>%s </%s>',
                   'type':'type="%s" ',
                   'email':'',
                   'tel':'',
                   'url':'',
                   'search':'',
                   'color':'',
                   'number':'',
                   'range':'',
                   'date':'',
                   'month':'',
                   'week':'',
                   'time':'',
                   'for':''
               };
    return htmlAttributes[key];
}

/* API is as follows
 * form.attr()  - defaults for form options
 *                action urls and the like
 * form.adddata() - adds data can be more than one line
 * form.render()  - final form in rendered form
 */













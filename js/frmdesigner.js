/**
 *  frmDesigner
 *  parent object for creating forms programmatically
 *
*/

frmDesigner = function (name) {
    this.name = name;
};


/* Renders form components and other HTML elements
 * After form is rendered it can be saved in a template
 * via AJAX or cached on the page
 * it is preferable to save it and then work from the
 * template, if complicated forms so they can be edited
 * this is a helper function, it is not meant to be comprehensive
 */

var render = {};
render.toHTML = function (type, attr, data, options) {

    var ATTR = ['name', 'value', 'checked', 'disabled',
    'readonly', 'size', 'maxlength',
    'src', 'alt', 'usemap', 'ismap',
    'tabindex', 'accesskey', 'onfocus',
    'onselect', 'onchange', 'accept', 'id',
    'style', 'class', 'title'],

    ELEMENTS = ['input', 'textarea', 'form', 'select', 'button'],

    CUSTOM = ['country', 'font', 'flags', 'other'],

    componentStore = [];


    // library functions wraps content in a element

    function wrap(element, x, attrString){
        var htmlFragment =  '<' + element + ' ' + attrString +'>' + x + '</' + element + '>';
        return htmlFragment;
    }

    // wraps a single element <input type=..... />
    // 
    function wrapSingle(element, attrString){
        var htmlFragment =  '<' + element + ' ' + attrString +'/>';
        return htmlFragment;
    }
    //attributes are sent via an array
    // of objects
    // {id:nnnn,selected:'selected',}
    // according to W3C selected is only one word not selcted = 'true'
    // etc. Need to research it.
    // some have to be inserted automatically

    function attributeString(obj){
        var s = '';
        for (var property in obj)  {
            if (property === obj[property]){ //handles one word attributes
                s += property + ' ';
            } else {
                s += property + '= "' + obj[property] + '"  ';
            };
        }
        return s;
    }

    // if control has a label element we
    // draw it automatically
    function renderLabel (type, attr, data){
       var attributes = attr;
           attributes['type'] = 'label';

    };

    function makeSelect(arr){
        var i, s ='';
        for (i=0; i < arr.length; i++) {
            s += wrap('option', arr[i]);
        };
        s += wrap('select',s);
        s = '<label style="width:30px;font-size:15px;line-height:10px;display:block:float:left">test</label>' +s;
        return s;
    }


    var renderInput = function (type, attr, data) {
        var attributes = attr;
            attributes['type'] = 'text';
        var s = attributeString(attributes);
            s = wrap('input', data, s);
        return s.entityify();
    };


    var renderTextarea = function () {
        return '<textarea placeholder="This is a hint" ><textarea>';
    }
    var meter = '<meter value="0.85">Moderate Activity</meter>';
    switch (type) {
        case 'text':
             log(renderInput('text', attr, ''));
             componentStore.push(renderInput('text', attr, ''));
             break;
        case 'email':
             break;
        case 'select':
            log(makeSelect(['Greece','Qatar','Cyprus',
                'South Africa','UAE','Libya',
                'United Kingdom','China',
                'Netherlands']));
            break;
        case 'other':
            log(renderInput(attr, data));
            break;
        case 'textarea':
            log(renderTextarea());
            break;
        case 'button':
        case 'meter':
            log(meter);
        default: '';
            break;
     }

};

var attr = {
    id : 'someID',
    value : '12567',
    'class' : 'special',
    disabled : 'disabled',
    required : 'true',  // non-standard attributes you can add your own
    before: '',         // as well
    after: '',
    left : '',
    bottom:'',
    right:''
};

render.toHTML('select', 'attr', '', 'options');
render.toHTML('text', attr, '', 'options');
render.toHTML('textarea', '', 'attr', 'options');
render.toHTML('meter', 'attr', '', 'options');

var zz = $('#someID').parent().html();

log(zz.entityify());




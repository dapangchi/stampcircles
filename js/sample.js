
/**
 *   Project related components
 */
function Project (obj){
// defaults are used to highlight
// missing info and for testing
 var defaults = {
   number : 'HS-118',
   name : 'City Center Phase III',
   location:'Doha, Qatar',
   description: 'Lorem ipsum dolor sit amet, consectetuer ...',
   team : {},
   divisions : {},
   prefix: 'project',
   view:'/CodeIgniter/data/tabpane.html'
  }
 
 this.settings = {};

 // extend object
 for (var prop in defaults){
  if (defaults.hasOwnProperty(prop)){
    this.settings[prop]=defaults[prop];
    if (obj!==undefined && obj[prop]!==undefined){this.settings[prop]=obj[prop];};
  }
 }


 this.get = function (){
   // gets values from server
 }

 this.save = function (){
  // saves values to server
 }

this.populate = function (){
 var tempS = '';
 for (var prop in this.settings){
   tempS ='#'+this.settings.prefix + prop.capitalize();
   $(tempS).val(this.settings[prop]);
 }
}

this.view = function (url,callback){
  $('#pane').load(url,callback);
};

};

// set some option parameters
// 
var options = {
 name : 'North Gate Development',
 number: 'HS-126',
}
// create new project
project = new Project(options);

//log(project.settings.name);
//log(project.settings.number);

project.settings.number='HS-226';
project.view(project.settings.view, function(){project.populate()});
//log(project.settings.view)
$('#code1').val(z);

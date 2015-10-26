
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
   filename:'project.js', //persistent storage for changes
   view:'/CodeIgniter/data/tabpane.html'
  }
 
 this.settings = {};

 // extend object
 for (var prop in defaults){
  if (defaults.hasOwnProperty(prop)){
    this.settings[prop]=defaults[prop];
    if (obj!==undefined 
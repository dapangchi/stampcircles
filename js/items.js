
function Companies (){
  // Companies object from Company
  // 
}
/**
 *   stock related
 */
function Stock (obj){
// defaults are used to highlight
// missing info and for testing


 var defaults = {
   version : '1.0',
   stockID : 'HS-118',
   description : 'first name',
   longDescription : 'long description ...',
   barCode : '6130413567892',
   units : 'each',
   eOrderQuantity: 10, //economic order quantity
   mbflag : 1,
   lastCurrentCost: 0,
   materialCost : 0,
   labourCost:0,
   overheadCost:0,
   lowestLevel:0,
   discontinued: false,
   controlled: false,
   discountCategory: 1,
   taxcatID: 0,
   serialized:false,
   file: 'filename',
   perishable: -1,
   decimalPlaces: 2,
   hasAccessories: true,
   notes: '..add some notes',
   safetyCategory: '',
   quality:{ hasQA:true,
             SUB: function(){},
             MS: function() {},
             MIR: function(){} ,
            },
   photo : '',  //path
   prefix: 'stock', //used for form fields
   filename:'items.js', //persistent storage for changes
   view:'/CodeIgniter/data/items.html?'+goog.now()+'',
 }
 
 this.settings = {};

 // extend object
 for (var prop in defaults){
  if (defaults.hasOwnProperty(prop)){
    this.settings[prop]=defaults[prop];
    if (obj!==undefined && obj[prop]!==undefined){this.settings[prop]=obj[prop];};
  }
}// end object



 

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
// create new stock
stock = new Stock(options);


stock.view(stock.settings.view, function(){
 ('#pane').appendTo('#test').animate({'height':'100px'}).animate({'height':'1450px'}).animate({
scrollTop: $("body").offset().top
}, 2000);
});

$('#code1').val(z);
$('#filename').val(stock.settings.filename);
 
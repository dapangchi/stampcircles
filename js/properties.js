function HE(temperature, units) {
  var TK = 0;
  var rho = 0;
  var mu = 0;
  var nu = 0;
  var cp = 0;
  var kf = 0;
  var Pr = 0;
  var test;
  var alpha = 0;
  var beta = 0;
  var Temp = 0;
  var TK25 = 0;
  var TK20 = 0;
  var TK15 = 0;
  var TK05 = 0;
  Temp = temperature; //Unit=document.air.units.selectedIndex;
  UnitVal = 'C'; //document.air.units.options[Unit].value;
  // If Farenheit, convert to SI
  if (UnitVal == "F") {
    Temp = (Temp - 32) * 5 / 9;
  } else {
    Temp = Temp * 1.0;
  } // Calculate all values in SI 
  TK = Temp + 273.15;
  test = Range(200, 400, TK);
  if (test == false) TK = 20 + 273.15; // ***************************************
  // Correlation here!
  // ***************************************
  TK05 = Math.pow(TK, 0.5);
  TK15 = TK05 * TK;
  TK20 = TK * TK;
  TK25 = TK15 * TK;
  rho = 48.814 / TK + 19.533 / TK20;
  mu = 0.36932 * Math.pow(TK, 0.69879) * 1e-6;
  nu = mu / rho; // Cp=5/2 R/M (monatomic gas, translational energy only)
  cp = 5193.1;
  kf = -7.78e-3 + 8.8343e-4 * TK - 1.6552e-6 * TK20 + 1.5443e-9 * TK20 * TK; // Do not change stuff below
  Pr = cp * mu / kf;
  alpha = nu / Pr; // Slightly better accuracy by using below:
  alpha = -2.6439e-5 + 4.0054e-7 * TK + 9.3348e-10 * TK20;
  beta = 1 / TK; // Convert results back to Brit ? 
  if (UnitVal == "F") {
    rho *= 0.06243;
    mu *= 2419.1;
    nu = mu / Rho;
    cp *= 0.2388 / 1000;
    kf *= 0.5782;
    alpha = nu / Pr;
    beta = 1 / ((Temp - 32) * 5 / 9 + 459.67);
  }
  var results = {};
  results = {
    rho: rho,
    mu: mu,
    nu: nu,
    cp: cp,
    kf: kf,
    Pr: Pr,
    alpha: alpha,
    beta: beta
  };
  return results;
} // outputs result


function N2(temperature,units) {
  var TK=0;
  var rho=0;
  var mu=0;
  var nu=0;
  var cp=0;
  var kf=0;
  var test;
  var Pr=0;
  var alpha=0;
  var beta=0;
  var Temp=0;
  var TK25=0;
  var TK20=0;
  var TK15=0;
  var TK05=0;
  Temp=temperature;
  UnitVal= 'C';
  // If Farenheit, convert to SI
  if (UnitVal=="F") {
     Temp=(Temp-32)*5/9;
  }
  else {
     Temp=Temp*1.0;
  }
  // Calculate all values in SI 
  TK=Temp+273.15;
  test = Range(200,400,TK);
  if (test == false)
	TK = 20+273.15;
 
// ***************************************
// Correlation here!
// ***************************************
  TK05=Math.pow(TK,0.5);
  TK15=TK05*TK;
  TK20=TK*TK;
  TK25=TK15*TK;
  rho=340.47/TK+314.25/TK20;
  mu=(1.4153*TK15)/(111.61+TK)*1e-6;
  nu=mu/rho;
  cp=1063.6-0.15783*TK+2.7622e-4*TK20;
  kf=-6.5326e-4+1.0606e-4*TK-5.7830e-8*TK20;
 
 
// Do not change stuff below
  Pr=cp*mu/kf;
  alpha=nu/Pr;
// Slightly better accuracy by using below:
  alpha=2.0410e-6-2.5939e-8*TK+3.8951e-10*TK20-2.7423e-13*TK20*TK;
  beta=1/TK;
 
    // Convert results back to Brit ? 
  if (UnitVal=="F") {
     rho*=0.06243;
     mu*=2419.1;
     nu=mu/rho;
     cp*=0.2388/1000;
     kf*=0.5782;
     alpha=nu/Pr;
     beta=1/((Temp-32)*5/9+459.67);
  }
  
  var results = {};
  results = {
    rho: rho,
    mu: mu,
    nu: nu,
    cp: cp,
    kf: kf,
    Pr: Pr,
    alpha: alpha,
    beta: beta
  };
  return results;
}



// glycol.js


// co2.js

function CO2(temperature,units) {
  var TK=0;
  var rho=0;
  var mu=0;
  var nu=0;
  var cp=0;
  var test;
  var kf=0;
  var Pr=0;
  var alpha=0;
  var beta=0;
  var Temp=0;
  var TK25=0;
  var TK20=0;
  var TK15=0;
  var TK05=0;
  Temp= temperature;
  //Unit=document.air.units.selectedIndex;
  UnitVal='C';
  // If Farenheit, convert to SI
  if (UnitVal=="F") {
     Temp=(Temp-32)*5/9;
  }
  else {
     Temp=Temp*1.0;
  }
  // Calculate all values in SI
  TK=Temp+273.15;
  test = Range(273.2,573.2,TK);
  if (test == false)
	TK = 20+273.15;

// ***************************************
// Correlation here!
// ***************************************
  TK05=Math.pow(TK,0.5);
  TK15=TK05*TK;
  TK20=TK*TK;
  TK25=TK15*TK;
  rho=9.08765-0.638091*TK05+0.0124355*TK;
  mu=8.18801e-3+1.09054e-3*TK05-8.21403e-6*TK;
  mu=Math.pow(mu,3);
  nu=mu/Rho;
  cp=22.0999+59.6828*TK05-0.678364*TK;
  kf=-2.02535e-3-4.85225e-4*TK05+9.05949e-5*TK;


// Do not change stuff below
  Pr=cp*mu/kf;
  alpha=nu/Pr;
  beta=1/TK;

  // Convert results back to Brit ?
  if (UnitVal=="F") {
     rho*=0.06243;
     mu*=2419.1;
     nu=mu/rho;
     cp*=0.2388/1000;
     kf*=0.5782;
     alpha=nu/Pr;
     beta=1/((Temp-32)*5/9+459.67);
  }
  var results = {};
  results = {
    rho: rho,
    mu: mu,
    nu: nu,
    cp: cp,
    kf: kf,
    Pr: Pr,
    alpha: alpha,
    beta: beta
  };
  return results;

}


function AR(temperature,units) {
  var TK=0;
  var rho=0;
  var mu=0;
  var nu=0;
  var cp=0;
  var kf=0;
  var test;
  var Pr=0;
  var alpha=0;
  var beta=0;
  var Temp=0;
  var TK25=0;
  var TK20=0;
  var TK15=0;
  var TK05=0;
  Temp=temperature;
  //Unit=document.air.units.selectedIndex;
  UnitVal='C';
  // If Farenheit, convert to SI
  if (UnitVal=="F") {
     Temp=(Temp-32)*5/9;
  }
  else {
     Temp=Temp*1.0;
  }
  // Calculate all values in SI
  TK=Temp+273.15;
  test = Range(200,400,TK);
  if (test == false)
	TK = 20+273.15;

// ***************************************
// Correlation here!
// ***************************************
  TK05=Math.pow(TK,0.5);
  TK15=TK05*TK;
  TK20=TK*TK;
  TK25=TK15*TK;
  rho=485.33/TK+525.52/TK20;
  mu=(1.9263*TK15)/(140.54+TK)*1e-6;
  nu=mu/rho;
  cp=531.63-5.5815e-2*TK+7.3878e-5*TK20;
  kf=(1.5359e-3*TK15)/(150.12+TK);


// Do not change stuff below
  Pr=cp*mu/kf;
  alpha=nu/Pr;
// Slightly better accuracy by using below:
  alpha=1.2280e-6-1.5062e-8*TK+3.2629e-10*TK20-1.9055e-13*TK20*TK;
  beta=1/TK;


  // Convert results back to Brit ?
  if (UnitVal=="F") {
     rho*=0.06243;
     mu*=2419.1;
     nu=mu/rho;
     cp*=0.2388/1000;
     kf*=0.5782;
     alpha=nu/Pr;
     beta=1/((Temp-32)*5/9+459.67);
  }


}


/*  function currencyFormat()
      fld = input value
      milSel (thousands separator)
      decSep (decimals separator)
 */
var defaults = {
  name: "formatCurrency",
  colorize: false,
  region: '',
  global: true,
  decimalSymbol: ',',
  digitGroupSymbol: ',',
  groupDigits: true,
  currencySymbol: '$'
};
var currency = function (fld, options) {
  if (! (this instanceof arguments.callee)) {
    return new currency(fld, options);
  }
  this.value = fld;
  this.options = options;
  this.currencyString = currencyFormat(fld, options);
  this.alert = function () {
    alert(this.currencyString);
  }
};
var t = currency('507890', defaults).alert();
var z = currency('90088', defaults).alert();
function isValidNumber(numval) {
  if (numval == "") {
    return false;
  }
  var myRegExp = new RegExp("^[/+|/-]?[0-9]*[/.]?[0-9]*$");
  return myRegExp.test(numval);
}
function currencyFormat(fld, options) {
  var sep = 0;
  var key = '';
  var len = 0;
  fld = fld.replace(/(\,|\s)/g, ''); // test if now is valid number
  if (!isValidNumber(fld)) return fld + ' ... not valid number';
  var strCheck = '0123456789';
  var aux = aux2 = '';
  len = fld.length;
  var counter = 0;
  var separator = "";
  var final = '';
  var aux3 = '';
  for (var i = len - 1; i > -1; i--) {
    aux = fld[i] + aux; //fetches three
    if (counter == 2 && fld[i] != ',') {
      separator = '';
      if (i !== 0) separator = options.digitGroupSymbol; //skips if at beginning of string
      counter = 0;
      aux2 = separator + aux;
      aux = '';
      aux3 = '';
    } else { if (fld[i] != ',') counter = counter + 1;
      aux3 = fld[i] + aux3;
    }
    final = aux2 + final;
    aux2 = '';
  }
  final = aux3 + aux2 + final;
  log('new field', final);
  return final;
}
$("#test").blur(function () {
  var c = $(this).val();
  var char = c.charAt(c.length - 1);
  $(this).val(currencyFormat(c, defaults));
  return false;
});
$("#myform").submit(function () {
  var c = $("#test").val();
  var char = c.charAt(c.length - 1);
  $("#test").val(currencyFormat(c, defaults));
  return false;
}); //
var n = 170.00;
var nString = String(n);
log('nString ', nString);
log(n.toString(2));
var n1 = BigInteger("1234567889900000007765").multiply("49876543190");
var z = n1.toString();
log(typeof n1);
log(z);

















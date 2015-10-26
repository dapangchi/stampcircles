/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
<!-- This script has been in the http://www.javascripts.com Javascript Public Library! -->
<!-- Note that though this material may have been in a public depository, certain author copyright restrictions may apply. -->

<!-- hide from other browsers

/*********************************************************
Copyright June 1997, by G. Reza Zakeri.  All Rights Reserved.
You may use, modify or copy this Script for non-commercial use,
as long as the copyright notice above is included in your
script.
*********************************************************/

var SIunit=true;
//var WetBulb=true;
//var RelHumid=false;
var Buffer, PrevBuffer;
var Buffer_dp;
var Buffer_db;
var Buffer_wb;
var Buffer_alt;
var Buffer_rh;

function disclaim() {
 alert("No warranties are given, expressed or implied \n"+
       "that this program is free of error, or is consistent \n"+
       "with any particular standard of merchantibility. \n"+
       "All liability is disclaimed for direct or consequential \n"+
       "damages resulting from use of this script. \n"+
       "\t Use it at your own risk!  ");
}

function copyright() {
  alert("Copyright July 1997, by G. Reza Zakeri. All Rights Reserved.\n"+
       "You may use, modify or copy this Script for non-commercial use,\n"+
       "as long as the copyright notice above is included in your script.\n"+
       "\t \t     ");
}


function Screen_Units() {
 if (document.inputform.unit[1].checked==true){
    SIunit=false;
    document.inputform.db_Unit.value="F";
    document.inputform.wb_Unit.value="F";
    document.inputform.alt_Unit.value="Ft";
    document.outputform.atm_Unit.value="In.Hg";
    document.outputform.svp_Unit.value="In.Hg";
    document.outputform.vp_Unit.value="In.Hg";
    document.inputform.dp_Unit.value="F";
    document.outputform.hr_Unit.value="lb/lb";
    document.outputform.ent_Unit.value="Btu/lb";
    document.outputform.sp_Unit.value="Ft3/lb";
    document.inputform.db.value=document.inputform.db.value*9/5+32;
    document.inputform.wb.value=document.inputform.wb.value*9/5+32;
    document.inputform.dp_temp.value=document.inputform.dp_temp.value*9/5+32;
    document.inputform.Altitude.value=document.inputform.Altitude.value/0.3048;

     }
 else {
    SIunit=true;
    with (document.inputform) {
      db_Unit.value="C";
      wb_Unit.value="C";
      alt_Unit.value="m";
      db.value=5/9*(db.value-32);
      wb.value=5/9*(wb.value-32);
      dp_temp.value=5/9*(dp_temp.value-32);
      dp_Unit.value="C";
      Altitude.value=Altitude.value*0.3048;}
    with (document.outputform) {
      atm_Unit.value="bar";
      svp_Unit.value="mbar";
      vp_Unit.value="mbar";
      hr_Unit.value="kg/kg";
      ent_Unit.value="kJ/kg";
      sp_Unit.value="m3/kg";}
   }
initiate();
document.inputform.db.focus();
//document.inputform.db.select();
}


function messagebar(message) {
 self.status=message;
 return true;
}


/************************************************
 Calculate Atmospheric pressure given elevation
*************************************************/
//100
function psychro_atm(elev) {
var i = 0;
var el = new Array();
var press = new Array();
var psychro_atm;
//100
    el[0] = -1000;  press[0] = 31.02;
    el[1] = -500;   press[1] = 30.47;
    el[2] = 0;      press[2] = 29.921;
    el[3] = 500;    press[3] = 29.38;
    el[4] = 1000;   press[4] = 28.86;
    el[5] = 2000;   press[5] = 27.82;
    el[6] = 3000;   press[6] = 26.82;
    el[7] = 4000;   press[7] = 25.82;
    el[8] = 5000;   press[8] = 24.9;
    el[9] = 6000;   press[9] = 23.98;
    el[10] = 7000;  press[10] = 23.09;
    el[11] = 8000;  press[11] = 22.22;
    el[12] = 9000;  press[12] = 21.39;
    el[13] = 10000; press[13] = 20.48;
    el[14] = 15000; press[14] = 16.89;
    el[15] = 20000; press[15] = 13.76;
    el[16] = 30000; press[16] = 8.9;
    el[17] = 40000; press[17] = 5.56;
    el[18] = 50000; press[18] = 3.44;
    el[19] = 60000; press[19] = 2.14;

    while (elev > el[i])
        i++
    if (elev==el[i])
      psychro_atm=press[i];
    else
      psychro_atm=(press[i]+(press[i+1]-press[i])/(el[i+1]-el[i])*(elev-el[i]));
return psychro_atm;
}

/*********************************************************
 Calculate vapor pressure at saturation given temperature.
**********************************************************/

function psychro_pvs(temp) {
var psychro_pvs;
var z;
  a1 = -1.021416462e4;
  a2 = -4.89350301;
  a3 = -5.37657944e-3;
  a4 = 1.92023769e-7;
  a5 = 3.55758316e-10;
  a6 = -9.03446886e-14;
  a7 = 4.1635019;
  a8 = -1.044039708e4;
  a9 = -1.12946496e1;
  a10 = -2.7022355e-2;
  a11 = 1.289036e-5;
  a12 = -2.478068e-9;
  a13 = 6.5459673;
var  t = (temp + 459.67);
  if (temp < 32) {
   with (Math) {
    psychro_pvs = exp( a1/t+a2+a3*t+a4*pow(t,2)
           +a5*pow(t,3)+a6*pow(t,4)+a7*log(t));
      }
    }
  else {
   with (Math) {
    psychro_pvs = exp( a8/t+a9+a10*t+a11*pow(t,2)
           +a12*pow(t,3)+a13*log(t));
   }
  }
return (psychro_pvs*2.036021);
}



/**************************************************************************
 Calculate Vapor Pressure given dry bulb temp, wet bulb temp, and pressure
***************************************************************************/

function psychro_pv1(db, wb, atm) {
var psychro_pv1;
var hl,ch,wh;
var pvp =  psychro_pvs(wb);
var ws = (pvp / (parseFloat(atm) - pvp)) * 0.62198;
 if (wb <= 32) {
   wh=((1219.98+0.44*db-0.49*wb)*ws-0.24*(db-wb))/
      (1219.98+0.44*db-0.49*wb);
   psychro_pv1 = parseFloat(atm) * (wh / (0.62198 + wh));
    }
 else {
   wh=((1093-0.556*wb)*ws-0.24*(db-wb))/
      (1093+0.444*db-wb);
   psychro_pv1 = parseFloat(atm) * (wh / (0.62198 + wh));
  }
return psychro_pv1;

}  //200

/***********************************************
Calculate dew point temp. given Vapor Pressure
************************************************/

function psychro_dp(pvp) {
var  psychro_dp;
var  y = Math.log(pvp*0.491154);
  if (pvp < 0.18036)
    psychro_dp = 90.12 + (26.142 * y) + (0.8927 * y * y);
  else
    psychro_dp = 100.45 + (33.193 * y) + (2.319 * y * y)
    +0.17074*Math.pow(y,3)+1.2063*Math.pow((pvp*0.491154),0.1984);
return psychro_dp;
}

/***************************************************************************
Calculate Humidity Ratio given dry bulb temp, wet bulb temp, and pressure
***************************************************************************/

function psychro_w(db, wb, atm) {
var psychro_w;
var vp = psychro_pv1(db, wb, parseFloat(atm));
  psychro_w = 0.622 * vp / (parseFloat(atm) - vp);
  return psychro_w;
}


/***************************************************************************
Calculate Humidity Ratio given dry bulb temp, wet bulb temp, and pressure
***************************************************************************/

function psychro_w_pvp(pair, pvp) {
var psychro_w_pvp;
  psychro_w_pvp = 0.622 * pvp / pair;
  return psychro_w_pvp;
}


/*********************************************************************
Calculate Enthalpy given dry bulb temp, wet bulb temp, and pressure
*********************************************************************/

function psychro_h(db, wb, atm) {
var psychro_h;
 psychro_h = (db * 0.24) + ((1061 + (0.444 * db)) *
             (psychro_w(db, wb, atm)));
 return psychro_h;
}


/*********************************************************************
Calculate Enthalpy given dry bulb temp and Humidity Ratio
*********************************************************************/

function psychro_h_w(db, w) {
var psychro_h_w;
 psychro_h_w = (db * 0.24) + (1061 + (0.444 * db))
               * w;
 return psychro_h_w;
}



/******************************************************************************
Calculate relative humidity given dry bulb temp, wet bulb temp, and pressure
******************************************************************************/

function psychro_rh(db, wb, atm) {
var psychro_rh;
if (Buffer_db != Buffer_wb) {
  psychro_rh = 100 * psychro_pv1(db, wb, atm) /
                psychro_pvs(db);}
else
  psychro_rh = 100;
  return psychro_rh;
}


/*****************************************************************************
Calculate Specific Volume given dry bulb temp, wet bulb temp, and pressure
*****************************************************************************/

function psychro_v(db, wb, atm) {
var psychro_v;
  psychro_v = ((0.754 * (db + 459.7)* (1 + (7000 *
       psychro_w(db, wb, atm) / 4360))) / atm);
  return psychro_v;
}


/****************************************

*****************************************/
function f_wratio(db,wb,wstar) {
var f_wratio;
var wh;
if (wb <= 32) {
   wh=((1219.98+0.44*db-0.49*wb)*wstar-0.24*(db-wb))/
      (1219.98+0.44*db-0.49*wb);}
 else {
   wh=((1093-0.556*wb)*wstar-0.24*(db-wb))/
      (1093+0.444*db-wb);}
f_wratio=wh;
return f_wratio;
}



/***********************************************************
Computes wet-bulb temperature iteratively, dry bulb, dew point
enthalpy and atm pressure using Bisection method.
************************************************************/

function wet_bulb(db,dp,h,atm) {
var wet_bulb;
var psat,wstar;
var dx,fmid,xmid,rtb;
var j=1;
var acc=0.0001;

rtb=dp;
dx=db-dp;
for (j=1;j<40;j++) {
  dx=dx*0.5;
  xmid=rtb+dx;
  psat=psychro_pvs(xmid);
  wstar=psychro_w_pvp((atm-psat), psat);
  fmid=psychro_h_w(xmid, wstar);
  if ((h-fmid)>0.0)
     rtb=xmid;
  if (Math.abs(dx)<acc)
    break;
   }
wet_bulb=rtb;
return wet_bulb;
}


/**********************************************
Compute other properties given Dry Bulb and wet
bulb Temp. and Altitude.
***********************************************/


function Calculate_DWA() {

 with (document.inputform) {
   if (SIunit) {
      Buffer_db=db.value*9/5+32;
      Buffer_wb=wb.value*9/5+32;
      Buffer_alt=Altitude.value/0.3048;
       }
      else {
      Buffer_db=db.value*1;
      Buffer_wb=wb.value*1;
      Buffer_alt=Altitude.value*1;
        }
      }

   Buffer=psychro_atm(Buffer_alt);
    if (SIunit)
     document.outputform.atm_press.value=(Buffer*3386.38/1e5).toFixed(4);
    else
     document.outputform.atm_press.value=Buffer.toFixed(4);

   Buffer=psychro_pvs(Buffer_db);
   PrevBuffer=Buffer;
   if (SIunit)
     Buffer=Buffer*33.8638;
   document.outputform.sat_vp.value=Buffer.toFixed(4);

// Call (psychro_w) to calculate Humidity Ratio.
   document.outputform.hum_ratio.value=
        psychro_w(Buffer_db, Buffer_wb, psychro_atm(Buffer_alt)).toFixed(4);

// Call (psychro_rh) to calculate Relative Humidity.
   document.inputform.Relat_hum.value=
        psychro_rh(Buffer_db, Buffer_wb, psychro_atm(Buffer_alt)).toFixed(4);


// Call (psychro_pv1) to calculate Partial Vapor Pressure.
   Buffer=psychro_pv1(Buffer_db, Buffer_wb, psychro_atm(Buffer_alt));
    if (SIunit)
     document.outputform.vap_press.value=(Buffer*3386.38/1e2).toFixed(4);
    else
     document.outputform.vap_press.value=Buffer.toFixed(4);

// Call (psychro_dp) to calculate Dew Point.
    Buffer=psychro_dp(Buffer);
    if (SIunit)
      Buffer=(Buffer-32)*5/9;
    document.inputform.dp_temp.value=Buffer.toFixed(4);

// Call (psychro_h) to calculate Enthalpy.
    Buffer=psychro_h(Buffer_db, Buffer_wb, psychro_atm(Buffer_alt));
    if (SIunit)
       Buffer=Buffer*2.3244-17.8125;
    document.outputform.enthalpy.value=Buffer.toFixed(4);

// Call (psychro_v) to calculate Specific Volume.
    Buffer=psychro_v(Buffer_db, Buffer_wb, psychro_atm(Buffer_alt));
    if (SIunit)
       Buffer=Buffer*0.062391;
    document.outputform.spec_vol.value=Buffer.toFixed(4);

}


/**********************************************
Compute other properties given Dry Bulb Temp.,
Relative Humidity and Altitude.
***********************************************/

//350
function Calculate_DRHA() {
 var ws,w,wb,atm,rh;
 var dp,h;
 var pvs,pvp;

 with (document.inputform) {
   if (SIunit) {
      Buffer_db=db.value*9/5+32;
      Buffer_alt=Altitude.value/0.3048;
       }
      else {
      Buffer_db=db.value*1;
      Buffer_alt=Altitude.value*1;
        }
      }
   Buffer_rh=document.inputform.Relat_hum.value/100;
   atm=psychro_atm(Buffer_alt);
   Buffer=atm;
    if (SIunit)
     document.outputform.atm_press.value=(Buffer*3386.38/1e5).toFixed(4);
    else
     document.outputform.atm_press.value=Buffer.toFixed(4);

   pvs=psychro_pvs(Buffer_db);
   Buffer=pvs;
   if (SIunit)
     Buffer=Buffer*33.8638;
   document.outputform.sat_vp.value=Buffer.toFixed(4);

// Calculate Partial Vapor Pressure.
   pvp=pvs*Buffer_rh;
    if (SIunit)
     document.outputform.vap_press.value=(pvp*3386.38/1e2).toFixed(4);
    else
     document.outputform.vap_press.value=pvp.toFixed(4);


// Calculate Humidity Ratio.
  // w=0.62198*(pvp/(atm-pvp));
   w=psychro_w_pvp((atm-pvp), pvp);
   document.outputform.hum_ratio.value=w.toFixed(4);

// Call (psychro_h_w) to calculate Enthalpy.
    Buffer=psychro_h_w(Buffer_db, w);
    h=Buffer;
    if (SIunit)
       Buffer=Buffer*2.3244-17.8125;
    document.outputform.enthalpy.value=Buffer.toFixed(4);



// Call (psychro_dp) to calculate Dew Point.
    dp=psychro_dp(pvp);
    Buffer=dp;
    if (SIunit)
      Buffer=(Buffer-32)*5/9;
    document.inputform.dp_temp.value=Buffer.toFixed(4);

//Calculate wet bulb temperature using an iterative method.
 if (Buffer_rh !=1){
   wb=wet_bulb(Buffer_db,dp,h,atm);
   Buffer_wb=wb;
     }
 else {
   wb=Buffer_db;
   }
    if (SIunit)
      wb=(wb-32)*5/9;
    document.inputform.wb.value=wb.toFixed(4);


// Call (psychro_v) to calculate Specific Volume.
    Buffer=psychro_v(Buffer_db, Buffer_wb, psychro_atm(Buffer_alt));
    if (SIunit)
       Buffer=Buffer*0.062391;
    document.outputform.spec_vol.value=Buffer.toFixed(4);

}


/**********************************************
Compute other properties given Dry Bulb Temp.,
Dew Point and Altitude.
***********************************************/

function Calculate_DDPA() {

 var ws,w,wb,atm,rh;
 var dp,h;
 var pvs,pvp;

 with (document.inputform) {
   if (SIunit) {
      Buffer_db=db.value*9/5+32;
      Buffer_dp=dp_temp.value*9/5+32;
      Buffer_alt=Altitude.value/0.3048;
       }
      else {
      Buffer_db=db.value*1;
      Buffer_dp=dp_temp.value*1;
      Buffer_alt=Altitude.value*1;
        }
      }
   pvp=psychro_pvs(Buffer_dp);
   Buffer=pvp;
   if (SIunit)
     Buffer=Buffer*33.8638;
   document.outputform.sat_vp.value=Buffer.toFixed(4);
   atm=psychro_atm(Buffer_alt);
   Buffer=atm;
    if (SIunit)
     document.outputform.atm_press.value=(Buffer*3386.38/1e5).toFixed(4);
    else
     document.outputform.atm_press.value=Buffer.toFixed(4);

// Call (psychro_w_pvp) to calculate Humidity Ratio.
   w=psychro_w_pvp((atm-pvp), pvp);
   document.outputform.hum_ratio.value=w.toFixed(4);

// Call (psychro_rh) to calculate Relative Humidity.
   Buffer_rh=pvp/psychro_pvs(Buffer_db)*100;
   document.inputform.Relat_hum.value=(Buffer_rh).toFixed(4)

// Call (psychro_h_w) to calculate Enthalpy.
    Buffer=psychro_h_w(Buffer_db, w);
    h=Buffer;
    if (SIunit)
       Buffer=Buffer*2.3244-17.8125;
    document.outputform.enthalpy.value=Buffer.toFixed(4);

//Calculate wet bulb temperature using an iterative method.
 if (Buffer_rh !=1){
   wb=wet_bulb(Buffer_db,Buffer_dp,h,atm);
   Buffer_wb=wb;
     }
 else {
   wb=Buffer_db;
   }
    if (SIunit)
      wb=(wb-32)*5/9;
    document.inputform.wb.value=wb.toFixed(4);

// Call (psychro_v) to calculate Specific Volume.
    Buffer=psychro_v(Buffer_db, wb, psychro_atm(Buffer_alt));
    if (SIunit)
       Buffer=Buffer*0.062391;
    document.outputform.spec_vol.value=Buffer.toFixed(4);


}



function initiate() {
    if (document.inputform.input_var[0].checked==true)
        Calculate_DWA();
    else {
      if (document.inputform.input_var[2].checked==true)
        Calculate_DDPA();
      else
        Calculate_DRHA();
      }


}




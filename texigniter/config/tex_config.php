<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Private settings for TeX Configuration*/
## choose the class and options here
## first we set options for the standard classes
$config['class']='tufte-book';
$config['options']='[10pt,justified,oneside,a4paper]';

## special hooks for macros used internally
if ($config['class']=='article'){
    $config['macrohook']= '\let\chapter\section'.
           '  \let\publisher\empty';

}
else {
    $config['macrohook']= "";
}

## coverpage and second page
$config['coverpage']='coverpage';
$config['secondpage']='secondpage';
$config['cover_image']='default-cover-image.jpg';
/*
 *  The default file for tex, contains the preamble for the file
 *
 */
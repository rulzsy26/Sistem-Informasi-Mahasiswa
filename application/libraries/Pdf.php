<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . '/third_party/fpdf184/fpdf.php';

class Pdf extends FPDF{
    public function __construct(){
        parent::__construct();
    }
    
}
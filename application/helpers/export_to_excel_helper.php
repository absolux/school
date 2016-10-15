<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// export to xls

function xlsBOF($filename) {
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
  header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");
  header("Content-Disposition: attachment;filename=" . $filename );
  header("Content-Transfer-Encoding: binary ");
  
  echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
  return;
}
 
function xlsEOF() {
  echo pack("ss", 0x0A, 0x00);
  return;
}

function xlsWriteNumber($Row, $Col, $Value) {
  echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
  echo pack("d", $Value);
  return;
}
 
function xlsWriteLabel($Row, $Col, $Value ) {
  $L = strlen($Value);
  echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
  echo $Value;
  return;
}

function xlsWriteHeader($header) {
  for ( $col = 0; $col < count($header); $col++ ) {
    xlsWriteLabel(0, $col, utf8_decode($header[$col]));
  }
}

function xlsWriteData($fields, $data) {
  for ( $row = 0; $row < count($data); $row++ ) {
    for ( $col = 0; $col < count($fields); $col++ ) {
      $value = $data[$row]->{$fields[$col]};
      
      xlsWriteLabel($row + 1, $col, utf8_decode($value));
    }
  }
}
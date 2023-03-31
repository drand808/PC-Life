<?php
session_start();

function addString($s1,$s2){
  return $s1.$s2;        
}

function getData($comp_type, $build_id){
  $conn = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");
  if($build_id!=0 && !isset($_SESSION[$comp_type."_id"])){
    $comp_type_id=$comp_type."_id";
    
    $build_comp_id=mysqli_query($conn, "select $comp_type_id from PCBUILDS where build_id=$build_id");
    $build_comp_id = mysqli_fetch_assoc($build_comp_id);
    $build_comp_id=$build_comp_id[$comp_type_id];
    
    $data = mysqli_query($conn, "SELECT * FROM $comp_type WHERE $comp_type_id=$build_comp_id");
    $data = mysqli_fetch_assoc($data);
    
    $comp_name = $data[addString($comp_type,"_name")];
    $comp_manufacturer = $data[addString($comp_type,"_manufacturer")];
    $comp_price = $data[addString($comp_type,"_price")];
    
    return array($comp_type, $comp_name,$comp_manufacturer,$comp_price);
  }
  
  if(!isset($_SESSION[$comp_type."_id"])){
    return array($comp_type, "","","");
  } else {
      $comp_type_id = $_SESSION[$comp_type."_id"];
      $data=mysqli_query($conn,"select * from $comp_type where ".addString($comp_type,"_id")." = $comp_type_id");
      $data = mysqli_fetch_assoc($data);
      
      $comp_name = $data[addString($comp_type,"_name")];
      $comp_manufacturer = $data[addString($comp_type,"_manufacturer")];
      $comp_price = $data[addString($comp_type,"_price")];
      return array($comp_type, $comp_name,$comp_manufacturer,$comp_price);
      }
}
?>
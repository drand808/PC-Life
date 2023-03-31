<?php
session_start();

function cat($s1,$s2){
  return $s1.$s2;        
}

function getPrice($build){
  $conn = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");
  $build_id = $build['build_id'];
  $ids = mysqli_query($conn, "SELECT cpu_id, gpu_id, memory_id, motherboard_id, storage_id 
                                FROM PCBUILDS WHERE build_id=$build_id");
  $components=array("cpu","gpu","memory","motherboard","storage");
  $final_price = 0;
  foreach($components as $comp_type){
    $comp_type_price = cat($comp_type,"_price");
    $comp_type_id = cat($comp_type,"_id");
    $build_comp_type_id = intval($build[$comp_type_id]);
    $price = mysqli_query($conn, "SELECT * FROM $comp_type WHERE $comp_type_id=$build_comp_type_id");
    $price = mysqli_fetch_assoc($price);
    $price = intval($price["$comp_type_price"]);
    $final_price = $final_price + $price;
  }
  return $final_price;
}

function getData($comp_type, $build){
  $conn = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");
  $comp_type_id = cat($comp_type,"_id");
  $build_comp_type_id = intval($build[$comp_type_id]);
  $comp_data = mysqli_query($conn, "SELECT * FROM $comp_type WHERE $comp_type_id=$build_comp_type_id");
  $comp_data = mysqli_fetch_assoc($comp_data);
  
  return $comp_data[cat($comp_type,"_manufacturer")]." ".$comp_data[cat($comp_type,"_name")];
}
?>
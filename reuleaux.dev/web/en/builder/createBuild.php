<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();

function unset_all(){
  unset($_SESSION['cpu_id']);
  unset($_SESSION['memory_id']);
  unset($_SESSION['storage_id']);
  unset($_SESSION['motherboard_id']);
  unset($_SESSION['gpu_id']);
  unset($_SESSION['build_change']);
}

if(!isset($_SESSION['userid'])){
  header('Location:https://reuleaux.dev/builder/advanced');
}
$user_id=$_SESSION['userid'];

$conn = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");

if(isset($_SESSION['build_id'])){
  $build_id=$_SESSION['build_id'];
  $final_array = $_SESSION['build_comp_ids'];
  $cpu_id=$final_array["cpu_id"];
  $gpu_id=$final_array["gpu_id"];
  $memory_id=$final_array["memory_id"];
  $motherboard_id=$final_array["motherboard_id"];
  $storage_id=$final_array["storage_id"];
  
  $query = mysqli_query($conn, "UPDATE PCBUILDS SET 
  cpu_id = $cpu_id, 
  gpu_id = $gpu_id, 
  memory_id = $memory_id, 
  motherboard_id = $motherboard_id, 
  storage_id = $storage_id 
  WHERE build_id = $build_id");
  unset_all();
  
} else {
        
  $final_array=array(
  "cpu_id" => 0,
  "gpu_id" => 0,
  "memory_id" => 0,
  "storage_id" => 0,
  "motherboard_id" => 0,
  "case_id" => 0,
  );

  foreach($_SESSION as $key=>$val){
    if(isset($_SESSION[$key])){
      $final_array[$key]=$val;
    }
  }
  
  $cpu_id=$final_array["cpu_id"];
  $gpu_id=$final_array["gpu_id"];
  $memory_id=$final_array["memory_id"];
  $motherboard_id=$final_array["motherboard_id"];
  $storage_id=$final_array["storage_id"];
  
  $run = mysqli_query($conn, "INSERT INTO PCBUILDS VALUES (NULL,
  $cpu_id,
  $gpu_id,
  $memory_id,
  $motherboard_id,
  $storage_id,
  $user_id
  )");
  unset_all();
  mysqli_close($conn);
}
header('Location:https://reuleaux.dev/builder/advanced');
?>



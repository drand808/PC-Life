<?php
 
 define('DBSERVER', 'pclife.reuleaux.dev');
 define('DBUSERNAME', 'pcl_access');
 define('DBPASSWORD', 'Puz3LNJtBcfxf3');
 define('DBNAME', 'pclifetesting');
 
  $conn = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");
 
  // Check connection
  if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
        
  function filterResults($comp_type){
    # $query = "SELECT * FROM cpu WHERE cpu_name LIKE 'Athelon'";
    $numFilters = 0;
    $priceLow =$_GET['plow'];
    $priceHigh=$_GET['phigh'];
    $query = "SELECT * FROM $comp_type ";
    
    if($priceLow and $priceHigh){
      $comp_type_price = $comp_type . "_price";
      if($numFilters>0) {$query .= " AND $comp_type_price BETWEEN '$priceLow' AND '$priceHigh' ";}
      else {$query .= "WHERE $comp_type_price BETWEEN '$priceLow' AND '$priceHigh' "; }
    }
    return $query;
  }
?>
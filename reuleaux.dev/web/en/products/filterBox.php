<?php
$component = basename("$_SERVER[REQUEST_URI]");
?>
<style>
#left-box{
  width: 300px;
  height: 500px;
  background-color: #f2f2f2;
  border: 1px solid #ccc;
  margin-right: 20px;
  float:left;
}

#left-box-header{
  width: 100%;
  height: 6%;
  font-weight: bold;
  font-size: 25px;
  text-align: center;
  background-color: #888;
}

#section-header {
  width: 100%;
  height: 10%;
  background-color: transparent;
  font-weight: bold;
  font-size: 18px;
  text-align: center;
  padding: 5px;
}

#section-body {
  width: 100%;
  height: 70%;
  background-color: transparent;
  padding-top: 25px;
  text-align: center;
}

.section1 {
  width: 100%;
  height: 20%;
  background-color: #ddd;
  border-bottom: 1px solid #ccc;
}

.section2 {
  width: 100%;
  height: 20%;
  background-color: #eee;
  border-bottom: 1px solid #ccc;
}

#input-price-low{
  width:20%;
  height:50%;
}

#input-price-high{
  width:20%;
  height:50%;
}


</style>

<script>
function myfun(){
  var input, filter, table, tr, name, txt;
  input = document.getElementById("searching");
  filter = input.value.toUpperCase();
  table = document.getElementById("table-component");
  tr = table.rows;
  for (var i=0; i< tr.length; i++){
    name = tr[i].getElementsByTagName("td")[0];
    brand = tr[i].getElementsByTagName("td")[1];
    if(name) {
      txt = name.textContent.concat(brand.textContent);
      if (txt.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

</script>

 <!-- START FILTERS -->
        <div id="left-box"> 
        <div id="left-box-header"> 
          Filters
        </div>
          <div class="section1">
            <div id="section-header"> Name Search </div>
              <div id="section-body">
                  <input id="searching" type="text" onkeyup="myfun()" placeholder="Search">
              </div>
          </div>
          <div class="section2">
             <div id="section-header"> Price Range </div>
               <div id="section-body">
                <form action="products/<?php echo $component?>" method="GET">
                    <input id="input-price-low" type="text" name="plow" placeholder="$Min">
                    <input id="input-price-high" type="text" name="phigh" placeholder="$Max">
                    <button>Go</button>
             </div>
          </div>
        </div>
        <!-- END FILTERS -->
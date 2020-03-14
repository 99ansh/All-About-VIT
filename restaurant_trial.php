<html>
<head>

	<style>
		        *{
            box-sizing: border-box;
        }
        section{
  line-height: 1.5em;
  font-size:0.9em;
  width:100%;
  margin: 0 auto;
 }
 body::-webkit-scrollbar{
     width:0em;
 }
 .filters::after{
     clear: both;
     display: block;
 }
 .info::after{
   
    display:inherit;
 }
 .filters{
    border-radius: 20px;
    float: left;
    margin:10px;
    width:20%;
    height:40%;
    margin:10px;
    border:2px solid #4ABDAC;
    background-color:#fbffe0;
    overflow-wrap: break-word;
    overflow:auto; 
    position:fixed;
 }
 .info{
    border-radius: 20px;
    padding:10px;
    margin:10px;
    width:98%;
    border:2px solid #4ABDAC;
    background-color:#c4fff5;
    margin-left:30%;
 }

 table{
     font-size:1.5em;
    overflow-wrap: break-word; 
    border-collapse: collapse;
 }
 .main{
    float:left;
    border-radius: 20px;
    padding:10px;
    width:75%;
 }
 .info.td{
    overflow-wrap: break-word; 
 }

 font{
     font-size: 1.8em;
 }
body{
    background-size:cover;
    height:100%;
    background-repeat:no-repeat;
}
	</style>
</head>
<body background=>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbmsj";
echo "<br><br><br><br>";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
} 

if (isset($_POST['submit'])){
    if(isset($_POST['cost']))
    {
        $cost=$_POST['cost'];
    }
    else{
        $cost='';
    }
    if(isset($_POST['distance']))
    {
        $distance=$_POST['distance'];
    }
    else{
        $distance='';
    }

    if($cost && !$distance){
        echo "You have selected :".$cost;  //  Displaying Selected Value
        echo " in selection 1";
        if($cost==801){
            $sql="SELECT * FROM restaurant WHERE Cost>=$cost ORDER BY Cost ASC" ;    
        }
        else{
        $sql="SELECT * FROM restaurant WHERE Cost<=$cost and Cost>$cost-300 ORDER BY Cost ASC";
        }
    }
    if(!$cost && $distance){
        echo "You have selected :".$distance;  //  Displaying Selected Value
        echo " in selection 2";
        if($distance==8.01){
            $sql="SELECT * FROM restaurant WHERE Distance>=$distance ORDER BY Distance ASC" ;    
        }
        else{
        $sql="SELECT * FROM restaurant WHERE Distance<=$distance and Distance>$distance-3 ORDER BY Distance ASC";
        }
    }
     if($cost && $distance){
        echo "You have selected :".$cost;  //  Displaying Selected Value
        echo "You have selected :".$distance;  //  Displaying Selected Value
        echo " in selection 3";
        if($cost==801 && $distance==8.01){
            $sql="SELECT * FROM restaurant WHERE Cost>=$cost AND Distance>=$distance ORDER BY Cost ASC" ;    
        }
        elseif($cost==801 && $distance!=8.01){
        $sql="SELECT * FROM restaurant WHERE Cost>=$cost AND Distance<=$distance and Distance>$distance-3 ORDER BY Cost ASC";
        }
        elseif($cost!=801 && $distance==8.01){
            $sql = "SELECT * FROM restaurant WHERE Cost<=$cost AND Cost>$cost-300 AND Distance>=$distance ORDER BY Cost ASC ";    
        }
        elseif($cost!=801 && $distance!=8.01){
            $sql = "SELECT * FROM restaurant WHERE Cost<=$cost AND Cost>$cost-300 AND Distance<=$distance AND Distance>$distance-3 ORDER BY Cost ASC ";
        }
    }
    if(!$cost && !$distance){
        echo "in selection 4";
        $sql = "SELECT * FROM restaurant ORDER BY COST ASC";
    }
}
else{
    $sql = "SELECT * FROM restaurant ORDER BY COST ASC";
}
$result = $conn->query($sql);

if($result->num_rows >= 0){
    echo "<section class='content'>
        
        <div class='filters'>
                <font align='center'><h1>Filters</h1></font>
                <ul>
                    <li><h2>Cost for two</h2></li>
                    <ul>
                        <form  action='#' method='post'>
                        <h3><input type='radio' name='cost' value='200'>Less than 200</h3>
                        <h3><input type='radio' name='cost' value='500'>200 t0 500</h3>
                        <h3><input type='radio' name='cost' value='800'>500 to 800</h3>
                        <h3><input type='radio' name='cost' value='900'>Greater than 800</h3>
                    </ul>
                    <li><h2>Distance</h2></li>
                    <ul>
                        <h3><input type='radio' name='distance' value='1'>Less than 1km</h3>
                        <h3><input type='radio' name='distance' value='4'>1km to 4km</h3>
                        <h3><input type='radio' name='distance' value='8'>4km to 8km</h3>
                        <h3><input type='radio' name='distance' value='9'>Greater than 8km</h3>
                        <input type='submit' name='submit' value='Start Filtering' />
                        </form>
                    </ul>
                </ul>
        </div>
        <div class='main'>";
	while($row = $result->fetch_assoc()){
        echo "<div class='info'>
                <table class='res_info' width=100% style='text-align:center'>
                    <tr >
                        <th rowspan='4' style='vertical-align:middle;border-right: 1px solid green' width=300px;>
                            <img src='/HostingDBMS-J/uploads/".$row["Image"]."'height='200px' width='250' alt='IMAGE GOES HERE' align='center'>
                        </th>
                        <th style='text-align:center;'>
                        <font>".$row["Name"].
                        "</font></th>
                    </tr>
                    <tr>
                        <td style=text-align:center;'>"
                            .$row["Distance"].
                        "</td>
                    </tr>
                    <tr >
                        <td style='text-align:center;'>
                            Here goes the full address
                        </td>
                    </tr>
                    <tr height='10'>
                        <td>
                          
                        </td>
                        <td>
                          
                        </td>
                    </tr>
                    <tr height='10'>
                        <td>
                          
                        </td>
                        <td>
                          
                        </td>
                    </tr>
                    <tr style='border-top:1px solid red;' height='40'>
                        <td style='vertical-align:bottom'>
                            Cuisines:
                        </td>
                        <td style='vertical-align:bottom'>
                            Details
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Cost for two:
                        </td>
                        <td>"
                            .$row["Cost"].
                        "</td>
                    </tr>
                    <tr>
                        <td>
                            Hours of Operation
                        </td>
                        <td>
                            Details
                        </td>
                    </tr>

                </table>
        </div>";

//		echo "<tr><td>".$row["Name"]."</td><td>".$row["Distance"]."</td><td>".$row["Cost"]."</td>";
	}
    echo "</table></div>";
    echo "</div>
    </section>";

}
if($result->num_rows == 0){
    echo "<font align='center'><h1>No results found</h1></font>";
}
/* else {
    echo "0 results";
} */
$conn->close();
?>

</body>
</html>

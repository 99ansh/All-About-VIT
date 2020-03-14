<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
            section::webkit-scrollbar{
                        width:0em;
            }
            body::-webkit-scrollbar{
                width:0em;
            }
                    
            font{
                font-size: 1.8em;
            }
            body{
                background-size:cover;
                height:100%;
                background-repeat:no-repeat;
            }
            table{
                width:50%;
                font-size:1.5em;
                overflow-wrap: break-word; 
                border-collapse:collapse;
                text-align:center;
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
                width:23%;
                height:25%;
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
                margin:1%;
                width:70%;
                border:2px solid #4ABDAC;
                background-color:#c4fff5;
                margin-left:25%;
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

        </style>
    </head>
    <body>
        <section class='content'>
            <div class='filters'>
                <font align='center'><h1>Choose Block</h1></font>
                <ul>
                        <form action='#' method='post'>
                            <h2><input type='radio' name='block' value='1'>C-Block</h2>
                            <h2><input type='radio' name='block' value='2'>D-Block</h2>
                            <h2><input type='radio' name='block' value='3'>E-Block</h2>
                            <h2><input type='radio' name='block' value='4'>E-Annex</h2>
                            <h2><input type='radio' name='block' value='5'>F-Block</h2>
                            <input type='submit' name='submit' value='Choose Block'>
                        </form>
                </ul>
            </div>
            <div class="info">
                <?php
                if(isset($_POST['block'])){
                    $block=$_POST['block'];
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "dbmsj";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 
                    else{
                        $sql="SELECT * FROM `table 10` t INNER JOIN `rooms` c on c.room_id=t.room_id WHERE t.id =$block";
                        $result=$conn->query($sql);
                        $count=0;
                        while($row=$result->fetch_assoc()){
                            if($count==0){
                                echo "<center><font><u><h1>".$row["name"]." - BLOCK</h1></u></font></center>";
                                $count=$count+1;
                            }
                            echo "<br>";
                            echo "
                            <center>
                            <table>
                                <th class='room_type'>".$row['type']." Bed ".$row['cooling']."</th>
                                <tr>
                                    <td colspan='2'><iframe src='imageSlider.html' id='iframe' height='300' width='450' frameborder=0px></iframe></td>
                                </tr>
                            </table>
                            </center>
                            ";
                        }
                    }        
                }
                else{
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "dbmsj";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 
                    else{
                        $sql2="SELECT distinct name from `table 10`";
                        $result2=$conn->query($sql2);
                        $after=0;
                        $before=1;
                        echo
                        "
                        <center>
                        <table border='1'>
                        ";
                        while($row2=$result2->fetch_assoc()){
                            $sql="SELECT distinct * FROM `table 10` t INNER JOIN `rooms` c on c.room_id=t.room_id where t.name='".$row2['name']."'";
                            $result=$conn->query($sql);
                            $count=0;
                            while($row=$result->fetch_assoc()){
                                if($count==0){
                                echo "
                                    <tr>
                                    <td colspan=2><h3><u>".$row["name"]." - BLOCK</u></h3</td>
                                    </tr>
                                ";
                                echo "<th>TYPE</th><th>COOLING</th>";
                                $count=$count+1;
                            }
                                echo 
                                "
                                <tr>
                                    <td>".$row['type']." Bed</td>
                                    <td>".$row['cooling']."</td>
                                </tr>
                                ";
                            }
                        }
                        echo "
                        </table>
                        </center>
                        ";
                    }
                }
                ?>
            </div>
        </section>
    </body>
</html>
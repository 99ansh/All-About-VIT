<?php
 session_start();
?>

<html>

<head>
    <title>
        FAQs
    </title>
</head>
<style>
    *{
            margin:auto;
        }
        html {
             -ms-overflow-style: -ms-autohiding-scrollbar;
        }
        body{
            background-size: 100%;
            background-attachment: fixed;
            backface-visibility: visible;
            margin: auto;
            }
        body::-webkit-scrollbar {
                width:0em;
            }
        table{
            border-radius:10px;
            border-spacing:0;
            border:1px solid black; 
            font-size:1em; 
            border-collapse:collapse; 
            width:100%; 
            height:12%; 
            text-align:center; 
            padding:10px;
        }
        td{
            border:1px solid black;
            
            }
        .std_info{
            background:aquamarine;
            width:50%;
        }
        .display{
            background:#c4fff5;
            width:80%;
            padding:20px;
            height:auto;
            overflow-y: auto;
            border-radius: 50px;
            border:2px solid yellow;
        }
        .display::-webkit-scrollbar{
            width:0em;
        }
        .search_input{
            margin:auto;
            padding:20px;
            position:absolute:
            height:10%;
            width:90%;
            box-align: center;
            outline: none;
            /* border:1px solid white; */
        }
        .get_input{
            height:auto;
            width:87%;
            margin-top:0.5%;
            margin-left:1%;
            font-size: 2em;
            opacity: 1;
            
            border-width: 2px;
            outline: none;
        }
        .get_input2{
            height:auto;
            width:86%;
            margin-top:0.5%;
            margin-left:1%;
            font-size: 1.5em;
            opacity: 1;
            
            border-width: 2px;
            outline: none;
        }
        .submit_input{
            height:auto;
            width:auto;
            font-size: 2em;
            opacity: 1;
            border-radius: 50px;
            border-width: 2px;
            outline: none;
            background:transparent;
            color:#4ABDAC;
        }

        .submit_input2{
            height:auto;
            width:auto;
            margin-top:0.5%;
            margin-left:1%;
            font-size: 2em;
            opacity: 1;
            color:#1a8270;
            border-radius: 50px;
            border-width: 1px;
            outline: none;
            background:transparent;
            float:right;
        }
        .question{
            display: none;
        }
        .answer{
            display:inline;
        }
        .view{
            border-radius: 20px;
            padding:20px;
            margin:30px;
            width:95%;
            background-color:#fbffe0;
            border:2px solid #4ABDAC;
            border-left:6px solid darkblue;
            margin-left:1%;
            overflow: hidden;
        }

</style>

<body>
    <br>
    
        <div class="search_input" style="width:80%;">

            <div style="width:80%;margin-left:0px;margin-top:0px;display:inline-block;">
            <form method="POST" action="#">
                <input class="get_input" type="text" name='search_value' placeholder="Type here to Search...">
                <input class="submit_input" type="submit" name="search" value="Search">
            </form>
            </div>
            <div style="width:19%;margin-right:0px;margin-top:0px;display:inline-block;">
            <button class="submit_input" value="Ask New" onclick="ask()" style="display:inline-block;float:right;margin-right:1%;">Ask New</button>
            <font class="submit_input" style="margin-left:10%;">OR </font>
            
            </div>
        </div>
    <br><br>
    <script>
        function ask() {
            var div = document.getElementById("ques");
            if (div.style.display != 'none') {
                div.style.display = 'none';
            } else {
                div.style.display = 'block';
            }

        }
        function asked() {
                var x = document.getElementById("ques");

                x.style.display = "none";
            }

        function validate() {
            var reg = '<?php 
            $reg = $_SESSION['regnum'];
            echo $reg; ?>';
            var admin = '<?php 
            $admin = $_SESSION['admin'];
            echo $admin; ?>';
            if(admin!='' && isset($_SESSION['admin'])){
                alert('POST SUCCESSFULL');
                return true;
            }
            else if (reg=='' || isset($_SESSION['regnum'])=='FALSE') {
                alert('Only VIT students have this right');
                return false;   
            }
            else{
                alert('POST SUCCESSFULL');
                return true;
            }
        }

    </script>
    <div class="display">
        <form id="question_form" method="POST" action="#">
            <div class="question" id="ques">
                <input class="get_input2" type="text" align="center" name='question_value' placeholder="Type question">
                <input class="submit_input2" type="submit" name="question" value="POST" onclick="asked()">
            </div>
        </form>

        <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dbmsj";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                
                    die("Connection failed: " . $conn->connect_error);
                }
                if(isset($_POST['search'])){
                    $search=$_POST['search_value'];
                    
                    $sql="SELECT * FROM questions where ques_value LIKE '%$search%' ORDER BY ques_id DESC";
                }
                else{
                    $sql="SELECT * FROM questions ORDER BY ques_id DESC";
                }
                    $sql2="SELECT * FROM answers ORDER BY ques_id DESC";

                    $result=$conn->query($sql);
                    

                    while($row = $result->fetch_assoc()){
                        $result2=$conn->query($sql2);
                        echo 
                            "
                            <div class='view'>
                                    <div class='ques_disp'>
                                        <h1>

                                        <u>".$row['ques_value']."</u>
                                        </h1>                                           
                                    </div>";   

                        echo"     
                            <form id='answer_form' method='post' onsubmit='return validate()'>                 
                            <div class='answer' id=".$row['ques_id'].">
                                <input class='get_input2' type='text' name='answer_value' placeholder='Type here to answer...'>
                                <input type='hidden' name='q_num' value=".$row['ques_id'].">
                                <button class='submit_input2' type='submit' name='answer' >POST</button><br><br><br> 
                            </div>
                            </form>
                                    <div class='ans_disp' style='LINE-HEIGHT:3em;'>
                                        ";
                                        while($row2=$result2->fetch_assoc()){
                                            if($row['ques_id']==$row2['ques_id'])
                                            {
                                                $num="VIT".$row2['reg_num'];
                                                $sql3="SELECT * FROM users where username ='".$row2['reg_num']."'";
                                                $result3=$conn->query($sql3);
                                                while($row3 = $result3->fetch_assoc()){
                                                echo "<h2 style='display: inline-block;'>".$row2['ans_value']."</h2>";
                                                echo "
                                                <div class='std_info' id=$num style='display:none;'>
                                                <table>
                                                <tr>
                                                    <td><b>NAME</b></td>
                                                    <td>".$row3['name']."</td>
                                                </tr>
                                                <tr>
                                                    <td><b>USERNAME</b></td>
                                                    <td>".$row3['username']."</td>
                                                </tr>
                                                <tr>
                                                    <td><b>EMAIL</b></td>
                                                    <td>".$row3['email']."</td>
                                                </tr>
                                                <tr>
                                                    <td><b>CONTACT</b></td>
                                                    <td>".$row3['mobile']."</td>
                                                </tr>
                                                <tr>
                                                    <td><b>BRANCH</b></td>
                                                    <td>".$row3['branch']."</td>
                                                </tr>
                                                </table>
                                                </div>
                                                ";
                                                }
                                                echo "
                                                <script>
                                                function $num(){
                                                    var div=document.getElementById('$num');
                                                    if (div.style.display != 'none') {
                                                        div.style.display = 'none';
                                                    } else {
                                                        div.style.display = 'block';
                                                    }
                                        
                                                }
                                                </script>
                                                <form id=".$row2['ans_id']." method='post' onsubmit='return validate()' style='display: inline-block; float:right'>
                                                <input type='hidden' name='ans_id' value=".$row2['ans_id'].">
                                                <input  type='hidden' name='reg_num' value=".$row2['reg_num'].">";
                                                if(isset($_SESSION['admin']) && $_SESSION['admin']!=""){
                                                echo "<button  type=submit name='deletion' class='submit_input2' style='float:right; margin-right:1%;font-size:1.5em;'>
                                                Delete
                                                </button>";
                                                }
                                                echo "</form>
                                                ";
                                                echo "
                                                <button onclick=$num() 
                                                class='submit_input2' style='float:right; margin-right:1%;font-size:1em; border:1;'>
                                                [".$row2['reg_num']."] </button><br>";
                                               
                                            }
                                        }
                        echo
                            "</div>
                                
                            </div>";
                    }
                    $conn->close(); 
        ?>
        <?php
                if(isset($_POST['question'])){
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dbmsj";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                
                    die("Connection failed: " . $conn->connect_error);
                } 
                    $sql="SELECT max(ques_id) as ques_id FROM questions";
                    $result=$conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        $qid=$row['ques_id'];
                    }
                    $qid=$qid+1;
                    $value=$_POST['question_value'];
                    echo $qid;
                    echo $value;
                    $sql = "INSERT INTO questions (ques_id,ques_value) VALUES ($qid,'$value')";
                    /* $sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES ('John', 'Doe', 'john@example.com')"; */

                    if ($conn->query($sql) === TRUE) {
                            echo "New record created successfully";
                            echo("<meta http-equiv='refresh' content='1'>");
                    } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
               
        ?>
        <?php
                if(isset($_POST['answer'])){

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dbmsj";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                
                    die("Connection failed: " . $conn->connect_error);
                }
                 
                    $qid=$_POST['q_num'];
                    $value=$_POST['answer_value'];
                    $reg=$_SESSION['regnum'];
                    
                    echo $qid;
                    echo $value;
                    $sql = "INSERT INTO answers (ques_id,ans_value,reg_num) VALUES ($qid,'$value','$reg')";
                    if ($conn->query($sql) === TRUE) {
                            echo "New record created successfully";
                            echo("<meta http-equiv='refresh' content='1'>");
                    } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
              
        ?>
        <?php
                if(isset($_POST['deletion'])){
                    $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dbmsj";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                
                    die("Connection failed: " . $conn->connect_error);
                }
                 
                    $ans_id=(int)$_POST['ans_id'];
                    $reg=$_POST['reg_num'];
                    $reg_num=$_SESSION['admin'];
                    /* echo $ans_id;
                    echo $reg;
                    echo $reg_num; */
                    if($reg===$reg_num){
                        $sql = "DELETE FROM answers WHERE ans_id=$ans_id";
                    }
                    else{
                        echo "<script>alert('".$reg." DENIES PERMISSION')</script>";
                    }
                    if ($conn->query($sql) === TRUE) {
                        echo "Deletion successfully";
                        echo("<meta http-equiv='refresh' content='1'>");
                    }/*  else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    } */
                }
           
        ?>
    </div>

</body>

</html>
<!-- <button class='' type='submit' value='REPLY' onclick=".$row['ques_id']()." style='float:right;'>REPLY</button> -->
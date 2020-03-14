<?php
    session_start();
?>
<html>
<head>
    <style>
        #info_table{
            border-radius:20px;
            background:#fbffe0;
            width:100%;
            border:2px solid #4ABDAC;
        }

        .info{
            
            width:100%;
            font-size:2em;
            border-collapse:collapse;
        }
        .q_a{
            width:100%;
            font-size:2em;
            margin:20px;
            padding:40px;
            
        }
        .rand{
            text-align:left;
            margin:20px;
            padding:30px
        }
        td{
            text-align:center;
            margin:20px;
            padding:30px
            
        }
        .submit_input2{
            height:auto;
            width:auto;
            font-size: 1em;
            border-radius: 50px;
            border-width: 1px;
            outline: none;
            background:transparent;
        }
        input{
            height:10%;
            font-size: 1.8em;
            width: 100%;
            opacity: 1;
            border-radius: 10px;
            outline: none;
        }
        font{
            align-content: left;
            font-size:2em;
        }
    </style>
</head>
<body>
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
        else{
            $sql3="SELECT * FROM users where username ='".$_SESSION['regnum']."'";
            $result3=$conn->query($sql3);
            $sql="SELECT distinct * FROM `answers` t INNER JOIN `questions` c on c.ques_id=t.ques_id where t.reg_num='".$_SESSION['regnum']."'";
            $result=$conn->query($sql);
            
            
            while($row3 = $result3->fetch_assoc()){
            echo "
            <div id='info_table'>
            <center>
            <table border='0' class='info' id='tab' style=''>
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
            </center>
            ";
            if(isset($_POST['edit'])){
                echo
                "<script>
                    document.getElementById('tab').style.display='none';
                </script>
                <form method='POST' action='#'>
                <center>
                <table>
                    <tr>
                        <td><font><b>Name : </b></font></td>
                        <td><input type='text' name='name' id='name' value=".$row3['name']."></td>
                    </tr>
                    <tr>
                        <td><font><b>E-Mail : </b></font></td>
                        <td><input type='email' name='email' id='email' value=".$row3['email']."></td>
                    </tr>
                    <tr>
                        <td><font><b>Mobile : </b></font></td>
                        <td><input type='number' name='mobile' id='mobile' value=".$row3['mobile']."></td>
                    </tr>
                    <tr>
                        <td><font><b>Branch : </b></font></td>
                        <td><input type='text' name='branch' id='branch' value=".$row3['branch']."></td>
                    </tr>
                    <tr>
                        <td><font><b>Username : </b></font></td>
                        <td><input type='text' pattern='[0-9]{2}[A-Z]{3}[0-9]{4}' name='username' id='username' value=".$row3['username']."></td>
                    </tr>
                    <tr>
                        <td><font><b>Password : </b></font></td>
                        <td><input type='text' name='pass' id='pass' value=".$row3['password']."></td>
                    </tr>
                </table>
                <center>
                <br><br>
                <input type='submit' name='SAVE' class='submit_input2' style='width:auto;font-size:2em;'>
            </form>
            ";
            }
            if(isset($_POST['SAVE'])){
                echo
                "
                <script>
                    document.getElementById('tab').style.display='block';
                </script>
                ";
                $name=$_POST['name'];
                $email=$_POST['email'];
                $mobile=$_POST['mobile'];
                $branch=$_POST['branch'];
                $user=$_POST['username'];
                $pass=$_POST['pass'];
                $query3="UPDATE users set `name`='$name',email='$email',mobile='$mobile',branch='$branch',username='$user',`password`='$pass' where username ='".$_SESSION['regnum']."'";
                if($conn->query($query3)===TRUE)
                {
                    echo("<meta http-equiv='refresh' content='1'>");
                }
            }
            echo
            "
            <form method='POST'>
                <br><br>
                <center><input type=submit name='edit' value='EDIT' class='submit_input2' style='font-size:2em;'></center>
            </form>
            ";
            echo"
            <table class='q_a'>
            <caption><b><u>Answers Given<u></b><caption>
            ";
            while($row = $result->fetch_assoc()){
                echo 
                "<tr>
                    <td class='rand'><b>".$row['ques_value']."</b></td>
                    <td class='rand'>".$row['ans_value']."</td>
                    <form method='POST'>
                    <td class='rand'><button  type=submit name='deletion' class='submit_input2'>
                    <input type='hidden' name='ans_id' value=".$row['ans_id'].">
                    </form>
                    Delete
                    </button></td>
                <tr>";
            }
            echo
            "
            </table>
            </div>
            ";
            }   
        }
        if(isset($_POST['deletion']))
            {
                $ans_id=$_POST['ans_id'];
                $sql4="DELETE FROM answers where ans_id=$ans_id";
                if ($conn->query($sql4) === TRUE) {
                    echo("<meta http-equiv='refresh' content='1'>");
                }
            }
        
    ?>
</body>
</html>
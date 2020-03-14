<?php
    session_start();
    $_SESSION['regnum']="";
    $_SESSION['admin']="";
?>
<html>
    <head>
        <style>
        body{
            background-image: url("background2.jpg");
            background-repeat: no-repeat;
            background-size: 100%;
            background-attachment: fixed;
            backface-visibility: visible;
            margin: auto;
        }
        .main{
            margin-left:40%; 
            margin-top: 12%;
            text-align: center;
            height:50%;
            width:20%;
            border:2px solid #4ABDAC;
            background-color:#fbffe0;
            border-radius: 10%;
            
        }
        .main{
            padding-top: 0.5%;
            overflow: auto;
        }
        input{
            height:10%;
            font-size: 2em;
            width: 80%;
            opacity: 1;
            border-radius: 15px;
            outline: none;
        }
        .forgot{
            text-align: left;
            margin-left: 100px;
        }
        h1{
            font-size: 2.5em;
        }
        #login{
            backface-visibility:visible;
            background-color: transparent;
            border-style:solid;
            border-width: 3px;
            border-color: black;
        }
        a{
            text-decoration:none;
        }
        /* unvisited link */
        a:link {
            color: black;
        }

        /* visited link */
        a:visited {
            color: black;
        }

        /* mouse over link */
        a:hover {
            color: black;
        }

        /* selected link */
        a:active {
            color: black;
        }
        .continue{
            color:black;
            font-weight:bold;
        }
        </style>
    </head>
    <body>
        <div class=main>
            <h1 ><u>LOGIN PORTAL</u></h1>
            <br><br>
            <form method="POST">
                <input type="text" id="reg" pattern="[0-9]{2}[A-Z]{3}[0-9]{4}"  name="reg_num" placeholder="Registration No."><br><br><br>
                <input type="password" id="pass" name="pass" placeholder="Password"><br><br>
                <a  href="forgot.html" class="forgot"><font class="forgot">Forgot Password?</font></a><br><br><br><br>
                <input type="submit" name="submission" value="LOGIN">
                <br><br>
                <input type="submit" name="admin_submission" value="LOGIN(ADMIN)">
            </form>
        </div>
        <div class="continue">
            <center><font><u><a href="home.php"><h1>CONTINUE WITHOUT LOGIN<h1></a></u></font></center>    
        </div>
        
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbmsj";
    
            if(isset($_POST['submission'])){
            $user=$_POST['reg_num'];
            $pass=$_POST['pass'];
                
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
                
            $query = mysqli_query($conn,"SELECT * FROM users WHERE username = '". $user ."' and `password`='". $pass ."'");

            if (mysqli_num_rows($query) == 1)
            {
                $_SESSION['regnum']=$user;
                echo $_SESSION['regnum'];
                echo "<script>alert('login');</script>";
                header("Location:home.php");
            }
            else{
                echo "<script>alert('Invalid Username or Password');</script>";
                }
            mysqli_close($conn);
            }
            else if(isset($_POST['admin_submission'])){
            
                $user=$_POST['reg_num'];
                $pass=$_POST['pass'];
                    
                $conn = mysqli_connect($servername, $username, $password, $dbname);    
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                    
                $query = mysqli_query($conn,"SELECT * FROM `admin` WHERE username = '". $user ."' and `password`='". $pass ."'");
    
                if (mysqli_num_rows($query) == 1)
                {
                    $_SESSION['admin']=$user;
                    echo "admin login:".$_SESSION['admin']."";
                    echo "<script>alert('login');</script>";
                    header("Location:home.php");           
                }
                else{
                    echo "<script>alert('Invalid Username or Password');</script>";
                    }
                mysqli_close($conn);
                    
            }
        ?>

    </body>
</html>
<?php
$server_name = "localhost";
$db_username = "web_firewall";
$db_password = "webfirewall123";
$db_name = "web_firewall";

$connection = mysqli_connect($server_name,$db_username,$db_password,$db_name);

if(!$connection)

{
	define ("SECRETKEY", "f7ff9e8b7bb2e09b70935a5d785e0cc5d9d0abf0");

    die("Connection failed: " . mysqli_connect_error());

    echo '

        <div class="container">

            <div class="row">

                <div class="col-md-8 mr-auto ml-auto text-center py-5 mt-5">

                    <div class="card">

                        <div class="card-body">

                            <h1 class="card-title bg-danger text-white"> Database Connection Failed </h1>

                            <h2 class="card-title"> Database Failure</h2>

                            <p class="card-text"> Please Check Your Database Connection.</p>

                            <a href="#" class="btn btn-primary">:( </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    ';

}

?>
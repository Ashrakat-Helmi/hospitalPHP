<?php

function test($condition , $mess){
    if($condition){
        echo "<div class='alert alert-info w-50 mx-auto'>
              <h3> $mess </h3>
              </div>";
    }else{
        echo "<div class='alert alert-danger w-50 mx-auto'>
              <h3> ! $mess </h3>
              </div>";
    }
}

function auth(){
    if($_SESSION['admin']){

    }else{
        header("location:/hospital/admin/login.php");
    }
}
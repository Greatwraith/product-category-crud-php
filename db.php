<?php
$conn = mysqli_connect("localhost","root","","productandcategory"); //KONEKSIKAN data base ke php

//check koneksi
if (mysqli_connect_error()) { //kalau ternyata koneksi nya gagal atau error dia bakal bilang "koneksi data base gagal"
    echo "koneksi data base gagal : ". mysqli_connect_error();
}


?>
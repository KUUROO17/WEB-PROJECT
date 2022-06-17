<?php
$conn = mysqli_connect('localhost','root','','shop_db') or die ('connection failed');


function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function caru($keyword){
    $query = "SELECT * FROM products
        WHERE 
        name = '$keyword%'
    ";

    return query($query);
}

?>

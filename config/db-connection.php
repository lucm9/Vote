<?php
try {
    $connection = mysqli_connect('172.31.37.187', 'admin', '', 'wordpressdb');
} catch (Exception $e) {
    if (str_contains($e->getMessage(), 'Access denied')) { 
        die('Database connection failed');
    } else {
        die('Internal server error : ' . $e->getMessage()); //TODO: 
    }
}
?>

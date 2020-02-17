<?php

 //phpinfo();

//echo date();

//$format = 'DATE_RFC822';
//$time = time();
//echo standard_date($format, $time);



$date = '2017-10-05';

// convert to MySQL date
$mysql_date = date('Y-m-d G:i:s', strtotime($date));



// echo out format in your view
echo date('F', strtotime($date));

//echo date('Y-m-d  H:i:s');
?>

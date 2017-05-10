<?
$filename1 = "log.txt";

$fp = fopen( $filename1, "a" );

foreach ($_GET as $key => $val)
{
    fwrite($fp, $key.' => '.$val."\r\nFWRITE");
}

echo "<pre>".print_r($_GET)."</pre>";
fclose($fp);

?>
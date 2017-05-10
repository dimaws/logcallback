<?
$filename1 = "log.txt";

$fp = fopen( $filename1, "a" );

foreach ($_POST as $key => $val)
{
    fwrite($fp, '-----\r\n'.$key.' => '.$val."\r\n");
}


fclose($fp);

echo "WMI_RESULT=OK";
//echo "<pre>".print_r($_POST)."</pre>";
?>
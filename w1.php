<?
$filename1 = "log.txt";

$fp = fopen( $filename1, "a" );

foreach ($_POST as $key => $val)
{
    fwrite($fp, $key.' => '.$val."\r\n");
}

echo "WMI_RESULT=OK";
//echo "<pre>".print_r($_POST)."</pre>";
fclose($fp);

echo "WMI_RESULT=OK";
//echo "<pre>".print_r($_POST)."</pre>";
?>
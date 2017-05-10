<?
$filename1 = "log.txt";

$fp = fopen( $filename1, "a" );

foreach ($_POST as $key => $val)
{
    fwrite($fp, $key.' => '.$val."\r\nFWRITE");
}
fclose($fp);

?>
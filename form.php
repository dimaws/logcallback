<?php
 echo "2<br>";
  //Секретный ключ интернет-магазина
  $key = "76457a5c77416b4c75304c46317a6c683236317c5748494c33426b";
 
  $fields = array();
 
  // Добавление полей формы в ассоциативный массив
  $fields["WMI_CUSTOMER_FIRSTNAME"]    = "[B@26b04487";
  $fields["WMI_CURRENCY_ID"] = "643";
  $fields["WMI_CUSTOMER_LASTNAME"]    = "[B@57fc982e";
  $fields["WMI_PAYMENT_AMOUNT"]     = "50";
  $fields["WMI_DESCRIPTION"]    = "[B@35939f3b"; //base64_encode("Покупка ставок на www.stoloto.ru"); //"BASE64:".base64_encode("Payment for order #12345-001 in MYSHOP.com");
  $fields["WMI_FAIL_URL"]   = "http://dev.stoloto.ru/payment/invoice/153176801/wait";
  $fields["WMI_CUSTOMER_PHONE"]    = "+79037640811";
  $fields["url"]       = "https://wl.walletone.com/checkout/checkout/Index";
  $fields["service"]       = "W1"; 
  $fields["WMI_SUCCESS_URL"]       = "http://dev.stoloto.ru/payment/invoice/153176801/wait"; 
  $fields["WMI_PAYMENT_NO"]       = "1831246"; 
  $fields["WMI_MERCHANT_ID"]       = "105243498743"; 
  $fields["WMI_CUSTOMER_EMAIL"]       = "gosloto@yolkin.ru"; 
  $fields["id"]       = "153176801"; 
  $fields["category"]       = "CARD"; 
  $fields["WMI_PTENABLED"]       = "TestCardRUB"; 
  
  
  
  
  
  
  //Если требуется задать только определенные способы оплаты, раскоментируйте данную строку и перечислите требуемые способы оплаты.
  //$fields["WMI_PTENABLED"]      = array("UnistreamRUB", "SberbankRUB", "RussianPostRUB");
 
  //Сортировка значений внутри полей
  foreach($fields as $name => $val)
  {
      if(is_array($val))
      {
          usort($val, "strcasecmp");
          $fields[$name] = $val;
      }
  }
 
  // Формирование сообщения, путем объединения значений формы,
  // отсортированных по именам ключей в порядке возрастания.
  uksort($fields, "strcasecmp");
  $fieldValues = "";
 
  foreach($fields as $value)
  {
      if(is_array($value))
          foreach($value as $v)
          {
              //Конвертация из текущей кодировки (UTF-8)
              //необходима только если кодировка магазина отлична от Windows-1251
              $v = iconv("utf-8", "windows-1251", $v);
              $fieldValues .= $v;
          }
      else
      {
          //Конвертация из текущей кодировки (UTF-8)
          //необходима только если кодировка магазина отлична от Windows-1251
          $value = iconv("utf-8", "windows-1251", $value);
          $fieldValues .= $value;
      }
  }
 
  // Формирование значения параметра WMI_SIGNATURE, путем
  // вычисления отпечатка, сформированного выше сообщения,
  // по алгоритму MD5 и представление его в Base64
 
  $signature = base64_encode(pack("H*", sha1($fieldValues . $key)));
 
  //Добавление параметра WMI_SIGNATURE в словарь параметров формы
 
  $fields["WMI_SIGNATURE"] = $signature;
 
  // Формирование HTML-кода платежной формы
 
  print "<form action='https://wl.walletone.com/checkout/checkout/Index' method='POST'>";
  //print "<form action='http://d5k.ru/w1.php' method='POST'>";
 
  foreach($fields as $key => $val)
  {
      if(is_array($val))
          foreach($val as $value)
          {
              print "$key: <input type='text' name='$key' value='$value'/>";
          }
      else
          print "$key: <input type='text' name='$key' value='$val'/>";
  }
 
  print "<input type='submit'/></form>";
 
?>
<?php
 
  //��������� ���� ��������-��������
  $key = "76457a5c77416b4c75304c46317a6c683236317c5748494c33426b";
 
  $fields = array();
 
  // ���������� ����� ����� � ������������� ������
  $fields["WMI_CUSTOMER_FIRSTNAME"]    = "����";
  $fields["WMI_CURRENCY_ID"] = "643";
  $fields["WMI_CUSTOMER_LASTNAME"]    = "";
  $fields["WMI_PAYMENT_AMOUNT"]     = "50";
  $fields["WMI_DESCRIPTION"]    = "������� ������ �� www.stoloto.ru"//"BASE64:".base64_encode("Payment for order #12345-001 in MYSHOP.com");
  $fields["WMI_FAIL_URL"]   = "http://dev.stoloto.ru/payment/invoice/148547161/wait";
  $fields["WMI_CUSTOMER_PHONE"]    = "+79037640811";
  $fields["url"]       = "https://wl.walletone.com/checkout/checkout/Index";
  $fields["service"]       = "W1"; // �������������� ���������
  $fields["WMI_SUCCESS_URL"]       = "http://dev.stoloto.ru/payment/invoice/148547161/wait"; // ��������-�������� ���� ���������
  $fields["WMI_PAYMENT_NO"]       = "1825010"; // ��� ������������ �������!
  $fields["WMI_MERCHANT_ID"]       = "105243498743"; // ��� ������������ �������!
  $fields["WMI_CUSTOMER_EMAIL"]       = "gosloto@yolkin.ru"; // ��� ������������ �������!
  $fields["id"]       = "148547161"; // ��� ������������ �������!
  $fields["category"]       = "CARD"; // ��� ������������ �������!
  $fields["WMI_PTENABLED"]       = "TestCardRUB"; // ��� ������������ �������!
  
  
  
  
  
  
  //���� ��������� ������ ������ ������������ ������� ������, ��������������� ������ ������ � ����������� ��������� ������� ������.
  //$fields["WMI_PTENABLED"]      = array("UnistreamRUB", "SberbankRUB", "RussianPostRUB");
 
  //���������� �������� ������ �����
  foreach($fields as $name => $val)
  {
      if(is_array($val))
      {
          usort($val, "strcasecmp");
          $fields[$name] = $val;
      }
  }
 
  // ������������ ���������, ����� ����������� �������� �����,
  // ��������������� �� ������ ������ � ������� �����������.
  uksort($fields, "strcasecmp");
  $fieldValues = "";
 
  foreach($fields as $value)
  {
      if(is_array($value))
          foreach($value as $v)
          {
              //����������� �� ������� ��������� (UTF-8)
              //���������� ������ ���� ��������� �������� ������� �� Windows-1251
              $v = iconv("utf-8", "windows-1251", $v);
              $fieldValues .= $v;
          }
      else
      {
          //����������� �� ������� ��������� (UTF-8)
          //���������� ������ ���� ��������� �������� ������� �� Windows-1251
          $value = iconv("utf-8", "windows-1251", $value);
          $fieldValues .= $value;
      }
  }
 
  // ������������ �������� ��������� WMI_SIGNATURE, �����
  // ���������� ���������, ��������������� ���� ���������,
  // �� ��������� MD5 � ������������� ��� � Base64
 
  $signature = base64_encode(pack("H*", md5($fieldValues . $key)));
 
  //���������� ��������� WMI_SIGNATURE � ������� ���������� �����
 
  $fields["WMI_SIGNATURE"] = $signature;
 
  // ������������ HTML-���� ��������� �����
 
  //print "<form action='https://wl.walletone.com/checkout/checkout/Index' method='POST'>";
  print "<form action='http://d5k.ru/w1.php' method='POST'>";
 
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
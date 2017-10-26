<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasargad {
    //put your code here
    private $merchantCode = "709633"; // كد پذيرنده
    private $terminalCode = "710368"; // كد ترمينال
    private $action = "1003"; 	// 1003 : براي درخواست خريد  
    private $redirectAddress;
    private $amount; // مبلغ فاكتور
    private $invoiceNumber;
    //private $timeStamp;
    private $invoiceDate; //تاريخ فاكتور
    
    
    ###################### constructor #############################
    public function __construct() {
        $_POST['price'] =  floatval(1000);
        $_POST['invoiceNumber'] = floatval(1000);;
    }
public function ali(){
    echo 'ali';
}
    ###################### DO PAYMENT #############################
    public function pay(){
        echo 'hello again';
        $processor = new RSAProcessor(base_url("certificate.xml"),RSAKeyType::XMLFile);
        print_r($processor);
        $this->redirectAddress = base_url("passargad/transaction_check");
        $params['merchantCode']=  $this->merchantCode;
        $params['terminalCode']=  $this->terminalCode;
        $params['action']=  $this->action;
        $params['redirectAddress']=  $this->redirectAddress;
        
        $params['invoiceDate']=$this->invoiceDate = date("Y/m/d H:i:s");
        $params['timeStamp']=$timeStamp = date("Y/m/d H:i:s");
        $params['amount']=$this->amount=  $this->input->post('price');
        $params['invoiceNumber']=$this->invoiceNumber= $this->input->post('invoiceNumber');
        
        $data = "#". $this->merchantCode ."#". $this->terminalCode ."#". $this->invoiceNumber ."#". $this->invoiceDate ."#". $this->amount ."#". $redirectAddress ."#". $this->action ."#". $timeStamp ."#";
        $data = sha1($data,true);
        $data =  $processor->sign($data); // امضاي ديجيتال 
        $params['sign']= base64_encode($data); // base64_encode 
        print_r($data);
        //$result = $this->post2https($params,'https://pep.shaparak.ir/gateway.aspx');
        $this->load->view('bank/pay',$params);
    }
    ###################### CHECK TRANSACTION #############################
    public function transaction_check(){

	$fields = array('invoiceUID' => $_GET['tref'] );
	$result = $this->post2https($fields,'https://pep.shaparak.ir/CheckTransactionResult.aspx');
	$array = $this->makeXMLTree($result);

        if($array["resultObj"]["result"]){
            echo 'تراکنش با موفقیت انجام شد و منتظر تایید میباشد';
            $this->verify();
        }else{
            echo 'تراکنش با مشکل مواجه شده است لطفا مجددا اقدام نمایید';
            echo 'وجه پرداخت شده توسط بانک تا 20 دقیقه دیگر به حساب شما باز خواهد گشت';
        }
       
    }
    ###################### VERIFY TRANSACTION #############################
    public function verify(){
	$fields = array(
                        'MerchantCode' => $this->merchantCode, 			//shomare ye moshtari e shoma.
                        'TerminalCode' => $this->terminalCode, 			//shomare ye terminal e shoma.
                        'InvoiceNumber' => $this->invoiceNumber,  			//shomare ye factor tarakonesh.
                        'InvoiceDate' => $this->invoiceDate, //tarikh e tarakonesh.
                        'amount' => $this->amount, 					//mablagh e tarakonesh. faghat adad.
                        'TimeStamp' => date("Y/m/d H:i:s"), 	//zamane jari ye system.
                        'sign' => '' 							//reshte ye ersali ye code shode. in mored automatic por mishavad. 
                );
	
	$processor = new RSAProcessor("certificate.xml",RSAKeyType::XMLFile);
	
	$data = "#". $fields['MerchantCode'] ."#". $fields['TerminalCode'] ."#". $fields['InvoiceNumber'] ."#". $fields['InvoiceDate'] ."#". $fields['amount'] ."#". $fields['TimeStamp'] ."#";
	$data = sha1($data,true);
	$data =  $processor->sign($data);
	$fields['sign'] =  base64_encode($data); // base64_encode 
	
	$sendingData =  "MerchantCode=". $merchantCode ."&TerminalCode=". $terminalCode ."&InvoiceNumber=". $invoiceNumber ."&InvoiceDate=". $invoiceDate ."&amount=". $amount ."&TimeStamp=". $timeStamp ."&sign=".$fields['sign'];
	$verifyresult = $this->post2https($fields,'https://pep.shaparak.ir/VerifyPayment.aspx');
	$array = $this->makeXMLTree($verifyresult);
	//var_dump($array);
        if($array["resultObj"]["verifyresult"]){
          echo 'تراکنش شما تایید شد';  
        }else{
            echo 'تراکنش شما تایید نشد';
        }
    }

   ###################### makeXMLTree ############################# 
   public function makeXMLTree($data)
  {
     $ret = array();
     $parser = xml_parser_create();
     xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
     xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
     xml_parse_into_struct($parser,$data,$values,$tags);
     xml_parser_free($parser);
     $hash_stack = array();
     foreach ($values as $key => $val)
     {
        switch ($val['type'])
        {
           case 'open':
              array_push($hash_stack, $val['tag']);
           break;
           case 'close':
              array_pop($hash_stack);
           break;
           case 'complete':
              array_push($hash_stack, $val['tag']);
              // uncomment to see what this function is doing
              // echo("\$ret[" . implode($hash_stack, "][") . "] = '{$val[value]}';\n");
              eval("\$ret[" . implode($hash_stack, "][") . "] = '{$val[value]}';");
              array_pop($hash_stack);
           break;
        }
     }
     return $ret;
  }
  
  
 /* ------------------------------------- CURL POST TO HTTPS --------------------------------- */
public function post2https($fields_arr, $url)
{
		
	//url-ify the data for the POST
	foreach($fields_arr as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	$fields_string = substr($fields_string, 0, -1);
	
	//open connection
	$ch = curl_init();
	
	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,count($fields_arr));
	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	
	
	//execute post
	$res = curl_exec($ch);
	
	//close connection
	curl_close($ch);
	return $res;
}  

}//end of pasargad Class



define("BCCOMP_LARGER", 1);
class RSA {
function rsa_encrypt($message, $public_key, $modulus, $keylength) {
  $padded = RSA::add_PKCS1_padding($message, true, $keylength / 8);
  $number = RSA::binary_to_number($padded);
  $encrypted = RSA::pow_mod($number, $public_key, $modulus);
  $result = RSA::number_to_binary($encrypted, $keylength / 8);
  return $result;
 }
function rsa_decrypt($message, $private_key, $modulus, $keylength) {
  $number = RSA::binary_to_number($message);
  $decrypted = RSA::pow_mod($number, $private_key, $modulus);
  $result = RSA::number_to_binary($decrypted, $keylength / 8);
  return RSA::remove_PKCS1_padding($result, $keylength / 8);
 }
function rsa_sign($message, $private_key, $modulus, $keylength) {
  $padded = RSA::add_PKCS1_padding($message, false, $keylength / 8);
  $number = RSA::binary_to_number($padded);
  $signed = RSA::pow_mod($number, $private_key, $modulus);
  $result = RSA::number_to_binary($signed, $keylength / 8);
  return $result;
 }
function rsa_verify($message, $public_key, $modulus, $keylength) {
  return RSA::rsa_decrypt($message, $public_key, $modulus, $keylength);
 }
function rsa_kyp_verify($message, $public_key, $modulus, $keylength) {
  $number = RSA::binary_to_number($message);
  $decrypted = RSA::pow_mod($number, $public_key, $modulus);
  $result = RSA::number_to_binary($decrypted, $keylength / 8);
  return RSA::remove_KYP_padding($result, $keylength / 8);
 }
function pow_mod($p, $q, $r) {
  $factors = array();
  $div = $q;
  $power_of_two = 0;
while(bccomp($div, "0") == BCCOMP_LARGER)  {
   $rem = bcmod($div, 2);
   $div = bcdiv($div, 2);
   if($rem) array_push($factors, $power_of_two);
   $power_of_two++;
  }
  $partial_results = array();
  $part_res = $p;
  $idx = 0;
  foreach($factors as $factor)  {
   while($idx < $factor)
   {
    $part_res = bcpow($part_res, "2");
    $part_res = bcmod($part_res, $r);
    $idx++;
   }
   array_push($partial_results, $part_res);
  }
  $result = "1";
  foreach($partial_results as $part_res)
  {
   $result = bcmul($result, $part_res);
   $result = bcmod($result, $r);
  }
  return $result;
 }
 function add_PKCS1_padding($data, $isPublicKey, $blocksize)
 {
  $pad_length = $blocksize - 3 - strlen($data);
  if($isPublicKey)
  {
   $block_type = "\x02";
   $padding = "";
   for($i = 0; $i < $pad_length; $i++)
   {
    $rnd = mt_rand(1, 255);
    $padding .= chr($rnd);
   }
  }
  else
  {
   $block_type = "\x01";
   $padding = str_repeat("\xFF", $pad_length);
  }
  return "\x00" . $block_type . $padding . "\x00" . $data;
 }
 function remove_PKCS1_padding($data, $blocksize)
 {
  assert(strlen($data) == $blocksize);
  $data = substr($data, 1);
  if($data{0} == '\0')
  die("Block type 0 not implemented.");
  assert(($data{0} == "\x01") || ($data{0} == "\x02"));
  $offset = strpos($data, "\0", 1);
  return substr($data, $offset + 1);
 }
 function remove_KYP_padding($data, $blocksize)
 {
  assert(strlen($data) == $blocksize);
  $offset = strpos($data, "\0");
  return substr($data, 0, $offset);
 }
 function binary_to_number($data)
 {
  $base = "256";
  $radix = "1";
  $result = "0";
  for($i = strlen($data) - 1; $i >= 0; $i--)
  {
   $digit = ord($data{$i});
   $part_res = bcmul($digit, $radix);
   $result = bcadd($result, $part_res);
   $radix = bcmul($radix, $base);
  }
  return $result;
  }
 function number_to_binary($number, $blocksize)
 {
  $base = "256";
  $result = "";
  $div = $number;
  while($div > 0)
  {
   $mod = bcmod($div, $base);
   $div = bcdiv($div, $base);
   $result = chr($mod) . $result;
  }
  return str_pad($result, $blocksize, "\x00", STR_PAD_LEFT);
 }
}
//require_once("application/libraries/pasargad/rsa.class.php"); 
class RSAProcessor
{
 private $public_key = null;
 private $private_key = null;
 private $modulus = null;
 private $key_length = "1024";
 public function __construct($xmlRsakey=null,$type=null)
 {
         $xmlObj = null;
   if($xmlRsakey==null)          {
           $xmlObj = simplexml_load_file("xmlfile/RSAKey.xml");
          }
          elseif($type==RSAKeyType::XMLFile)          {
           $xmlObj = simplexml_load_file($xmlRsakey);
          }
          else          {
           $xmlObj = simplexml_load_string($xmlRsakey);
          }
        $this->modulus = RSA::binary_to_number(base64_decode($xmlObj->Modulus));
		$this->public_key = RSA::binary_to_number(base64_decode($xmlObj->Exponent));
		$this->private_key = RSA::binary_to_number(base64_decode($xmlObj->D));
		$this->key_length = strlen(base64_decode($xmlObj->Modulus))*8;
 }
 public function getPublicKey() {
  return $this->public_key;
 }
 public function getPrivateKey() {
  return $this->private_key;
 }
 public function getKeyLength() {
  return $this->key_length;
 }
 public function getModulus() {
  return $this->modulus;
 }
 public function encrypt($data) {
  return base64_encode(RSA::rsa_encrypt($data,$this->public_key,$this->modulus,$this->key_length));
 }
  public function dencrypt($data) {
  return RSA::rsa_decrypt($data,$this->private_key,$this->modulus,$this->key_length);
 }
  public function sign($data) {
  return RSA::rsa_sign($data,$this->private_key,$this->modulus,$this->key_length);
 }
  public function verify($data) {
  return RSA::rsa_verify($data,$this->public_key,$this->modulus,$this->key_length);
 }
}
class RSAKeyType{
 const XMLFile = 0;
 const XMLString = 1;
}
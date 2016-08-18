<?php
include 'PhpSerial.php';

//rotinas para habilitar a exibicao de erros na pagina. Tire se nao quiser.
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
ini_set('display_errors', '1');

// Let's start the class
$serial = new PhpSerial;

// First we must specify the device. This works on both linux and windows (if
// your linux serial device is /dev/ttyS0 for COM1, etc)
$serial->deviceSet("ttyACM0");

// We can change the baud rate, parity, length, stop bits, flow control
$serial->confBaudRate(9600);
$serial->confParity("none");
$serial->confCharacterLength(8);
$serial->confStopBits(1);
$serial->confFlowControl("none");

// Then we need to open it
$serial->deviceOpen();

// To write into
$serial->sendMessage("Hello !");

//Se receber 'a' via GET na Pagina
if(isset($_GET['a'])){
	//sleep(2);
	$serial->sendMessage("a"); //envia o caractere 'a' via Serial pro Arduino
	sleep(1); //delay para o Arduino enviar a resposta.
	$read = $serial->readPort(); //faz a leitura da resposta na variavel $read
	echo $read; //echo para mostrar a resposta recebida do Arduino
}

//Se receber 'd' via GET na pagina
if(isset($_GET['d'])){
	//sleep(2);
	$serial->sendMessage("d"); //envia o caractere 'd' via Serial pro Arduino
	sleep(1); //delay para o Arduino enviar a resposta
	$read = $serial->readPort(); //faz a leitura da resposta na variavel $read
	echo $read; //echo para mostrar a resposta recebida do Arduino
}
$serial->deviceClose(); //encerra a conexao serial

?>


<html>
<head></head>

<body>
<h1> Raspi + Arduino </h1>

<input type="button" 
	onclick="location.href='/serial.php?a=1'"
	value="Acende LED" />

<input type="button"
	onclick="location.href='/serial.php?d=1'"
	value="Apaga LED" />
	

</body>
</html>

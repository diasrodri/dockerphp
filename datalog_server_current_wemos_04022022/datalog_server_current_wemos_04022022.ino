/*
 * HTTP Client GET Request
 * Copyright (c) 2018, circuits4you.com
 * All rights reserved.
 * https://circuits4you.com 
 * Connects to WiFi HotSpot. */
 
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>   // Include the Wi-Fi-Multi library
#include <NTPClient.h>

#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <OneWire.h>
#include <DallasTemperature.h>
//#include <Arduino.h>

#include <NTPClient.h>
#include <WiFiUdp.h>

//ADC_MODE(ADC_VCC);

const long utcOffsetInSeconds = 3600;

char daysOfTheWeek[7][12] = {"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"};

// Define NTP Client to get time
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP, "pool.ntp.org", utcOffsetInSeconds);



// Variable to save current epoch time
unsigned long epochTime; 


WiFiClient wifiClient;
HTTPClient http;    //Declare object of class HTTPClient

//Web/Server address to read/write from
const char* host = "191.252.218.131";
const int   port = 8000;

ESP8266WiFiMulti wifiMulti;     // Create an instance of the ESP8266WiFiMulti class, called 'wifiMulti'

/* Set these to your desired credentials. */
const char *ssid1 = "Petos";  //ENTER YOUR WIFI SETTINGS
const char *password1 = "petinhos";

const char* ssid2 = "depfis02"; 
const char* password2 = "eqdEhBNH";

const char* ssid3 = "RedmiRadias"; 
const char* password3 = "12345677";

const char* ssid4 = "labapli"; 
const char* password4 = "labapli1";

const float VCC   = 4.91;// supply voltage is from 4.5 to 5.5V. Normally 5V.
const int model = 3;   // enter the model number (see below)
float cutOffLimit = 1.01;// set the current which below that value, doesn't matter. Or set 0.5

// Function that gets current epoch time
unsigned long getTime() {
  timeClient.update();
  unsigned long now = timeClient.getEpochTime();
  return now;
}

/*
          "ACS712ELCTR-05B-T",// for model use 0
          "ACS712ELCTR-20A-T",// for model use 1
          "ACS712ELCTR-30A-T"// for model use 2  
sensitivity array is holding the sensitivy of the  ACS712
current sensors. Do not change. All values are from page 5  of data sheet          
*/
float sensitivity[] ={
          0.185,// for ACS712ELCTR-05B-T
          0.100,// for ACS712ELCTR-20A-T
          0.0682,// for ACS712ELCTR-30A-T
          0.108397882// for ACS712ELCTR-30A-T radias ajusted
         }; 


const float QOV =   0.5 * VCC;// set quiescent Output voltage of 0.5V
float voltage;// internal variable for voltage

// Push data on this interval 
const int dataPostDelay = 100;     // 15 minutes = 15 * 60 * 1000
// Push data at this interval
const int deepSleep = 100;

// 
#define ONE_WIRE_BUS 2 // (GPIO 2 - pin D4)
#define TEMPERATURE_PRECISION 12
float Temp0=0.0;
float Temp1=0.0;
float Temp2=0.0;

const int Pel=12; // (GPIO 12 - pin D6)
const int Bom=14; // (GPIO 14 - pin D5)
const int Col=16; // (GPIO 16 - pin D0)


int brightness = 0;    // how bright the LED is
int fadeAmount = 64;    // how many points to fade the LED by

// Setup a oneWire instance to communicate with any OneWire devices (not just Maxim/Dallas temperature ICs)
OneWire oneWire(ONE_WIRE_BUS);

// Pass our oneWire reference to Dallas Temperature. 
DallasTemperature sensors(&oneWire);


  
//#define  qap      8       //  Quick As Possible ... Duty cycle only 0, 50, 100%
#define  HFreq    100
//#define  pPulse   D5      // a NodeMCU/ESP8266 GPIO PWM pin


//=======================================================================
//                    Power on setup
//=======================================================================

void setup() {
  delay(1000);
 
  Serial.begin(115200);         // Start the Serial communication to send messages to the computer
  delay(10);
  Serial.println('\n');

  wifiMulti.addAP( ssid1, password1 );   // add Wi-Fi networks you want to connect to
  wifiMulti.addAP( ssid2, password2 );
  wifiMulti.addAP( ssid3, password3 );

  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);        //This line hides the viewing of ESP as wifi hotspot
  
  Serial.println("Connecting ...");
  int i = 0;
  while (wifiMulti.run() != WL_CONNECTED) { // Wait for the Wi-Fi to connect: scan for Wi-Fi networks, and connect to the strongest of the networks above
    delay(1000);
    Serial.print('.');
  }
  Serial.println('\n');
  Serial.print("Connected to ");
  Serial.println(WiFi.SSID());              // Tell us what network we're connected to
  Serial.print("IP address:\t");
  Serial.println(WiFi.localIP());           // Send the IP address of the ESP8266 to the computer

  timeClient.begin();
   
 //analogWriteRange(qap);      analogWrite(pPulse, 1);    // start PWM
  analogWriteFreq( HFreq );
    
  pinMode(Pel, OUTPUT);    // configura o pino digital D5 como saída
  pinMode(Bom, OUTPUT);    // configura o pino digital D6 como saída
  pinMode(Col, OUTPUT);    // configura o pino digital D7 como saída

  digitalWrite(Pel, LOW); // ativa o pino digital D5
  digitalWrite(Bom, LOW); // ativa o pino digital D6
  digitalWrite(Col, LOW); // ativa o pino digital D7

  Serial.println(digitalRead(Pel));
  Serial.println(digitalRead(Bom));
  Serial.println(digitalRead(Col));
 }

 void Control(String payload1){
  if (payload1=="PoffBoffCoff\n") {
    //Serial.println("000");
    digitalWrite(Pel, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Pel));
    digitalWrite(Bom, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Bom));
    digitalWrite(Col, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Bom));
  }
  if (payload1=="PoffBoffCon\n" ) {
    //Serial.println("001");
    digitalWrite(Pel, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Pel));
    digitalWrite(Bom, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Bom));
    digitalWrite(Col, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Col));
    }
  if (payload1=="PoffBonCoff\n" ) {
    //Serial.println("010");
    digitalWrite(Pel, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Pel));
    digitalWrite(Bom, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Bom));
    digitalWrite(Col, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Col));
    }
  if (payload1=="PoffBonCon\n" ) {
    //Serial.println("011");
    digitalWrite(Pel, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Pel));
    digitalWrite(Bom, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Bom));
    digitalWrite(Col, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Col));
    }    
  if (payload1=="PonBoffCoff\n"  ) {
    //Serial.println("100");
    digitalWrite(Pel, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Pel));
    digitalWrite(Bom, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Bom));
    digitalWrite(Col, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Col));
    }
  if (payload1=="PonBoffCon\n"  ) {
    //Serial.println("101");
    digitalWrite(Pel, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Pel));
    digitalWrite(Bom, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Bom));
    digitalWrite(Col, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Col));
    }
   if (payload1=="PonBonCoff\n"  ) {
    //Serial.println("110");
    digitalWrite(Pel, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Pel));
    digitalWrite(Bom, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Bom));
    digitalWrite(Col, LOW); // ativa o pino digital 13
    //Serial.println(digitalRead(Col));
    }
   if (payload1=="PonBonCon\n"  ) {
    //Serial.println("111");
    digitalWrite(Pel, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Pel));
    digitalWrite(Bom, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Bom));
    digitalWrite(Col, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Col));
    }
 }

//=======================================================================
//                    Main Program Loop
//=======================================================================
void loop() {

  String getData, Link, Link1; 

  // Read analog value
  sensors.setResolution(TEMPERATURE_PRECISION);
  sensors.setWaitForConversion(false);
  sensors.requestTemperatures();// Send the command to get temperatures
  
  sensors.requestTemperatures(); // Send the command to get temperatures
  Temp0=sensors.getTempCByIndex(0);
  Temp1=sensors.getTempCByIndex(1);
  Temp2=sensors.getTempCByIndex(2);

  float voltage_raw =   (VCC / 1023.0)* analogRead(A0);// Read the voltage from sensor
  //float voltage_raw =   1.0* analogRead(A0);// Read the voltage from sensor

  voltage =  voltage_raw - QOV - 1.394286413;// is a value to make voltage zero when there is no current
  float current = voltage/sensitivity[model]+3.3;

      //Serial.println("00");
 //   digitalWrite(Pel, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Pel));
 //   digitalWrite(Bom, HIGH); // ativa o pino digital 13
    //Serial.println(digitalRead(Bom));
   Serial.print("voltage= ");
   Serial.print(voltage);
   Serial.print(" current= ");
   Serial.println(current);

  //GET Data
  //=======================================================================
  getData = "?t1="+String(Temp0)+"&t2="+String(Temp1)+"&t3="+String(Temp2)+"&cur="+String(current);  //Note "?" added at front
  Link = "/insert_data.php"+getData;

//  Serial.println(Link);
//  Serial.print("connecting to ");
//  Serial.println(host);
//  Serial.print("Requesting Link: ");
//  Serial.println(Link);
  http.begin(wifiClient, host, port, Link);

  timeClient.update();

  Serial.print(daysOfTheWeek[timeClient.getDay()]);
  Serial.print(", ");
  Serial.print(timeClient.getHours());
  Serial.print(":");
  Serial.print(timeClient.getMinutes());
  Serial.print(":");
  Serial.println(timeClient.getSeconds());
  Serial.println(timeClient.getFormattedTime());
  getData = " "+String(Temp0)+" , "+String(Temp1)+" , "+String(Temp2)+" , "+String(current); 
  Serial.println(getData);
  
//  http.begin(wifiClient,Link);     //Specify request destination
  
  int httpCode = http.GET();            //Send the request
  String payload = http.getString();    //Get the response payload
 
 // Serial.println(httpCode);   //Print HTTP return code
 // Serial.print("payload=");    //Print request response payload
 // Serial.println(payload);    //Print request response payload
 
  http.end();  //Close connection
///*//=======================================================================
  Link1 = "/caixatermica/control.php";
  Serial.println(Link1);
  
  http.begin(wifiClient, host, port, Link1);     //Specify request destination
  
  int httpCode1 = http.GET();            //Send the request
  String payload1 = http.getString();    //Get the response payload
 
 // Serial.println(httpCode1);   //Print HTTP return code
 // Serial.print("payload1=");
 // Serial.println(payload1);    //Print request response payload

  Control(payload1);
  
  http.end();  //Close connection
//=======================================================================
/*  analogWrite(Pel, brightness);

  // change the brightness for next time through the loop:
  brightness = brightness + fadeAmount;

  // reverse the direction of the fading at the ends of the fade:
  if (brightness <= 0 || brightness >= 1024) {
    fadeAmount = -fadeAmount;
  }
  Serial.print("brightness: ");  Serial.println(brightness);
  */
  delay(5000);  //Post Data at every 5 seconds
  //ESP.deepSleep(dataPostDelay); // Go back to sleep
}
//=======================================================================

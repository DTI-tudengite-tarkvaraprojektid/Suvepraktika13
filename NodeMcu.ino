#include <ESP8266WiFi.h>
#include <dht.h>
#include "DHT.h"
#include <Wire.h>
#include <BH1750.h>

#define dht_apin D0 // Analog Pin sensor is connected to

BH1750 lightMeter;
dht DHT;
  
  const char* ssid     = "TLU";
  const char* password = "";     
  
  int wifiStatus;

/*-------------------------------------SETUP STARTS HERE BELOW----------------------------*/  
void setup() {
  
  Serial.begin(74880);
  delay(200);
  
  
  
  // We start by connecting to a WiFi network
  
  Serial.println();
  Serial.println();
  Serial.print("Your are connecting to;");
  Serial.println(ssid);
  
  WiFi.begin();
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
    Wire.begin();

    lightMeter.begin();  
  
 }
 
/*-------------------------------------LOOP STARTS HERE BELOW----------------------------*/
void loop() {
  wifiStatus = WiFi.status();
  
  if(wifiStatus == WL_CONNECTED){
     Serial.println("");
     Serial.println("Your ESP is connected!");  
     Serial.println("Your IP address is: ");
     Serial.println(WiFi.localIP());  
  }
  else{
    Serial.println("");
    Serial.println("WiFi not connected");
  }
/*-------------------------HELI----------------------*/
    float db;
    int val;
    val=analogRead(A0); 
    float voltage = val * (5.0/1023);
    db = 20 * log10(voltage/0.005012);
    Serial.println(db);
    //
/*-------------------------TEMP----------------------*/
  DHT.read11(dht_apin);
    
    Serial.print("Current humidity = ");
    Serial.print(DHT.humidity);
    Serial.print("%  ");
    Serial.print("temperature = ");
    Serial.print(DHT.temperature); 
    Serial.println("C  ");

/*-------------------------VALGUS----------------------*/

  uint16_t lux = lightMeter.readLightLevel();
  Serial.print("Light: ");
  Serial.print(lux);
  Serial.println(" lx");

  delay(1000); // check for connection every once a second
  
  }


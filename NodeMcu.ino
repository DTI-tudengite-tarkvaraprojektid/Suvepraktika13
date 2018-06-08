
#include <ESP8266WiFi.h>
#include <dht.h>
#include "DHT.h"
#define dht_apin D0 // Analog Pin sensor is connected to
 
dht DHT;
  
  const char* ssid     = "TLU";
  const char* password = "";     
  
  int wifiStatus;
  
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
  
  }   
  
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
  DHT.read11(dht_apin);
    
    Serial.print("Current humidity = ");
    Serial.print(DHT.humidity);
    Serial.print("%  ");
    Serial.print("temperature = ");
    Serial.print(DHT.temperature); 
    Serial.println("C  ");
    
  delay(1000); // check for connection every once a second
  
  }


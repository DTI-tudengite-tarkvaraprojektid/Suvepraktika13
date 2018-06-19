/**
 * BasicHTTPClient.ino
 *
 *  Created on: 24.05.2015
 *
 */

#include <Arduino.h>
#include <dht.h>
#include "DHT.h"
#include <Wire.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <BH1750.h>
#include <ESP8266HTTPClient.h>
#include <sstream>  

#define USE_SERIAL Serial
#define dht_apin D0
ESP8266WiFiMulti WiFiMulti;
BH1750 lightMeter;
dht DHT;


void setup() {

    USE_SERIAL.begin(74880);
   // USE_SERIAL.setDebugOutput(true);

    USE_SERIAL.println();
    USE_SERIAL.println();
    USE_SERIAL.println();

    for(uint8_t t = 4; t > 0; t--) {
        USE_SERIAL.printf("[SETUP] WAIT %d...\n", t);
        USE_SERIAL.flush();
        delay(1000);
    }

    WiFi.mode(WIFI_STA);
    WiFiMulti.addAP("TLU", "");

    Wire.begin();

    lightMeter.begin(); 

}

void loop() {

    /*-------------------------HELI----------------------*/
    float db;
    int val;
    val=analogRead(A0); 
    float voltage = val * (5.0/1023);
    db = 20 * log10(voltage/0.005012);
    //Serial.println(val);
    //
  
  /*-------------------------VALGUS----------------------*/

    uint16_t lux = lightMeter.readLightLevel();
//    Serial.print("Light: ");
//    Serial.print(lux);
//    Serial.println(" lx");

    /*-------------------------TEMP----------------------*/
    DHT.read11(dht_apin);
    
//    Serial.print("Current humidity = ");
//    Serial.print(DHT.humidity);
//    Serial.print("%  ");
//    Serial.print("temperature = ");
//    Serial.print(DHT.temperature); 
//    Serial.println("C  ");
    
    // wait for WiFi connection
    if((WiFiMulti.run() == WL_CONNECTED)) {

        HTTPClient http;

        USE_SERIAL.print("[HTTP] begin...\n");
        // configure traged server and url
        //http.begin("https://192.168.1.12/test.html", "7a 9c f4 db 40 d3 62 5a 6e 21 bc 5c cc 66 c8 3e a1 45 59 38"); //HTTPS
        //String address = "http://sisekliima.000webhostapp.com/write_data.php?value=";
        //String result = address + boost::lexical_cast<std::string>(lux);
        String test = "http://sisekliima.000webhostapp.com/test.html";
        http.begin("http://sisekliima.000webhostapp.com/write_data.php?valgus="+String(lux)+"&ohuniiskus="+String(DHT.humidity)+"&temperatuur="+String(DHT.temperature)); //HTTP 

        USE_SERIAL.print("[HTTP] GET...\n");
        // start connection and send HTTP header
        //http.addHeader("Content-Type", "application/x-www-form-urlencoded");
        int httpCode = http.GET();

        // httpCode will be negative on error
        if(httpCode > 0) {
            // HTTP header has been send and Server response header has been handled
            USE_SERIAL.printf("[HTTP] GET... code: %d\n", httpCode);

            // file found at server
            if(httpCode == HTTP_CODE_OK) {
                String payload = http.getString();
                USE_SERIAL.println(payload);
            }
        } else {
            USE_SERIAL.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
        }

        http.end();
    }

    delay(60000);
}


#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <Arduino_JSON.h>

const char* mp_id = "1";

const char* ssid = "SLT-LTE-WiFi-FA74";
const char* password = "B2QG3FY906E";

unsigned long lastTime = 0;
unsigned long timerDelay = 60000;

String serverName = "http://192.168.1.102:8000/api/";

void setup() {
  Serial.begin(115200);

  WiFi.begin(ssid, password);
  Serial.println("Connecting");

  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");

  Serial.println(WiFi.localIP());
}

void loop() {
  if ((millis() - lastTime) > timerDelay) {
    if(WiFi.status()== WL_CONNECTED){
      int wl = waterLavel();
      Serial.println(wl);
      httpPOSTRequest(serverName,wl);
    }
    else {
      Serial.println("WiFi Disconnected");
    }
    lastTime = millis();
  }
}

int waterLavel(){
  int s1 = analogRead(A0);
  return s1;
}

String httpGETRequest(String serverName) {
  WiFiClient client;
  HTTPClient http;
    
  http.begin(client, serverName);
  
  int httpResponseCode = http.GET();
  
  String payload = "{}"; 
  
  if (httpResponseCode>0) {
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);
    payload = http.getString();
  }
  else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
  }
  // Free resources
  http.end();

  return payload;
}


String httpPOSTRequest(String serverName, int wl) {
  WiFiClient client;
  HTTPClient http;

  Serial.println(serverName + "flood-status");

  http.begin(client, serverName + "flood-status");
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  String httpRequestData = "key=tPmAT5Ab3j7F9&water_level=" + String(wl) + "&monitor_place_id=" + mp_id;       

  int httpResponseCode = http.POST(httpRequestData);
  
  String payload = "{}"; 
  
  if (httpResponseCode>0) {
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);
    payload = http.getString();
  }
  else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
  }

  http.end();

  Serial.println(payload);

  return payload;
}
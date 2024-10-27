#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <Arduino_JSON.h>

const char* mp_id = "1";

const char* ssid = "Apis_Technologies";
const char* password = "APIS1998";

unsigned long lastTime = 0;
unsigned long timerDelay = 60000;

String serverName = "http://192.168.1.141:8000/api/";

#define relay D1
const int 0 = D2;
int waterDropOldValue = 1;

void setup() {
  Serial.begin(115200);

  WiFi.begin(ssid, password);
  Serial.println("Connecting");

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");

  Serial.println(WiFi.localIP());

  Serial.println("Timer set to 5 seconds (timerDelay variable), it will take 5 seconds before publishing the first reading.");
  pinMode(relay, OUTPUT);
  pinMode(waterDropSensorPin, INPUT);
  digitalWrite(relay, LOW);
}

void loop() {

  if ((millis() - lastTime) > timerDelay) {
    int waterDropValue = digitalRead(waterDropSensorPin);

    if (waterDropOldValue != waterDropValue) {
      if (waterDropValue == 1) {
        digitalWrite(relay, LOW);
        Serial.print("Water Drop Sensor Value: ");
        Serial.println(waterDropValue);
      } else {
        digitalWrite(relay, HIGH);
        Serial.print("Water Drop Sensor Value: ");
        Serial.println(waterDropValue);
      }
      waterDropOldValue = waterDropValue;
    }

    if (WiFi.status() == WL_CONNECTED) {
      int wl = waterLavel();
      Serial.println(wl);
      httpPOSTRequest(serverName, wl);
    } else {
      Serial.println("WiFi Disconnected");
    }
    lastTime = millis();
  }
}

int waterLavel() {
  int s1 = analogRead(A0);
  return s1;
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

  if (httpResponseCode > 0) {
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);
    payload = http.getString();
  } else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
  }

  http.end();

  Serial.println(payload);

  return payload;
}
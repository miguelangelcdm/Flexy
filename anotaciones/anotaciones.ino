#include <WiFi.h>
#include <PubSubClient.h>
#include <ArduinoJson.h>
#include <iostream>
#include <cstdlib> // Para rand() y srand()
#include <ctime>   // Para time()
#include <NTPClient.h>
#include <WiFiUdp.h>

// Define el cliente UDP
WiFiUDP ntpUDP;

// Configura el cliente NTP con un servidor NTP y un desfase horario
NTPClient timeClient(ntpUDP, "pool.ntp.org", 0, 60000); // 0 es la diferencia horaria en segundos, 60000 es el intervalo de actualización en milisegundos

String formattedDateTime; // Variable para almacenar la fecha y hora formateada

const int arraySize = 10;
int valores[arraySize];

double ph = 0;
double temperatura = 0;
double conductividad = 0;
double oxigenoDisuelto = 0; 

// Variables para MQTT y WiFi
const char* ssid = "FAMILIACASTRO";
const char* password = "password";

const char* mqtt_server = "broker.emqx.io";
int port = 1883;
// const char* mqtt_server = "k6e69211.ala.us-east-1.emqxsl.com";
// int port = 8084;

int var;
String resultS="";
char datos[40];
char datos2[40];

WiFiClient espClient;
PubSubClient client(espClient);

long duration;
int distance;
long duration2;
int distance2;

// Función para conectar a la red WiFi
void setup_wifi() {
  delay(10);
  Serial.println();
  Serial.print("Conectando a ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi conectado");
  Serial.println("Dirección IP: ");
  Serial.println(WiFi.localIP());
}

void callback (char* topic, byte* payload, unsigned int length) {
  Serial.print("Mensaje recibido [");
  Serial.print(topic);
  Serial.print("]: ");

  char payload_string[length + 1];
  int resultI;

  memcpy (payload_string, payload, length);
  payload_string[length]='\0';

  resultI= atoi(payload_string);

  var = resultI;

  resultS = "";

  for (int i=0; i<length; i++){
    resultS = resultS + (char)payload[i];
  }

  Serial.println();
} 
    

// Función para reconectar al broker MQTT
void reconnect() {
  while (!client.connected()) {
    Serial.print("Intentando conectar al broker MQTT...");
    if (client.connect("ESP32Client")) {
      Serial.println("conectado");
      client.subscribe("entrada/01");
    } else {
      Serial.print("fallo, rc=");
      Serial.print(client.state());
      Serial.println(" intentando de nuevo en 5 segundos");
      delay(5000);
    }
  }
}

void setup() {
  Serial.begin(115200);
  setup_wifi();
  client.setServer(mqtt_server, port);
  client.setCallback(callback);
  // Semilla para el generador de números aleatorios
  randomSeed(analogRead(0));
  timeClient.begin();
  
  // Llenar el arreglo con valores aleatorios entre 2500 y 5000
  for (int i = 0; i < arraySize; i++) {
    valores[i] = random(2500, 5001);
  }
}

void data(){
  randomSeed(analogRead(0));
  ph = random(0, 1401) / 100.0;
  int indiceAleatorio = random(0, arraySize);
  temperatura = 15;
  conductividad = valores[indiceAleatorio];
  oxigenoDisuelto = random(0, 1501) / 100.0;

}

void loop() {
  if (!client.connected()) {
    reconnect();
  }
  client.loop();

  Serial.print("String: " );
  Serial.println(resultS);

  data();

  JsonDocument doc;

  doc["Dispositivo"] = "ESP32";
  doc["Id"] = 1;
  doc["Timestamp"] = "2024-06-01 05:00:57";

  JsonObject Data = doc["Data"].to<JsonObject>();
  Data["Ph"] = ph;
  Data["Temperatura"] = temperatura;
  Data["Conductividad"] = conductividad;
  Data["OxigenoDisuelto"] = oxigenoDisuelto;

  //String output;
  char output[512];

  doc.shrinkToFit();  // optional

  serializeJson(doc, output);

  client.publish("salida/01", output);

  Serial.println("Mensaje enviado correctamente");

  delay(5000);
}

#include "ESP8266WiFi.h"
#include "WiFiClient.h" 
#include "ESP8266WebServer.h"
#include "ESP8266HTTPClient.h"

#include <DHT.h>
#include <Wire.h>    // I2C library
#include "ccs811.h"  // CCS811 library
#include <ArduinoJson.h>

/**************Networks*****************/
//const char* ssid = "SKYbroadband9987";      
//const char* password = "621501260";  
//const char *host = "192.168.0.15"; 

//const char* ssid = "PLDTHOMEFIBR_1efcf8";      
//const char* password = "wlane10307";  
//const char* host = "192.168.1.13";

//const char* ssid = "PLDTHOMEFIBR462c8";      
//const char* password = "PLDTWIFIkUF8s";  
//const char* host = "192.168.1.8"; 

//const char* ssid = "PLDT_OmpadEXT";      
//const char* password = "wlane10307";  
//const char *host = "192.168.1.14"; 

const char* ssid = "Arduino";      
const char* password = "12345678";  
const char *host = "192.168.43.210"; 

//const char* ssid = "WABZS_2";           
//const char* password = "fadedbabe9876543210b00b07e";       
//const char* host = "192.168.0.171";      

//const char* ssid = "Arduino";      
//const char* password = "12345678";  
//const char *host = "192.168.43.210"; 

/******************************************************************************************/

//Soil Moisture Sensor config
int analogPin = 17;     //Must be connected to A0 pin

//DHT22 Temperature Sensor config
const int DHTPIN = 12; //D6 pin
#define DHTTYPE DHT22 //DHT22 sensor

DHT dht(DHTPIN, DHTTYPE);   

// Wiring for ESP8266 NodeMCU boards: VDD to 3V3, GND to GND, SDA to D2, SCL to D1, nWAKE to D3 (or GND)
CCS811 ccs811(D3); // nWAKE on D3

//Solenoid VALVEpin pin
const int VALVEpin = 14;     //Must be connected to D5 pin

//GSM module pins
const int GSMpin = 13; //Must be connected to d7
//Other pins
//const int LEDpin = 13; //LEDpin pin D7

//activation status
int status= 0;

void setup() {

    delay(1000);
    Serial.begin(9600);
    
  /****************************LEDpin Setup****************************/ 
    //pinMode(LEDpin, OUTPUT);
    //digitalWrite(LEDpin, LOW);
  /****************************Soil Moisture Setup****************************/
    pinMode(analogPin, INPUT);
  /****************************DHT Sensor Setup****************************/
    dht.begin();    
  /****************************VALVEpin Pin Setup****************************/
    pinMode(VALVEpin, OUTPUT);
  /****************************WiFi Setup***************************/
    WiFi.mode(WIFI_OFF);                         //Prevents reconnection issue (taking too long to connect)
    delay(1000);
    WiFi.mode(WIFI_STA);                         //Hides the viewing of ESP as WiFi hotspot
    
    WiFi.begin(ssid, password);                  //Connect to your WiFi router
    Serial.println("");
  
    Serial.print("Connecting");
    while (WiFi.status() != WL_CONNECTED){       // Wait for connection
      delay(250);
      Serial.print(".");
      delay(250);
    }
    
    //If connection successful show IP address in serial monitor
    Serial.println("");
    Serial.println("Connected to Network/SSID");
    Serial.print("IP address: ");
    Serial.println(WiFi.localIP());              //IP address assigned to ESP    
      
    /****************************GSM Setup***************************/
//    pinMode(GSMpin, OUTPUT);
//    digitalWrite(GSMpin, HIGH);
//    delay(1000);
//    digitalWrite(GSMpin, LOW);
//    delay(5000);
    
    // Enable I2C
      Wire.begin(); 
      
      // Enable CCS811
      ccs811.set_i2cdelay(50); // Needed for ESP8266 because it doesn't handle I2C clock stretch correctly
      bool ok= ccs811.begin();
      if( !ok ) Serial.println("setup: CCS811 begin FAILED");
    
      // Print CCS811 versions
      Serial.print("setup: hardware    version: "); Serial.println(ccs811.hardware_version(),HEX);
      Serial.print("setup: bootloader  version: "); Serial.println(ccs811.bootloader_version(),HEX);
      Serial.print("setup: application version: "); Serial.println(ccs811.application_version(),HEX);
      
      // Start measuring
      ok= ccs811.start(CCS811_MODE_1SEC);
      if( !ok ) Serial.println("setup: CCS811 start FAILED");
    }

void loop() {
          /****************************Soil Moisture Reading****************************/
          String postData, moistureVal;
          int soilMoist = analogRead(analogPin);  
          
          int percentVal, percentValAbs;
          percentVal = (soilMoist-110)*100/(1023-110);
          
          percentValAbs =abs(percentVal - 100);
          moistureVal = percentValAbs;
          postData = "moisturevalue=" + moistureVal;

          Serial.println("Soil Moisture=" + moistureVal + "%");

          /****************************Temperature and Humidity Reading****************************/
          
          float humiSensorVal = dht.readHumidity();         //Read Humidity
          float tempSensorVal = dht.readTemperature();      // Read temperature as Celsius
                        
          String temperatureVal, humidityVal;            
          temperatureVal = tempSensorVal;
          humidityVal = humiSensorVal;
          
          Serial.println("Temperature= " + temperatureVal);
          Serial.println("Humidity=" + humidityVal);
            
          //postData += "&temperaturevalue=" +  temperatureVal + "&humidityvalue=" + humidityVal;
          postData += "&temperaturevalue=" +  temperatureVal + "&humidityvalue=" + humidityVal;
          
          /****************************Co2 Reading****************************/
          // Read
          uint16_t eco2, etvoc, errstat, raw;
          ccs811.read(&eco2,&etvoc,&errstat,&raw); 
          String carbondioxideVal;
            
            // Print measurement results based on status
          if( errstat==CCS811_ERRSTAT_OK ) { 
            Serial.print("CCS811: ");
            Serial.print("eco2=");  Serial.print(eco2);     Serial.print(" ppm  ");
            //Serial.print("etvoc="); Serial.print(etvoc);    Serial.print(" ppb  ");

            carbondioxideVal = eco2;
              
            //Serial.print("raw6=");  Serial.print(raw/1024); Serial.print(" uA  "); 
            //Serial.print("raw10="); Serial.print(raw%1024); Serial.print(" ADC  ");
            //Serial.print("R="); Serial.print((1650*1000L/1023)*(raw%1024)/(raw/1024)); Serial.print(" ohm");
            //Serial.println();
          } else if( errstat==CCS811_ERRSTAT_OK_NODATA ) {
            carbondioxideVal = -1;
            Serial.println("CCS811: waiting for (new) data");
          } else if( errstat & CCS811_ERRSTAT_I2CFAIL ) {
            carbondioxideVal = -1; 
            Serial.println("CCS811: I2C error");
          } else {
            carbondioxideVal = -1;
            Serial.print("CCS811: errstat="); Serial.print(errstat,HEX); 
            Serial.print("="); Serial.println( ccs811.errstat_str(errstat) ); 
          }
          
          postData += "&carbondioxidevalue=" + carbondioxideVal;
  
          /****************************Sending Sensor Data to WebServer****************************/
          HTTPClient http;
//        http.begin("http://192.168.43.210:80/basics/insertSensorValue.php");      //rj                   
//        http.begin("http://192.168.0.171:80/trinkle/pages/sensor_reading");//bryle  
          http.begin("http://192.168.43.210:80/trinkle/pages/sensor_reading");  //rj     
//        http.begin("http://192.168.1.13:80/trinkle/pages/sensor_reading");//rj   
//        http.begin("http://192.168.1.4:80/trinkle/pages/sensor_reading"); //rj
//        http.begin("http://192.168.0.15:80/trinkle/pages/sensor_reading");         
          http.addHeader("Content-Type", "application/x-www-form-urlencoded");
          
          int httpCode = http.POST(postData);      //Send the request
          String payload = http.getString();      //Get the response payload
          //Serial.println("HTTP Code: " + httpCode);              //Print HTTP return code
          Serial.println("Response: " + payload);               //Print request response payload

          /****************************Valve Activation****************************/
          
          /****************************Json parser*********************************/
          // Allocate JsonBuffer
          // Used arduinojson.org/assistant to compute the capacity
            int firstBrace = payload.indexOf('{');
            int secondBrace = payload.indexOf('}');
            //if(firstBrace > 0 && secondBrace > 0){
              String jsonObject = payload.substring(firstBrace, secondBrace+1);
              payload.remove(firstBrace);
              payload.trim();
              int size = payload.toInt();
            //}
          
          const size_t capacity = JSON_ARRAY_SIZE(size) + JSON_OBJECT_SIZE(4) + 280;
          DynamicJsonDocument doc(capacity);

         // Parse JSON object
          DeserializationError err = deserializeJson(doc, jsonObject);
                    
          if (err) {
            Serial.print(F("deserializeJson() failed with code "));
            Serial.println(err.c_str());
          }else{
            bool valve = doc["valve"]; // boolean      
            bool sms = doc["sms"]; // boolean
            JsonArray phone_number = doc["phone_number"];
            bool carboncheck = doc["carboncheck"];
            
            if(valve){
              //digitalWrite(LEDpin, HIGH);
              digitalWrite(VALVEpin, LOW);    //Switch Solenoid ON
              if(sms ){
                  
                for(int x=0; x < size; x++){
                  const char* phone_number_string = phone_number[x];
                  Serial.print("AT");  //Start Configuring GSM Module
                  delay(1000);         //One second delay
                  Serial.println();
                  Serial.println("AT+CMGF=1");  // Set GSM in text mode
                  delay(1000);                  // One second delay
                  Serial.println();
                  Serial.print("AT+CMGS=");     // Enter the receiver number
                  Serial.print("\"+63");
                  Serial.print(phone_number_string);
                  Serial.print("\"");
                  Serial.println();
                  delay(1000);
                  Serial.print("Trinkle has been activated");
                  delay(1000);
                  Serial.println();
                  Serial.write(26);  
                }

                //status++; 
              }

            }else{
             //digitalWrite(LEDpin, LOW);  
             digitalWrite(VALVEpin, HIGH);    //Switch Solenoid OFF 
             status = 0;
            }

            if(carboncheck){
              if(sms ){
                  
                for(int x=0; x < size; x++){
                  const char* phone_number_string = phone_number[x];
                  Serial.print("AT");  //Start Configuring GSM Module
                  delay(1000);         //One second delay
                  Serial.println();
                  Serial.println("AT+CMGF=1");  // Set GSM in text mode
                  delay(1000);                  // One second delay
                  Serial.println();
                  Serial.print("AT+CMGS=");     // Enter the receiver number
                  Serial.print("\"+63");
                  Serial.print(phone_number_string);
                  Serial.print("\"");
                  Serial.println();
                  delay(1000);
                  Serial.print("Carbon Dioxide level is low");
                  delay(1000);
                  Serial.println();
                  Serial.write(26);  
                }
              }
          }
       }

          http.end();  //Close connection
          
          delay(2000);
}

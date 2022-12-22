/* This sketch uses the SoftwareSerial and TinyGPS++ libraries to communicate with the GPS and GSM modules. The GPS module is connected to the Arduino's RX and TX pins, while the GSM module is connected to the designated RX and TX pins (in this case, 7 and 8).

In the setup() function, the sketch initializes the SIM800L and sets it to GPRS mode*/
#include <SoftwareSerial.h>
#include <TinyGPS++.h>

const int RXPin = 7;  // RX pin for SIM800L
const int TXPin = 8;  // TX pin for SIM800L

SoftwareSerial SIM800L(RXPin, TXPin);  // Create software serial object for SIM800L
TinyGPSPlus gps;  // Create object for GPS

void setup() {
  SIM800L.begin(9600);  // Set baud rate for SIM800L
  Serial.begin(9600);  // Set baud rate for serial monitor

  // Initialize SIM800L and wait for it to be ready
  SIM800L.println("AT");
  delay(1000);
  SIM800L.println("AT+CPIN?");
  delay(1000);
  SIM800L.println("AT+CREG?");
  delay(1000);

  // Set GPRS mode and APN
  SIM800L.println("AT+SAPBR=3,1,\"CONTYPE\",\"GPRS\"");
  delay(1000);
  SIM800L.println("AT+SAPBR=3,1,\"APN\",\"airtelgprs.com\"");  // Replace "your_apn" with your APN
  delay(1000);
  SIM800L.println("AT+SAPBR=1,1");
  delay(3000);
}

void loop() {
  // Read GPS data
  while (Serial.available()) {
    if (gps.encode(Serial.read())) {
      if (gps.location.isValid()) {
        // Get latitude and longitude
        float latitude = gps.location.lat();
        float longitude = gps.location.lng();

        // Send HTTP GET request with location data
        SIM800L.println("AT+HTTPINIT");  // Initialize HTTP service
        delay(1000);
        SIM800L.println("AT+HTTPPARA=\"CID\",1");  // Set CID parameter
        delay(1000);
        SIM800L.print("AT+HTTPPARA=\"URL\",\"http://forestfiresystem.tech/trial_final__.php?lat=");  // Set URL parameter
        SIM800L.print(latitude);
        SIM800L.print("&lng=");
        SIM800L.print(longitude);
        SIM800L.print("&truckid=GJ01SSIP001");
        SIM800L.println("\"");
        delay(1000);
        SIM800L.println("AT+HTTPACTION=0");  // Send HTTP GET request
        delay(3000);
        SIM800L.println("AT+HTTPTERM");  // Terminate HTTP service
        delay(1000);
      }
    }
  }
}

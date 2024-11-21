#define ledRed 2
#define ledGreen 7

void setup() {
  
pinMode(ledRed, OUTPUT);
pinMode(ledGreen, OUTPUT);
}

void loop() {
  
digitalWrite(ledRed, HIGH);
delay(2000);
digitalWrite(ledRed, LOW);
digitalWrite(ledGreen, HIGH);
delay(2000);
digitalWrite(ledGreen, LOW);
}

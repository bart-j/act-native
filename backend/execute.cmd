@echo off
set CLASSPATH=C:\xampp\htdocs\act-native\backend\target\classes
set CLASSPATH=%CLASSPATH%;C:\xampp\htdocs\act-native\backend\lib\antlr-4.6-complete.jar
set CLASSPATH=%CLASSPATH%;C:\xampp\htdocs\act-native\backend\lib\slf4j-nop-1.7.18.jar
set CLASSPATH=%CLASSPATH%;C:\xampp\htdocs\act-native\backend\lib\kie-api-6.3.0.Final.jar
set CLASSPATH=%CLASSPATH%;C:\xampp\htdocs\act-native\backend\lib\drools-compiler-6.3.0.Final.jar
set CLASSPATH=%CLASSPATH%;C:\xampp\htdocs\act-native\backend\lib\slf4j-api-1.7.2.jar
set CLASSPATH=%CLASSPATH%;C:\xampp\htdocs\act-native\backend\lib\drools-core-6.3.0.Final.jar
set CLASSPATH=%CLASSPATH%;C:\xampp\htdocs\act-native\backend\lib\kie-internal-6.3.0.Final.jar
set CLASSPATH=%CLASSPATH%;C:\xampp\htdocs\act-native\backend\lib\xstream-1.4.7.jar
set CLASSPATH=%CLASSPATH%;C:\xampp\htdocs\act-native\backend\lib\org.eclipse.jdt.core_3.11.0.v20140806-1653.jar
set CLASSPATH=%CLASSPATH%;C:\xampp\htdocs\act-native\backend\lib\mvel2-2.2.6.Final.jar
set CLASSPATH=%CLASSPATH%;C:\xampp\htdocs\act-native\backend\lib\protobuf-java-2.5.0.jar

java com.fokkenrood.antlr.Interpreteer "C:\xampp\htdocs\act-native\backend\data\ProfielSpraak.txt" "%1" "%2"
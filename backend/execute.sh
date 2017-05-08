#!/bin/bash
export CLASSPATH=/app/backend/target
export CLASSPATH=$CLASSPATH:/app/backend/lib/antlr-4.6-complete.jar
export CLASSPATH=$CLASSPATH:/app/backend/lib/slf4j-nop-1.7.18.jar
export CLASSPATH=$CLASSPATH:/app/backend/lib/kie-api-6.3.0.Final.jar
export CLASSPATH=$CLASSPATH:/app/backend/lib/drools-compiler-6.3.0.Final.jar
export CLASSPATH=$CLASSPATH:/app/backend/lib/slf4j-api-1.7.2.jar
export CLASSPATH=$CLASSPATH:/app/backend/lib/drools-core-6.3.0.Final.jar
export CLASSPATH=$CLASSPATH:/app/backend/lib/kie-internal-6.3.0.Final.jar
export CLASSPATH=$CLASSPATH:/app/backend/lib/xstream-1.4.7.jar
export CLASSPATH=$CLASSPATH:/app/backend/lib/org.eclipse.jdt.core_3.11.0.v20140806-1653.jar
export CLASSPATH=$CLASSPATH:/app/backend/lib/mvel2-2.2.6.Final.jar
export CLASSPATH=$CLASSPATH:/app/backend/lib/protobuf-java-2.5.0.jar

java com.fokkenrood.antlr.Interpreteer "$1" "$2" "$3"
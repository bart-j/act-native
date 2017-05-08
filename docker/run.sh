#!/bin/sh

echo "[i] Starting daemon..."
apachectl start

# display logs
tail -F /var/log/apache2/*log
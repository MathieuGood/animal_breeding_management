#!/bin/bash

echo "Starting population evolution for Breeding Manager"

while true; do

    current_time=$(date +%Y-%m-%d' '%H:%M:%S)
    echo "Updated population on" $current_time 
    
    php components/let_population_evolve.php

    sleep 1

done

#!/bin/bash

echo "Starting population evolution for Breeding Manager"

while true; do
    echo 
    current_time=$(date +%Y-%m-%d' '%H:%M:%S)
    echo "Updated population on" $current_time 

    sleep 2
    
    php components/let_population_evolve.php

done

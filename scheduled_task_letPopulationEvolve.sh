#!/bin/bash

# Script to automate animal matings

echo "Starting population evolution for Breeding Manager"


while true; do

    # Print current time
    current_time=$(date +%Y-%m-%d' '%H:%M:%S)
    echo "Updated population on" $current_time 
    
    # Launch let_population_evolve.php script
    php components/let_population_evolve.php

    # Wait 1 second before restarting the loop
    sleep 1

done

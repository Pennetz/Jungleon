#!/bin/bash

while true; do
    for i in {1..12}; do
        echo ciao
        sleep 600
    done
    read -p "Vuoi continuare? (s/n): " risposta
    case "$risposta" in
        [Ss]) continue ;;
        *) break ;;
    esac
done
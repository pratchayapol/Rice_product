#!/bin/bash
set -e

echo "Starting training model..."
rasa train

echo "Starting Rasa server..."
rasa run --enable-api --cors '*' --debug

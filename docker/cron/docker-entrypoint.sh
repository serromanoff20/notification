#!/bin/bash
date >> "cron-log.txt";

set -- sudo docker exec service-ipu_php813 php "$@"

exec "$@"

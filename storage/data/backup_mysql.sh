#!/bin/bash
#

mysqldump -uwww -p -h 127.0.0.1 --databases "www_broqiang_com" > www_broqiang_com_$(date +%Y-%m-%d).sql

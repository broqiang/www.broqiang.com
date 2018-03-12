#!/bin/bash
#

mysqldump -uwww -p --databases "www_broqiang_com" > www_broqiang_com_$(date +%Y-%m-%d).sql

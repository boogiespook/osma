#!/bin/ksh

id=$1
name=$2
/usr/bin/php /var/www/html/osma/getClientHistory2.php $id > ${name}.html 
#/bin/wkhtmltopdf -q client${id}.html client${id}.pdf 


#/opt/libreoffice4.0/program/swriter --headless --infilter=HTML -convert-to pdf:"writer_web_pdf_Export" client${id}.html

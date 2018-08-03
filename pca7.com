server{
    listen 80;
    server_name www.pca7.com pca7.com;
    rewrite ^(.*)$  https://$host$1 permanent;
}

server{
    listen 443;
    server_name www.pca7.com;

    ssl on;
    root /var/www/pca7.com/public;
    index index.html index.htm index.php;


    ssl_certificate   cert/www.pca7.com.pem;
    ssl_certificate_key  cert/www.pca7.com.key;
    ssl_session_timeout 5m;
    ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE:ECDH:AES:HIGH:!NULL:!aNULL:!MD5:!ADH:!RC4;
    ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
    ssl_prefer_server_ciphers on;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log /var/log/nginx/pca7-access.log;
    error_log  /var/log/nginx/pca7-error.log error;

    sendfile off;

    client_max_body_size 100m;

    include fastcgi.conf;

    location ~ /\.ht {
        deny all;
    }

    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }
}

server{
    listen 443;
    server_name img.pca7.com;

    ssl on;
    root /var/www/pca7.com/public;
    index index.html index.htm index.php;


    ssl_certificate   cert/img.pca7.com.pem;
    ssl_certificate_key  cert/img.pca7.com.key;
    ssl_session_timeout 5m;
    ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE:ECDH:AES:HIGH:!NULL:!aNULL:!MD5:!ADH:!RC4;
    ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
    ssl_prefer_server_ciphers on;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log /var/log/nginx/pca7-access.log;
    error_log  /var/log/nginx/pca7-error.log error;

    sendfile off;

    client_max_body_size 100m;

    include fastcgi.conf;

    location ~ /\.ht {
        deny all;
    }

    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }
}

server
{
listen 80 default_server;
server_name _;
return 444;
}
server
{
    listen 443 default_server;
server_name _;
ssl on;
    ssl_certificate   cert/img.pca7.com.pem;
    ssl_certificate_key  cert/img.pca7.com.key;

rewrite ^(.*)$  https://$host$1 permanent;
}


# Dockerfile

# Sử dụng PHP 8.3.14 với Apache
FROM php:8.3.14-apache

# Copy mã nguồn PHP vào container
COPY php/ /var/www/html/

# Cấp quyền cho thư mục web
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Cài đặt thêm extension PHP nếu cần (MySQL, PDO)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Mở cổng 80 của container
EXPOSE 80

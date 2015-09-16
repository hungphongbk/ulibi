## Ulibi
Dự án Web site tổng hợp và chia sẻ thông tin dành cho các bạn trẻ yêu thích du lịch bụi.

Ngôn ngữ và framework được sử dụng để thiết kế trang web:

1. PHP, MySQL, framework Laravel.
2. HTML/CSS/JS, framework jQuery & AngularJS.
3. Thiết kế giao diện theo phong cách Material Design của Google.

## Phần mềm cần chuẩn bị

XAMPP, NodeJS

## Khởi tạo cơ sở dữ liệu

Chạy chương trình XAMPP, đảm bảo rằng MySql đã khởi chạy thành công.

Truy cập vào [http://localhost/phpmyadmin](http://localhost/phpmyadmin) > tab Databases, tạo một CSDL mới với tên Ulibi và collation là UTF8_bin

## Cài đặt

Tải bộ cài framework Composer cho windows tại [đây](https://getcomposer.org/Composer-Setup.exe). Trước khi cài đặt đảm bảo rằng bạn đã tắt tất cả các cửa sổ Command prompt hiện đang mở.

Kiểm tra việc cài đặt đã thành công hay chưa bằng cách mở Command Prompt (nên mở với quyền Administrator để cài đặt một số thứ sau này) và chạy lệnh:
```dos
> composer -V
Composer version 27d8904
```

Cài đặt gói thư viện bower
```dos
> npm install -g bower
```

Mở file .env ngay trong thư mục gốc Ulibi, để ý thấy có hai dòng *DB_USERNAME* và *DB_PASSWORD*, nên để username là root (để có toàn quyền truy cập vào database Ulibi, hoặc một user khác đã được cấp full quyền cũng được) và password là password tương ứng với username đó.

CD đến thư mục này (Ulibi). Chạy lần lượt các lệnh sau để khởi tạo toàn bộ project, tạo các bảng và một số dữ liệu mẫu cần thiết:
```dos
> bower install
> bower update
> composer install
> composer update
> composer run-script pre-init-db
```

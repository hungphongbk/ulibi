## Ulibi
Dự án Web site tổng hợp và chia sẻ thông tin dành cho các bạn trẻ yêu thích du lịch bụi.

Ngôn ngữ và framework được sử dụng để thiết kế trang web:

1. PHP, MySQL, framework Laravel.
2. HTML/CSS/JS, framework jQuery & AngularJS.
3. Thiết kế giao diện theo phong cách Material Design của Google.

## Phần mềm cần chuẩn bị

XAMPP, NodeJS

## Cài đặt

Tải bộ cài framework Composer cho windows tại [đây](https://getcomposer.org/Composer-Setup.exe). Trước khi cài đặt đảm bảo rằng bạn đã tắt tất cả các cửa sổ Command prompt hiện đang mở.

Kiểm tra việc cài đặt đã thành công hay chưa bằng cách mở Command Prompt (nên mở với quyền Administrator để cài đặt một số thứ sau này) và chạy lệnh:
```dos
>composer -V
Composer version 27d8904
```

Cài đặt gói thư viện bower
```dos
>npm install -g bower
```

Chạy lần lượt các lệnh sau để khởi tạo toàn bộ project
```dos
>npm update
>bower update
>composer update


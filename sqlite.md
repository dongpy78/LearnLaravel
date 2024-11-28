## Các Lệnh trong cơ sở dữ liệu SQLITE

-   Mở SQLite shell bằng cách nhập lệnh sau trong thư mục có cơ sở dữ liệu:

```sh
sqlite3 database.sqlite
```

-   Để liệt kê tất cả các bảng trong cơ sở dữ liệu SQLite, bạn dùng lệnh sau:

```sh
.tables
```

-   Xem cấu trúc của một bảng cụ thể:

```sh
.schema <tên_bảng>
```

-   Nếu bạn muốn xem dữ liệu trong bảng, bạn có thể sử dụng câu lệnh SQL SELECT:

```sh
SELECT * FROM <tên_bảng>;
```

-   Để thoát khỏi SQLite shell, bạn có thể dùng lệnh:

```sh
.exit
```

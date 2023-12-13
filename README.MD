File này chỉ đọc ở trên local
Thư mục gốc
|   index.php                           -> Trang chủ Dự án
                                        URL: http://localhost/DuAnMot/index.php
|   dsadasdasdasdc file resources (CSS, JS, Images, Videos, ...)
|   +---backend                         -> Thư mục chứa các file resources dành cho Backend (Admin)
|   |   +---css
|   |   |       style-print.css
|   |   |       style.css
|   |   |       
|   |   \---js
|   |           app.js
|   |           
|   +---frontend                        -> Thư mục chứa các file resources dành cho Frontend (Client / Customer / Viewer)
|   |   +---css
|   |   |       style.css
|   |   |       
|   |   +---img
|   |   |       icon-1.png
|   |   |       icon-2.png
|   |   |       icon-3.png
|   |   |       marketing-1.png
|   |   |       marketing-2.png
|   |   |       slider-1.jpg
|   |   |       slider-2.jpg
|   |   |       slider-3.jpg
|   |   |       
|   |   \---js
|   |           app.js
|   |           
|   +---shared                          -> Thư mục chứa các file resources dùng chung cho cả Backend và Frontend
|   |   \---img
|   |           default-image_600.png
|   |           logo-nentang.jpg
|   |           
|   +---uploads                         -> Thư mục chứa các file do người dùng (End user / Customer / ...) upload lên Server
|   |       
|   \---vendor                          -> Thư mục chứa các thư viện Frontend
|       +---bootstrap
|       +---jquery
+---backend                             -> Thư mục chứa các file PHP xử lý nghiệp vụ dành cho Backend
                                        URL: http://localhost/DuAnMot/backend/index.php
|       index.php
|       
\---frontend                            -> Thư mục chứa các file PHP xử lý nghiệp vụ dành cho Frontend
    |   index.php                       -> URL: http://localhost/DuAnMot/frontend/index.php
    |   
    \---pages
            dangky.php                  -> URL: http://localhost/DuAnMot/frontend/pages/dangky.php
            dangkythanhcong.php         -> URL: http://localhost/DuAnMot/frontend/pages/dangkythanhcong.php
            dangnhap.php                -> URL: http://localhost/DuAnMot/frontend/pages/dangnhap.php
            dangxuat.php                -> URL: http://localhost/DuAnMot/frontend/pages/dangxuat.php
            gioithieu.php               -> URL: http://localhost/DuAnMot/frontend/pages/gioithieu.php
            lienhe.php                  -> URL: http://localhost/DuAnMot/frontend/pages/lienhe.php
            timkiem.php                 -> URL: http://localhost/DuAnMot/frontend/pages/timkiem.php
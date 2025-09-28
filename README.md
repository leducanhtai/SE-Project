# Linglooma Writing

Linglooma Writing là một ứng dụng luyện thi IELTS thông minh, hỗ trợ chấm điểm tự động cho kỹ năng **Writing** (và **Speaking**), cung cấp phản hồi cá nhân hóa và theo dõi tiến độ học tập.
<img width="2559" height="1431" alt="image" src="https://github.com/user-attachments/assets/835ba177-3aa0-4be7-b206-6ede75b17165" />



---

## ✨ Tính năng nổi bật

* **Luyện tập Writing theo đề thi thật**: Chọn Part, làm bài trực tiếp trên web, giới hạn thời gian và số từ.
<img width="2559" height="1432" alt="image" src="https://github.com/user-attachments/assets/36dfca4a-1508-4170-9b5c-d086ee75e9eb" />
<img width="2559" height="1443" alt="image" src="https://github.com/user-attachments/assets/78d59da0-1ba6-4120-9f38-43c7a95da7cc" />

* **Chấm điểm AI tự động**: Điểm số chính xác theo tiêu chí IELTS, phản hồi chi tiết từng tiêu chí (*Coherence, Grammar, Vocabulary*).
* <img width="1869" height="667" alt="Screenshot 2025-09-28 141258" src="https://github.com/user-attachments/assets/7b8d0fb7-6913-4805-ae5d-0fa353625108" />
<img width="2018" height="1059" alt="Screenshot 2025-09-28 141321" src="https://github.com/user-attachments/assets/fa342cf0-f558-4e00-b906-bd1d9068fd3b" />
* **Giao diện hiện đại, dễ sử dụng**: Responsive, hỗ trợ cả desktop và mobile.
* **Tích hợp Laravel Dusk**: Kiểm thử giao diện tự động.

---

## ⚙️ Công nghệ sử dụng

* **Backend**: Laravel (PHP)
* **Frontend**: Blade, TailwindCSS, Vite, React (tùy module)
* **Database**: MySQL
* **AI Scoring**: Tích hợp Azure OpenAI API
* **Testing**: PHPUnit, Laravel Dusk

---

## 🚀 Cài đặt

Clone project:

```bash
git clone https://github.com/linglooma/linglooma-writing.git
cd linglooma-writing
```

Cài đặt các package:

```bash
composer install
npm install
```

Cấu hình môi trường:

```bash
cp .env.example .env
```

Chỉnh sửa file `.env` để cập nhật thông tin:

* Kết nối DB
* API key Azure OpenAI

Chạy migration và seed dữ liệu mẫu:

```bash
php artisan migrate --seed
```

Build frontend:

```bash
npm run build
```

Khởi động server:

```bash
php artisan serve
```

Truy cập ứng dụng:
👉 [http://localhost:8000](http://localhost:8000)

---

## 🧪 Chạy test

Test backend:

```bash
php artisan test
```

Test giao diện với Dusk:

```bash
php artisan dusk
```

---

## 📂 Cấu trúc thư mục

```plaintext
linglooma-writing/
├── app/
│   ├── Console/
│   ├── Exceptions/
│   ├── Http/
│   │   ├── Controllers/     # Controllers xử lý logic
│   │   ├── Middleware/
│   ├── Models/              # Eloquent Models
│
├── bootstrap/
├── config/
├── database/
│   ├── factories/           # Factory cho test
│   ├── migrations/          # Migration DB
│   ├── seeders/
│
├── public/
├── resources/
│   ├── js/                  # React / Vite modules
│   ├── views/               # Giao diện Blade
│   ├── css/
│
├── routes/
│   ├── web.php
│   ├── api.php
│
├── tests/
│   ├── Feature/             # Test tính năng backend
│   ├── Browser/             # Test tự động với Dusk
│
├── .env.example
├── artisan
├── composer.json
├── package.json
└── vite.config.js
```

---

## 🤝 Đóng góp

1. Fork và tạo branch mới
2. Commit thay đổi, push lên branch
3. Tạo pull request với mô tả rõ ràng về tính năng/bugfix

---

## 📞 Liên hệ

* **Website**: [Linglooma](https://linglooma.com)
* **Email**: [support@linglooma.com](mailto:support@linglooma.com)

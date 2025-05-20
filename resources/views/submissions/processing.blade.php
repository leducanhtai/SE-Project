<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đang chấm điểm...</title>
    <script>
        setInterval(async function () {
            const res = await fetch('/api/submission-status/{{ $submissionId }}');
            const data = await res.json();
            if (data.status === 'done') {
                window.location.href = '/submission/{{ $submissionId }}';
            }
        }, 3000);
    </script>
</head>
<body style="text-align:center;padding-top:100px;font-family:sans-serif;">
    <h1>📝 Đang chấm điểm bài viết của bạn...</h1>
    <p>Vui lòng đợi trong giây lát...</p>
    <div class="loader" style="margin-top:30px;">
        <div style="width:40px;height:40px;border:5px solid #ccc;border-top-color:#333;border-radius:50%;animation:spin 1s linear infinite;"></div>
    </div>
    <style>
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</body>
</html>

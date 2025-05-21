<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đang chấm điểm...</title>
    <style>
        body {
            text-align: center;
            padding-top: 100px;
            font-family: sans-serif;
        }
        .loader {
            margin-top: 30px;
        }
        .spinner {
            width: 40px;
            height: 40px;
            border: 5px solid #ccc;
            border-top-color: #333;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: inline-block;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .error-box {
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            color: #b91c1c;
            padding: 16px;
            margin-top: 30px;
            border-radius: 8px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>📝 Đang chấm điểm bài viết của bạn...</h1>
    <p>Vui lòng đợi trong giây lát...</p>
    <div class="loader">
        <div class="spinner"></div>
    </div>

    <div id="error-box" class="error-box" style="{{ $error ? '' : 'display: none;' }}">
        @if ($error)
            <strong>Lỗi:</strong> {{ $error }}
        @endif
    </div>

<script>
    @if (!$error)
    const errorBox = document.getElementById('error-box');

    const checkStatus = async () => {
        try {
            const res = await fetch('/submission/{{ $submissionId }}/check-error');
            const data = await res.json();

            if (data.status === 'done') {
                window.location.href = '/submission/{{ $submissionId }}';
            } else if (data.error) {
                errorBox.innerHTML = '<strong>Lỗi:</strong> ' + data.error;
                errorBox.style.display = 'inline-block';
            }
        } catch (err) {
            console.error("Không thể kiểm tra trạng thái:", err);
        }
    };

    setInterval(checkStatus, 3000);

    setTimeout(() => {
        window.location.reload();
    }, 30000);
    @endif
</script>

</body>
</html>

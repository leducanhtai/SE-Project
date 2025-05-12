<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Linglooma</title>
    <style>
        body{
            background-color: rgb(29, 6, 34)
        }

        .btn {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: rgb(251, 251, 116);
        color: rgb(47, 25, 125);
        font-weight: bold;
        text-decoration: none;
        border-radius: 999px;
        transition: background-color 0.3s ease;
        box-shadow: 0px 0px 20px rgba(218, 208, 32, 0.876);
    }

    .task-text {
            font-size:30px;
            font-weight: bold;
            color: #f8f7b8;
            text-shadow: 0px 0px 15px rgba(227, 225, 191, 0.868);
        }

        .task-image {
            max-width: 100%;
            width: 800px; 
            height: auto;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: block;        
            margin: 0 auto;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;  
       }

        .countdown-timer {
            position: fixed; 
            top: 50px;
            right: 50px;
            color: #f8f7b8;
            text-shadow: 0px 0px 15px rgba(227, 225, 191, 1);
            font-size: 30px;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            z-index: 999;
       }

       .writing-input {
            width: 100%;
            min-height: 200px;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            resize: vertical;
            margin-top: 30px
        }
        .word-count {
            text-align: right;
            font-size: 14px;
            color: #f8f7b8;
            text-shadow: 0px 0px 15px rgba(227, 225, 191, 0.768);
            margin-top: 5px;
       }

        .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1rem;
        
    }
    .tests-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
    }
    .test-card {
        background: #2b2a2a94;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 0 8px rgba(0,0,0,0.05);
    }
    .test-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #f8f7b8;
        text-shadow: 0px 0px 15px rgba(227, 225, 191, 0.868);
    }
    .test-description {
        color: #666;
        margin-top: 0.5rem;
    }
    .test-link {
        display: inline-block;
        margin-top: 1rem;
        color: #007bff;
        text-decoration: none;
    }
    .test-link:hover {
        text-decoration: underline;
    }
    .test-image {
        margin-top: 0.75rem;
        max-width: 100%;
        border-radius: 6px;
    }
    .no-tests {
        grid-column: span 3;
        text-align: center;
        color: #999;
    }
    
    </style>
</head>
<body>
    
    @include('layouts.navigation')    

    @yield('content')
    
    @include('layouts.footer')
   
</body>
</html>
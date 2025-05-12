<nav style="">
        <div>
            <ul class="nav" style="display: flex; gap:20px">
                <li><a class="" href="{{ route('home') }}">home</a></li>
                <li><a class="" href="">about</a></li>
                <li><a class="" href="{{ route('writing.test.index') }}">test</a></li>
                <li><a class="" href="">game</a></li>
            </ul>
        </div>
    </nav>
    {{-- <div class="header" style="background-color: red; height: 100px"></div> --}}
    <style>
        nav {
            background-color: #333;
            padding: 10px 20px;
        }

        .nav {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .nav li {
            display: inline;
        }

        .nav a {
            text-decoration: none;
            color: #f8f7b8;
            text-shadow: 0px 0px 15px rgba(227, 225, 191, 0.868);
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav a:hover {
            background-color: #575757;
        }

        .nav a.active {
            background-color: #007bff;
            color: white;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
    <div class="header">

    </div>
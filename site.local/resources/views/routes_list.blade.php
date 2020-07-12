<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Routes List</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            font-size: 16px;
        }

        .full-height {
            height: 100vh;
        }

        .flex-content {
            align-items: flex-start;
            display: flex;
            justify-content: left;
        }

        .flex-links {
            display: flex;
            flex-direction: column;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: left;
            margin: 50px;

        }

        .title {
            font-size: 30px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            transition: 0.1s all ease-in;
            margin: 5px 0;
        }

        a > span {
            text-transform: none;
        }

        .links > a:hover {
            color: #1eb1ec;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .mark {
            color: red;
        }

        .method_get,
        .method_post,
        .method_put,
        .method_delete {
            background: #EEE;
            padding: 2px 6px;
            margin: 0 10px;
            line-height: 1rem;
            border-radius: 6px;
            border: 1px #DDD solid;
        }

        .method_get {
            color: #3bac06;
        }

        .method_post {
            color: #c39307;
        }

        .method_put {
            color: #107dde;
        }

        .method_delete {
            color: #db0926;
        }


    </style>
</head>
<body>
<div class="flex-content position-ref full-height">

    <div class="content">
        <div class="title m-b-md">
            Список роутов, доступных для тестирования сервиса
        </div>

        <div class="links flex-links">
            <h4>Resourse Getters ALL</h4>
            <a href="/api/student">get all students<span class="method_get">GET</span><span class="mark">/api/student</span></a>
            <a href="/api/task">get all tasks<span class="method_get">GET</span><span class="mark">/api/task</span></a>
            <a href="/api/skill">get all skills<span class="method_get">GET</span><span class="mark">/api/skill</span></a>
            <a href="/api/achievement">get all achievements<span class="method_get">GET</span><span class="mark">/api/achievement</span></a>
            <h4>Resourse Getters ID</h4>
            <a href="/api/student/1">get student by ID<span class="method_get">GET</span><span class="mark">/api/student/1</span></a>
            <a href="/api/task/1">get task by ID<span class="method_get">GET</span><span class="mark">/api/task/1</span></a>
            <a href="/api/skill/1">get all skill by ID<span class="method_get">GET</span><span class="mark">/api/skill/1</span></a>
            <a href="/api/achievement/1">get achievement by ID<span class="method_get">GET</span><span class="mark">/api/achievement/1</span></a>
            <h4>Send Task Route</h4>
            <a href="/api/interaction/sendTask">get student by ID<span class="method_post">POST</span><span class="mark">/api/student/1</span></a>
            <h4>Get Aggregated Data</h4>
            <a href="/api/getData/Student/1/gradePointAverage">get average point of Student<span class="method_get">GET</span><span class="mark">/api/getData/Student/1/gradePointAverage</span></a>
            <a href="/api/getData/Student/1/skillLevels">get skill levels of Student<span class="method_get">GET</span><span class="mark">/api/getData/Student/1/skillLevels</span></a>
            <a href="/api/getData/Student/1/achievements">get achievements of Student<span class="method_get">GET</span><span class="mark">/api/getData/Student/1/achievements</span></a>

        </div>
    </div>
</div>
</body>
</html>

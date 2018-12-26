<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Museum</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/resources/img/favicon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="/resources/css/reset.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="/resources/css/standard.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="resources/js/standard.js"></script>
    <script class="layout"></script>
</head>
<body>
    <img class="bg" src="/resources/img/bg.jpg" alt="bg.img">
    <div class="grid">
        <div class="inner_grid">
            <div class="title">
                <h1>Museum</h1></div>
                <nav class="sidebar">
                    <nav id="menu">
                        <ul>
                            <li>Utställningar</li>
                            <ul class="exhibition_list">
                            </ul>
                            <br>
                            <li>Guider</li>
                            <ul class="guide_list">
                            </ul>
                        </ul>
                    </nav>

                </nav>
                <div class="display">
                </div>
                <button class='edit_guide'>Redigera Guide</button>
                <div class="controls">
                <button class="edit_button" id='edit_language'>Redigera språk</button>
                <button class="edit_button" id='edit_competence'>Redigera Certifikat</button>
                <div class="lang"></div>
                <div class="comp"></div>
                
                </div>
        </div>
    </div>
</body>
</html>
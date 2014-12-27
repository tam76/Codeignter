<?php
echo '
<!doctype html>
<html>
<head>
    <title>'.$info['book_title'].'</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <base href="'.base_url().'" />
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width" />
    <style type="text/css" media="screen">
        html, body	{ height:100%; }
        body { margin:0; padding:0; overflow:auto; }
        #flashContent { display:none; }
    </style>

    <link rel="stylesheet" type="text/css" href="public/public/css/flexpaper.css" />
    <link rel="stylesheet" href="public/public/css/jRating.jquery.css" type="text/css" />
    <script type="text/javascript" src="public/javascript/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="public/javascript/jquery-ui.js"></script>
    <script type="text/javascript" src="public/javascript/jRating.jquery.js"></script>
    <script type="text/javascript" src="public/javascript/flexpaper.js"></script>
    <script type="text/javascript" src="public/javascript/flexpaper_handlers.js"></script>
</head>
<body>
<div >
<div id="documentViewer" class="flexpaper_viewer" ></div>

<script type="text/javascript">
    var startDocument = "Paper";

    $("#documentViewer").FlexPaperViewer(
            { config : {

                SWFFile : "'.BOOK_UPOAD_PATH.$info['book_url'].'",

                Scale : 0.6,
                ZoomTransition : "easeOut",
                ZoomTime : 0.5,
                ZoomInterval : 0.2,
                FitPageOnLoad : true,
                FitWidthOnLoad : false,
                FullScreenAsMaxWindow : false,
                ProgressiveLoading : false,
                MinZoomSize : 0.2,
                MaxZoomSize : 5,
                SearchMatchAll : false,
                InitViewMode : "Portrait",
                RenderingOrder : "flash",
                StartAtPage : "",

                ViewModeToolsVisible : true,
                ZoomToolsVisible : true,
                NavToolsVisible : true,
                CursorToolsVisible : true,
                SearchToolsVisible : true,
                WMode : "window",
                localeChain: "en_US"
            }}
    );
</script>
</div>
</body>
</html>'
?>
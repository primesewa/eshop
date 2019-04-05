<!doctype html>
<head>
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.943/build/pdf.min.js"></script>
    {{--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>--}}
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/turn.js')}}"></script>
    <script type="text/javascript" src="{{asset('turnjs4/lib/zoom.js')}}"></script>
</head>

<style type="text/css">
    body{
        background:#ccc;
        overflow: scroll;
    }
    #book{
        width:900px;
        height:570px;
        margin: 20px;
        /*box-shadow: 0px 0px 20px gray;*/
        z-index: -.5;
    }

    #book .turn-page{
        background-color:white;

        background-color:silver;
        box-shadow: 0px 0px 10px gray;
    }


    #book .cover{
        background:#333;
    }

    #book .cover h1{
        color:white;
        text-align:center;
        font-size:50px;
        line-height:500px;
        margin:0px;
    }

    #book .loader{
        /*background-image:url();*/
        width:24px;
        height:24px;
        display:block;
        position:relative;
        top:238px;
        left:188px;
    }

    #book .data{
        text-align:center;
        font-size:40px;
        color:#999;
        line-height:500px;
    }

    #controls{
        width:800px;
        text-align:center;
        margin:10px 0px;
        font:15px arial;
        /*float: right;*/
        position: absolute;
        padding-left: 300px;
        top: 575px;
        z-index: 1;
    }

    #controls input, #controls label{
        font:15px arial;

    }

    #book .odd{
        background-image:-webkit-linear-gradient(left, #FFF 95%, #ddd 100%);
        background-image:-moz-linear-gradient(left, #FFF 95%, #ddd 100%);
        background-image:-o-linear-gradient(left, #FFF 95%, #ddd 100%);
        background-image:-ms-linear-gradient(left, #FFF 95%, #ddd 100%);
    }

    #book .even{
        background-image:-webkit-linear-gradient(right, #FFF 95%, #ddd 100%);
        background-image:-moz-linear-gradient(right, #FFF 95%, #ddd 100%);
        background-image:-o-linear-gradient(right, #FFF 95%, #ddd 100%);
        background-image:-ms-linear-gradient(right, #FFF 95%, #ddd 100%);
    }
    #main
    {
        height: 500px;
    }
</style>
</head>
<body>
<div id="main">
    <div id="book">
    </div>
    <div id="controls">
        <button id="next">Next</button>
        <button id="zoomIn" type="button">zoom in</button>
        <button id="zoomoutbutton" type="button">zoom out</button>
        <label for="page-number">Page:</label> <input type="text" size="1" id="page-number"> of <span id="number-pages"></span>
    </div>
</div>


<script id="my_script" type="text/javascript">

    // $('#book .double').scissor();

    var numberOfPages = 0;

    var url = '/storage/file/{{$book->file}}';

    var rendered = [];
    var firstPagesRendered = false;



    var pdf = null,
        pageNum = 1,
        scale = 0.7,
        pageNumPending = null;

    function renderPage(num) {

        pdf.getPage(num).then(function(page) {

                var viewport = page.getViewport(scale);

                //
                // Prepare canvas using PDF page dimensions
                //
                var canvasID = 'canv' + num;
                var canvas = document.getElementById(canvasID);
                if (canvas == null) return;
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                //
                // Render PDF page into canvas context
                //
                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                var renderTask =   page.render(renderContext);
                renderTask.promise.then(function() {
                    firstPagesRendered = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
                // Update page counters
                document.getElementById('page-number').textContent = pageNum;
                document.getElementById('number-pages').textContent = pdf.numPages;
            }
        )}

    function queueRenderPage(num) {
        if (firstPagesRendered) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    }

    function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
            pageNum = 1;
            queueRenderPage(pageNum);
        }
        pageNum= pdfDoc.numPages;
        pageNum++;
        queueRenderPage(pageNum);
    }
    document.getElementById('next').addEventListener('click', onNextPage);
    // Adds the pages that the book will need
    function addPage(page, book) {
        // 	First check if the page is already in the book
        if (!book.turn('hasPage', page)) {

            /*
               var element = $('<div />', {'class': 'page '+((page%2==0) ? 'odd' : 'even'), 'id': 'page-'+page}).html('<i class="loader"></i>');
            // If not then add the page
            book.turn('addPage', element, page);
            // Let's assum that the data is comming from the server and the request takes 1s.
            setTimeout(function(){
                    element.html('<div class="data">Data for page '+page+'</div>');
            }, 1000);
            */
            ///*
            // Create an element for this page
            var element = $('<div />', {'class': 'page '+((page%2==0) ? 'odd' : 'even'), 'id': 'page-'+page})
            element.html('<div class="data"><canvas id="canv' + page + '"></canvas></div>');
            // element.html('<div><i>test</i></div>');
            // If not then add the page
            book.turn('addPage', element, page);
            // renderPage(page);
            //*/
        }
    }



    $(window).ready(function(){

        pdfjsLib.disableWorker = true;

        pdfjsLib.getDocument(url).then(function(pdfDoc) {

            numberOfPages = pdfDoc.numPages;
            pdf = pdfDoc;
            $('#book').turn.pages = numberOfPages;


            $('#book').turn({acceleration: false,
                pages: numberOfPages,
                elevation: 50,
                gradients: !$.isTouch,
                // display: 'single',
                when: {
                    turning: function(e, page, view) {

                        // Gets the range of pages that the book needs right now
                        var range = $(this).turn('range', page);

                        // Check if each page is within the book
                        for (page = range[0]; page<=range[1]; page++) {
                            addPage(page, $(this));
                            //renderPage(page);
                        };

                    },

                    turned: function(e, page) {
                        $('#page-number').val(page);

                        if (firstPagesRendered) {
                            var range = $(this).turn('range', page);
                            for (page = range[0]; page<=range[1]; page++) {
                                if (!rendered[page]) {
                                    renderPage(page);
                                    rendered[page] = true;
                                }
                            };
                        }

                    }
                }
            });

            $('#number-pages').html(numberOfPages);

            $('#page-number').keydown(function(e){

                var p = $('#page-number').val();
                if (e.keyCode==13) {
                    $('#book').turn('page', p);
                    renderPage(p);
                }

            });

            var n = numberOfPages;
            if (n > 6 ) n = 6;
            for (page = 1; page <= n; page++) {
                renderPage(page);
                rendered[page] = true;
            };
            firstPagesRendered = true;


        });


    });

    $(window).bind('keydown', function(e){

        if (e.target && e.target.tagName.toLowerCase()!='input')
            if (e.keyCode==37)
                $('#book').turn('previous');
            else if (e.keyCode==39)
                $('#book').turn('next');

    });

</script>
</body>

</html>

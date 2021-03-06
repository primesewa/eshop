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
    <script type="text/javascript" src="{{asset('turnjs4/extras/jquery-ui-1.8.20.custom.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('turnjs4/extras/jquery.mousewheel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('turnjs4/extras/modernizr.2.5.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('turnjs4/lib/hash.js')}}"></script>

</head>
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
        /*z-index: -.5;*/
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
        /*z-index: 1;*/
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
<div id="can">

    <div class="zoom-icon zoom-icon-in"></div>

    <div class="magazine-viewport">

        <div class="magazine">
            <div id="controls">
                <button id="zoominbutton" type="button">zoom in</button>
                <button id="zoomoutbutton" type="button">zoom out</button>
                <label for="page-number">Page:</label> <input type="text" size="1" id="page-number"> of <span id="number-pages"></span>
            </div>

        </div>
    </div>
    <div class="thumbnails">
        <div id="book"></div>
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
        scale = 0.7;

    function renderPage(num) {

        pdf.getPage(num).then(function (page) {

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
                page.render(renderContext);

                // Update page counters
                document.getElementById('page-number').textContent = pageNum;
                document.getElementById('number-pages').textContent = pdf.numPages;
            }
        )
    }


    // Adds the pages that the book will need
    function addPage(page, book) {
        // 	First check if the page is already in the book
        if (!book.turn('hasPage', page)) {


            // Create an element for this page
            var element = $('<div />', {
                'class': 'page ' + ((page % 2 == 0) ? 'odd' : 'even'),
                'id': 'page-' + page
            })
            element.html('<div class="data"><canvas id="canv' + page + '"></canvas></div>');
            // element.html('<div><i>test</i></div>');
            // If not then add the page
            book.turn('addPage', element, page);
            // renderPage(page);
            //*/
        }
    }


    $(window).ready(function () {

        pdfjsLib.disableWorker = true;

        pdfjsLib.getDocument(url).then(function (pdfDoc) {

            numberOfPages = pdfDoc.numPages;
            pdf = pdfDoc;
            $('#book').turn.pages = numberOfPages;

            $('#book').turn({
                acceleration: false,
                pages: numberOfPages,
                elevation: 50,
                gradients: !$.isTouch,
                // display: 'single',

                when: {
                    turning: function (e, page, view) {

                        // Gets the range of pages that the book needs right now
                        var range = $(this).turn('range', page);

                        // Check if each page is within the book
                        for (page = range[0]; page <= range[1]; page++) {
                            addPage(page, $(this));
                        }
                        ;

                    },

                    turned: function (e, page) {
                        $('#page-number').val(page);

                        if (firstPagesRendered) {
                            var range = $(this).turn('range', page);
                            for (page = range[0]; page <= range[1]; page++) {
                                if (!rendered[page]) {
                                    renderPage(page);
                                    rendered[page] = true;
                                }
                            }
                            ;
                        }

                    }
                }
            });
            $('#book').click(function (e) {

            });
            function loadApp() {

                var flipbook = $('#magazine');
                // Check if the CSS was already loaded

                if (flipbook.width() == 0 || flipbook.height() == 0) {
                    setTimeout(loadApp, 10);
                    return;
                }
                $('#magazine-viewport').mousewheel(function (event, delta, deltaX, deltaY) {
                    var data = $(this).data(),
                        step = 30,
                        flipbook = $('.sj-book'),
                        actualPos = $('#book').slider('value') * step;
                    if (typeof(data.scrollX) === 'undefined') {
                        data.scrollX = actualPos;
                        data.scrollPage = flipbook.turn('page');
                    }
                    data.scrollX = Math.min($("#book").slider('option', 'max') * step,
                        Math.max(0, data.scrollX + deltaX));
                    var actualView = Math.round(data.scrollX / step),
                        page = Math.min(flipbook.turn('pages'), Math.max(1, actualView * 2 - 2));
                    if ($.inArray(data.scrollPage, flipbook.turn('view', page)) == -1) {
                        data.scrollPage = page;
                        flipbook.turn('page', page);
                    }
                    if (data.scrollTimer)
                        clearInterval(data.scrollTimer);

                    data.scrollTimer = setTimeout(function () {
                        data.scrollX = undefined;
                        data.scrollPage = undefined;
                        data.scrollTimer = undefined;
                    }, 1000);
                });
                $('#can').css({visibility: ''});

            }

            $('#number-pages').html(numberOfPages);

            $('#page-number').keydown(function (e) {

                var p = $('#page-number').val();
                if (e.keyCode == 13) {
                    $('#book').turn('page', p);
                    renderPage(p);
                }

            });

            var n = numberOfPages;
            if (n > 1) n = 1;

            for (page = 1; page <= n; page++) {
                renderPage(page);
                rendered[page] = true;
            }
            ;
            firstPagesRendered = true;


        });


    });

    $('#can').css({visibility: 'hidden'});

    $(window).bind('keydown', function(e){

        if (e.target && e.target.tagName.toLowerCase()!='input')
            if (e.keyCode==37)
                $('#book').turn('previous');
            else if (e.keyCode==39)
                $('#book').turn('next');

    });
    yepnope({
        test : Modernizr.csstransforms,
        yep: ['{!! url('turnjs4/lib/turn.js') !!}'],
        nope: ['{!! url('turnjs4/lib/turn.html4.min.js')!!}' ,'{!! url('turnjs4/samples/steve-jobs/css/jquery.ui.html4.css') !!}','{!! url('turnjs4/samples/steve-jobs/css/steve-jobs-html4.css') !!}'],
        both: ['{!! url('turnjs4/samples/steve-jobs/js/steve-jobs.js')!!}', '{!! url('turnjs4/samples/steve-jobs/css/jquery.ui.css')!!}', '{!! url('turnjs4/samples/steve-jobs/css/steve-jobs.css')!!}'],
        complete: renderPage
    });

</script>
</body>

</html>

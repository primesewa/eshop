//<?php //$x = "<p id='page_count'></p>";
//        echo $x;
//        ?>
<!doctype html>

<head>

    <title></title>

</head>
<body>


<h1>PDF.js Previous/Next example</h1>
<center>
    <div>
        <button id="first">first Page</button>
        <button id="last">Last page</button>
        <button id="prev">Previous</button>
        <button id="next">Next</button>
        &nbsp; &nbsp;

        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
    </div>
    <div id="magazine">
        <canvas id="the-canvas" style="border:1px  solid black"></canvas>
    </div>
</center>
{{--<script src="{{asset('js/debugger.js')}}"></script>--}}
{{--<script src="{{asset('js/viewer.js')}}"></script>--}}
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/turn.min.js')}}"></script>
<script type="text/javascript">



</script>

<script type="text/javascript">


    var url = '/storage/file/{{$book->file}}';

    var pdfjsLib = window['pdfjs-dist/build/pdf'];

    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

    var pdfDoc = null,

        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 0.9,
        canvas = document.getElementById('the-canvas'),
        ctx = canvas.getContext('2d');

    /**
     * Get page info from document, resize canvas accordingly, and render page.
     * @param num Page number.
     */
    function renderPage(num) {
        pageRendering = true;
        // Using promise to fetch the page

        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport({scale: scale});
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);
            // console.log(renderTask);
            renderTask.promise.then(function() {
                pageRendering = false;
                if (pageNumPending !== null) {
                    // New page rendering is pending
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
            });
        });

        document.getElementById('page_num').textContent = num;
    }

    function queueRenderPage(num) {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    }
    function onlastPage() {
        pageNum=pdfDoc.numPages;
        queueRenderPage(pageNum);

    }
    document.getElementById('last').addEventListener('click', onlastPage);

    function onfirstPage() {
        pageNum = 1;
        queueRenderPage(pageNum);
    }
    document.getElementById('first').addEventListener('click', onfirstPage);

    function onPrevPage() {
        // console.log(pageNum);
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        queueRenderPage(pageNum);
    }
    document.getElementById('prev').addEventListener('click', onPrevPage);

    /**
     * Displays next page.
     */
    function onNextPage() {
        // if (pageNum >= pdfDoc.numPages) {
        //     pageNum = 1;
        //     queueRenderPage(pageNum);
        // }
        pageNum= pdfDoc.numPages;
        pageNum++;
        queueRenderPage(pageNum);
    }
    document.getElementById('next').addEventListener('click', onNextPage);

    /**
     * Asynchronously downloads PDF.
     */
    pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById('page_count').textContent = pdfDoc.numPages;

        // Initial/first page rendering
        renderPage(pageNum);
    });
</script>

</body>
</html>


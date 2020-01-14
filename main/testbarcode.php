<?php
include "../include/asset_form_util.php";
include "header.php";
require_once "databaseCon.php";

?>



<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- favicon
    ============================================ -->
<link rel="shortcut icon" type="image/x-icon" href="img/logo/IULogo.png">
<!-- Google Fonts
    ============================================ -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
<!-- Bootstrap CSS
    ============================================ -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

<!-- Datatables -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> -->

<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">-->
<!--<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.20/datatables.min.css"/>

<!-- Noty -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css">

<!-- Selectize -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.css">

<!-- Bootstrap CSS
    ============================================ -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- nalika Icon CSS
    ============================================ -->
<link rel="stylesheet" href="css/nalika-icon.css">
<!-- owl.carousel CSS
    ============================================ -->
<link rel="stylesheet" href="css/owl.carousel.css">
<link rel="stylesheet" href="css/owl.theme.css">
<link rel="stylesheet" href="css/owl.transitions.css">
<!-- animate CSS
    ============================================ -->
<link rel="stylesheet" href="css/animate.css">
<!-- normalize CSS
    ============================================ -->
<link rel="stylesheet" href="css/normalize.css">
<!-- meanmenu icon CSS
    ============================================ -->
<link rel="stylesheet" href="css/meanmenu.min.css">
<!-- main CSS
    ============================================ -->
<link rel="stylesheet" href="css/main.css">
<!-- morrisjs CSS
    ============================================ -->
<link rel="stylesheet" href="css/morrisjs/morris.css">
<!-- mCustomScrollbar CSS
    ============================================ -->
<link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
<!-- metisMenu CSS
    ============================================ -->
<link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
<link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
<!-- calendar CSS
    ============================================ -->
<!-- <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
<link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css"> -->
<!-- style CSS
    ============================================ -->
<link rel="stylesheet" href="style.css">
<!-- responsive CSS
    ============================================ -->
<link rel="stylesheet" href="css/responsive.css">
<!-- modernizr JS
    ============================================ -->

</head>



<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="breadcomb-icon">











                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input id="scanner_input" class="form-control" placeholder="Click the button to scan an EAN..." type="text" />
                                        <span class="input-group-btn">
				<button class="btn btn-default" type="button" data-toggle="modal" data-target="#livestream_scanner">
					<i class="fa fa-barcode"></i>
				</button>
			</span>

                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div><!-- /.row -->


                            <div class="modal" id="livestream_scanner1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title">Barcode Scanner</h4>
                                        </div>
                                        <div class="modal-body" style="position: static">
                                            <div id="interactive" class="viewport"></div>
                                            <div class="error"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <label class="btn btn-default pull-left">
                                                <i class="fa fa-camera" style="color: black"></i> Use camera app
                                                <input type="file" accept="image/*;capture=camera" capture="camera"  />
                                            </label>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->














                            <script type="text/javascript" src="quagga.min.js"></script>
                            <style>
                                #interactive.viewport {position: relative; width: 100%; height: auto; overflow: hidden; text-align: center;}
                                #interactive.viewport > canvas, #interactive.viewport > video {max-width: 100%;width: 100%;}
                                canvas.drawing, canvas.drawingBuffer {position: absolute; left: 0; top: 0;}
                            </style>
                            <script type="text/javascript">
                                $(function() {
                                    // Create the QuaggaJS config object for the live stream
                                    var liveStreamConfig = {
                                        inputStream: {
                                            type : "LiveStream",
                                            constraints: {
                                                width: {min: 640},
                                                height: {min: 480},
                                                aspectRatio: {min: 1, max: 100},
                                                facingMode: "environment" // or "user" for the front camera
                                            }
                                        },
                                        locator: {
                                            patchSize: "medium",
                                            halfSample: true
                                        },
                                        numOfWorkers: (navigator.hardwareConcurrency ? navigator.hardwareConcurrency : 4),
                                        decoder: {
                                            "readers":[
                                                {"format":"ean_reader","config":{}}
                                            ]
                                        },
                                        locate: true
                                    };
                                    // The fallback to the file API requires a different inputStream option.
                                    // The rest is the same
                                    var fileConfig = $.extend(
                                        {},
                                        liveStreamConfig,
                                        {
                                            inputStream: {
                                                size: 800
                                            }
                                        }
                                    );

                                    // Start the live stream scanner when the modal opens
                                    $('#livestream_scanner').on('#livestream_scanner', function (e) {
                                        Quagga.init(
                                            liveStreamConfig,
                                            function(err) {
                                                if (err) {
                                                    $('#livestream_scanner .modal-body .error').html('<div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i> '+err.name+'</strong>: '+err.message+'</div>');
                                                    Quagga.stop();
                                                    return;
                                                }
                                                Quagga.start();
                                            }
                                        );
                                    });

                                    // Make sure, QuaggaJS draws frames an lines around possible
                                    // barcodes on the live stream
                                    Quagga.onProcessed(function(result) {
                                        var drawingCtx = Quagga.canvas.ctx.overlay,
                                            drawingCanvas = Quagga.canvas.dom.overlay;

                                        if (result) {
                                            if (result.boxes) {
                                                drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                                                result.boxes.filter(function (box) {
                                                    return box !== result.box;
                                                }).forEach(function (box) {
                                                    Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "green", lineWidth: 2});
                                                });
                                            }

                                            if (result.box) {
                                                Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, drawingCtx, {color: "#00F", lineWidth: 2});
                                            }

                                            if (result.codeResult && result.codeResult.code) {
                                                Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 3});
                                            }
                                        }
                                    });

                                    // Once a barcode had been read successfully, stop quagga and
                                    // close the modal after a second to let the user notice where
                                    // the barcode had actually been found.
                                    Quagga.onDetected(function(result) {
                                        if (result.codeResult.code){
                                            $('#scanner_input').val(result.codeResult.code);
                                            Quagga.stop();
                                            setTimeout(function(){ $('#livestream_scanner').modal('hide'); }, 1000);
                                        }
                                    });

                                    // Stop quagga in any case, when the modal is closed
                                    $('#livestream_scanner').on('hide.bs.modal', function(){
                                        if (Quagga){
                                            Quagga.stop();
                                        }
                                    });

                                    // Call Quagga.decodeSingle() for every file selected in the
                                    // file input
                                    $("#livestream_scanner input:file").on("change", function(e) {
                                        if (e.target.files && e.target.files.length) {
                                            Quagga.decodeSingle($.extend({}, fileConfig, {src: URL.createObjectURL(e.target.files[0])}), function(result) {alert(result.codeResult.code);});
                                        }
                                    });
                                });
                            </script>































































                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Include the image-diff library -->
<script src="quagga.min.js"></script>

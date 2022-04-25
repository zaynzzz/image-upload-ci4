<!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Ajax Image upload with preview Example</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<style type="text/css">
    #blah {
        width: 600px;
        height: 300px;
        border: 2px solid;
        display: block;
        margin: 10px;
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
        overflow: hidden;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <form method="post" id="upload_form" enctype="multipart/form-data">
                <div class="col-md-7">
                    <h1> codeigniter 4 tutorial upload image file using jquery ajax </h1></br>
                    <div id="divMsg" class="alert alert-success" style="display: none">
                        <span id="msg"></span>
                    </div>
                    <img id="blah" src="//www.tutsmake.com/ajax-image-upload-with-preview-in-codeigniter/" alt="your image" /></br></br>
                    <input type="file" name="file" multiple="true" accept="image/*" id="finput" onchange="readURL(this);"></br></br>
                    <button class="btn btn-success">Submit</button>
                </div>
                <div class="col-md-5"></div>
            </form>
        </div>
    </div>
    <script>
        function readURL(input, id) {
            id = id || '#blah';
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(200)
                        .height(150);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function() {
            $('#upload_form').on('submit', function(e) {
                $('.btn-success').html('sending');
                $('.btn-success').prop('disabled');
                e.preventDefault();
                if ($('#file').val() == '') {
                    alert("Please Select the File");
                    $('.btn-success').html('submit');
                    $('.btn-success').prop('enabled');
                    document.getElementById("upload_form").reset();
                } else {
                    $.ajax({
                        url: "<?php echo base_url(); ?>/form/store",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function(res) {
                            console.log(res.success);
                            if (res.success == true) {
                                $('#blah').attr('src', '//www.tutsmake.com/ajax-image-upload-with-preview-in-codeigniter/');
                                $('#msg').html(res.msg);
                                $('#divMsg').show();
                            } else if (res.success == false) {
                                $('#msg').html(res.msg);
                                $('#divMsg').show();
                            }
                            setTimeout(function() {
                                $('#msg').html('');
                                $('#divMsg').hide();
                            }, 3000);
                            $('.btn-success').html('submit');
                            $('.btn-success').prop('enabled');
                            document.getElementById("upload_form").reset();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
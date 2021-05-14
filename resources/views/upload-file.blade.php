<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>File upload</title>

    <!--Style-->
    <style>
        body {
            min-height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .row {
            width: 100%;
        }

    </style>
</head>

<body>
    <form action="/upload" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <label for="formFile" class="form-label">Choose a .csv file to upload data</label>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <input class="form-control" type="file" id="filetype" name="csvfile"
                                onchange="return fileValidation()">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                        <div class="col">{{ $message }}</div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script>
        function fileValidation() {
            var fileInput = document.getElementById('filetype');

            var fileupload = fileInput.value;

            if (!fileupload.endsWith(".csv")) {
                alert('Invalid file type! Please choose a .csv file');
                fileInput.value = '';
                return false;
            }
        }

    </script>
</body>

</html>

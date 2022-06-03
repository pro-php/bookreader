<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?=$title;?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="//cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
<body>
    <div class="container">

        <div class="row mt-5 justify-content-md-center">
            <div class="col col-lg-5">
                <h1><?=$title;?></h1>

                <form action="<?php echo base_url('form/upload');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group mb-3">
                            <label class="form-label" for="file">Выберите файл</label>
                            <input type="file" name="file" class="form-control" id="file" accept=".fb2, .docx, .txt, .png, .jpg, .jpeg" />
                        </div>

                        <div class="form-group">
                            <button type="submit" id="send_form" class="btn btn-success">Опубликовать</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
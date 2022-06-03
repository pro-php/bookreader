<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?=$title_seo;?></title>
    <meta name="description" content="<?=$description?>">
    <?php if ($current_page>1) : ?>
        <meta name="googlebot" content="noindex">
    <?php endif ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-2">

            <aside class="bd-aside sticky-xl-top text-muted align-self-start mb-3 mb-xl-5 px-2">
            <h2 class="h6 pt-4 pb-3 mb-4 border-bottom"><a href="/">На главную</a></h2>
            <nav class="small" id="toc">
            <h2 class="h6">Оглавление</h2>
                <ul class="list-unstyled ps-3">
                    <?foreach ($chapters as $key => $chapter) :?>
                        <? $chapter_key = $key==0 ? '00' : $key?>
                        <li><a class="d-inline-flex align-items-center rounded" href="/public/<?=$book_id?>/?chapter_id=<?=$chapter_key?>"><?=$chapter?></a></li>
                    <? endforeach;?>
                </ul>
            </nav>
            </aside>
        </div>

        <div class="col">
            <div class="bd-cheatsheet container-fluid bg-body">
                <article class="my-3">
                    <h1 class="border-bottom"><?=$title?></h1>

                    <div style="display: flex; align-items: flex-start;">
                        <h3><?=$chapter_title?></h3> <span style="margin-left: 10px;">(Просмотры <?=$chapter_views?>)</span>
                    </div>

                    <div><?=$chapter_content?></div>
                </article>

                <article class="my-3" id="pagination">
                    <div>
                        <div class="bd-example">
                            <?=$pagination;?>
                        </div>
                    </div>
                </article>
             </div>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
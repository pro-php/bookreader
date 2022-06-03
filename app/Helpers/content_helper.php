<?

function cutString($str, $start, $length, $postfix='', $encoding=null) {
    $encoding = $encoding ?: mb_detect_encoding($str);
    
    if (mb_strlen($str, $encoding) <= $length) {
        return $str;
    }
    
    $tmp = mb_substr($str, $start, $length, $encoding);
    return mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding) . $postfix;
}

function pagination($bookId, $page, $total_pages)
{
    $symbol = '-';
    $stages = 1;
    $preUrl = '/public/';
    $targetpage = $preUrl.$bookId.'/page';
    
    // Инициализируем начальные параметры
    if ($page == 0) $page = 1;
    $prev = $page - 1;
    $next = $page + 1;
    $lastpage = ceil($total_pages);
    $LastPagem1 = $lastpage - 1; // Предпоследняя страница
        
    $paginate = ''; // div блок, в котором будет содержаться навигация
    
    if($lastpage > 1)
    {   
        $paginate .= '<nav aria-label="Standard pagination example">
        <ul class="pagination">';
        // Формирование ссылки "Предыдущая"
        $paginate.= '<li class="page-item">';
        if ($page > 1){
            $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "$prev'>Предыдущая</a>";
        }else{
            $paginate.= "<a class='page-link' href='#'>Предыдущая</a>"; }
        $paginate.='</li>';

        // Страницы 
        if ($lastpage < 7 + ($stages * 2))  // Недостаточно страниц для создания троеточия
        {
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page){
                    $paginate.= '<li class="page-item">';
                    $paginate.= "<a class='page-link' href='#'>$counter</a>";
                    $paginate.= '</li>';
                }else{
                    $paginate.= '<li class="page-item">';
                    $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "$counter'>$counter</a>";
                    $paginate.= '</li>';
                }
            }
        }
        elseif($lastpage > 5 + ($stages * 2))   // Достаточно страниц, чтобы скрыть несколько из них
        {
            if($page < 1 + ($stages * 2))
            {
                for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
                {
                    if ($counter == $page){
                        $paginate.= '<li class="page-item">';
                        $paginate.= "<a class='page-link' href='#'>$counter</a>";
                        $paginate.= '</li>';
                    }else{
                        $paginate.= '<li class="page-item">';
                        $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "$counter'>$counter</a>";
                        $paginate.= '</li>';
                    }
                }
                $paginate.= '<li class="page-item">';
                $paginate.= "...";
                $paginate.= '</li>';
                $paginate.= '<li class="page-item">';
                $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "$LastPagem1'>$LastPagem1</a>";
                $paginate.= '</li>';
                $paginate.= '<li class="page-item">';
                $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "$lastpage'>$lastpage</a>";
                $paginate.= '</li>';
            }
            elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
            {
                $paginate.= '<li class="page-item">';
                $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "1'>1</a>";
                $paginate.= '</li>';
                $paginate.= '<li class="page-item">';
                $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "2'>2</a>";
                $paginate.= '</li>';
                $paginate.= '<li class="page-item">';
                $paginate.= "...";
                $paginate.= '</li>';
                for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
                {
                    if ($counter == $page){
                        $paginate.= '<li class="page-item">';
                        $paginate.= "<a class='page-link' href='#'>$counter</a>";
                        $paginate.= '</li>';
                    }else{
                        $paginate.= '<li class="page-item">';
                        $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "$counter'>$counter</a>";
                        $paginate.= '</li>';
                    }
                }
                $paginate.= '<li class="page-item">';
                $paginate.= "...";
                $paginate.= '</li>';
                $paginate.= '<li class="page-item">';
                $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "$LastPagem1'>$LastPagem1</a>";
                $paginate.= '</li>';
                $paginate.= '<li class="page-item">';
                $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "$lastpage'>$lastpage</a>";
                $paginate.= '</li>';
            }
            else
            {
                $paginate.= '<li class="page-item">';
                $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "1'>1</a>";
                $paginate.= '</li>';
                $paginate.= '<li class="page-item">';
                $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "2'>2</a>";
                $paginate.= '</li>';
                $paginate.= '<li class="page-item">';
                $paginate.= "...";
                $paginate.= '</li>';
                for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page){
                        $paginate.= '<li class="page-item">';
                        $paginate.= "<a class='page-link' href='#'>$counter</a>";
                        $paginate.= '</li>';
                    }else{
                        $paginate.= '<li class="page-item">';
                        $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "$counter'>$counter</a>";
                        $paginate.= '</li>';
                    }
                }
            }
        }
                    
        // Формирование ссылки "Следующая"
        $paginate.= '<li class="page-item">';
        if ($page < $counter - 1){ 
            $paginate.= "<a class='page-link' href='$targetpage" . $symbol . "$next'>Следующая</a>";
        }else{
            $paginate.= "<a class='page-link' href='#'>Следующая</a>";
        }
        $paginate.= '</li>';

        $paginate.= "</ul>
        </nav>";
    }

    return $paginate;
}
?>
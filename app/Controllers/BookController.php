<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book;
use App\Models\BookChapterView;
use Tizis\FB2\FB2Controller;

class BookController extends BaseController
{
    private const CHARS_PER_PAGE = 1500;

    public function getBook($bookId, $page=1)
    {
        $bookModel = new Book();
        $book = $bookModel->find($bookId);

        if ($book) {
            helper('content');

            $chapterId = $this->request->getVar('chapter_id');
            if ($chapterId || $chapterId=='00') {
                $chapterId = (int) $chapterId;
                $sessionChapter = [
                    'book_id' => $bookId,
                    'chapter_id' => $chapterId,
                ];
                $this->session->set($sessionChapter);
            }
            else {
                if ($this->session->get('book_id') == $bookId) {
                    $chapterId = $this->session->get('chapter_id') ?? 0;
                }
                else {
                    $chapterId = 0;
                }
            }

            $file = file_get_contents(WRITEPATH.'uploads/'.$book['filename']);

            $item = new FB2Controller($file);
            $item->startParse();

            $title = $item->getBook()->getInfo()->getTitle();
            $title = $titleSeo = $title ? $title : 'Неизвестное название';
            $description = strip_tags($item->getBook()->getInfo()->getAnnotation());
            $description = $description ? $description : 
                            substr(strip_tags($item->getBook()->getChapters()[1]->getContent()),0,200);

            if (strpos(uri_string(), 'page')) {
                $pageInfo = " - страница $page";
                $titleSeo .= $pageInfo;
                $description .= $pageInfo;
            }

            $chapters = [];
            foreach ($item->getBook()->getChapters() as $key => $chapter) {
                if ($chapter->getTitle())
                    $chapters[$key] = $chapter->getTitle();
                else
                    $chapters[$key] = $key==0 ? 'Введение' : 'Часть - '.$key;
            }

            $chapterTitle = $item->getBook()->getChapters()[$chapterId]->getTitle();
            $chapterTitle = $chapterTitle ? $chapterTitle : $chapters[$chapterId];
            $chapterContent = $item->getBook()->getChapters()[$chapterId]->getContent();

            $totalChars = mb_strlen($chapterContent);
            $totalPages = $totalChars ? round($totalChars / self::CHARS_PER_PAGE) : 0;

            $startPage = $page<=1 ? 0 : $page;
            $startContent = $startPage * self::CHARS_PER_PAGE;
            $currentContent = cutString($chapterContent, $startContent, self::CHARS_PER_PAGE);

            $pagination = pagination($bookId, $page, $totalPages);

            $bookChapterViewModel = new BookChapterView();
            $where = [
                'book_id' => $bookId,
                'chapter_id' => $chapterId
            ];

            $chapterViews = 1;
            $dataChapterViews = $bookChapterViewModel->where($where)->first();

            if ($dataChapterViews) {
                ++$dataChapterViews['views'];
                $chapterViews = $dataChapterViews['views'];
                $dataView = $dataChapterViews;
            }
            else {
                $dataView = [
                    'book_id' => $bookId,
                    'chapter_id' => $chapterId,
                    'views' => $chapterViews,
                ];
            }

            $bookChapterViewModel->save($dataView);

            $data = [
                'title' => $title,
                'title_seo' => $titleSeo,
                'description' => $description,
                'book_id' => $bookId,
                'book' => $book,
                'current_page' => $page,
                'total_pages' => $totalPages,
                'chapters' => $chapters,
                'chapter_id' => $chapterId,
                'chapter_views' => $chapterViews,
                'chapter_title' => $chapterTitle,
                'chapter_content' => $currentContent,
                'pagination' => $pagination
            ];

            return view('book-page', $data);
        }

        return view('book404');
    }
}
<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book;


class FormController extends BaseController
{
    public function index()
    {    
        $data['title'] = 'Загрузить книгу';

        return view('form', $data);
    }
     
    public function upload()
    {
        $file = $this->request->getFile('file');
        $file->move(WRITEPATH . 'uploads');

        $data = [
            'filename' =>  $file->getClientName(),
        ];

        $bookModel = new Book();
        $bookModel->insert($data);
        $bookId = $bookModel->getInsertID();

        $gotoUrl = $bookId ?? '/';

        return redirect()->to(base_url($gotoUrl));
    }
}
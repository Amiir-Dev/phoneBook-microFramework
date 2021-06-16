<?php

namespace App\Controllers;

use App\Models\Contact;

class HomeController
{
    private $contactModel;
    public function __construct()
    {
        $this->contactModel = new Contact();
    }

    public function index()
    {
        global $request;
        $where = ['ORDER' => ['created_at' => 'DESC']];
        $search_keyword = $request->input('s');

        if (!is_null($search_keyword)) {

            $where['OR'] = [
                "name[~]" => $search_keyword,
                "email[~]" => $search_keyword,
                "mobile[~]" => $search_keyword,
            ];
        }

        $contacts = $this->contactModel->get('*', $where);
        $data = [
            'contacts' => $contacts,
            'search_keyword' => $search_keyword
        ];

        view('home.index', $data);
    }
}

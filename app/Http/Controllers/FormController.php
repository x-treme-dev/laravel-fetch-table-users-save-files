<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    //выводим форму с полем ввода
    public function index(){
        return view('form');
    }

    public function store(Request $request){
        $request->validate([
            'path' => 'required',
        ]);
        // записать url в переменную
        $path =  $request->input('path');
        // получить данные по url
        $data = Http::timeout(5) -> get($path)->json();
        $json = json_encode($data);
        //dump($data);
         //dd($data);
         // сохранить на диск lacal = storage/app/users
          Storage::disk('local')->put('users/'.time(). '_user.json', $json); 
         // получить массив файлов из директории users/
         $files = Storage::files('users/');
         // создать массив из массив данных, полученных из файлов директории users/
         $array = [];
         foreach($files as $item){
             array_push($array, json_decode(Storage::get($item)));
         }
         //dump($array);
         //die();
        // редирект назад с выводом сообщения в шаблоне form.blade из сессионных переменных: success, data
         return redirect()->back()->with(['success' => 'JSON is uploaded', 
          'array' => $array]);
    }

}

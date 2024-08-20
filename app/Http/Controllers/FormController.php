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
        
        $path =  $request->input('path');
        $data = Http::timeout(5) -> get($path)->json();
        $json = json_encode($data);
        //dump($data);
         //dd($data);
         // сохранить на диск lacal = storage/app/users
          Storage::disk('local')->put('users/'.time(). '_user.json', $json); 
         // редирект назад с выводом сообщения в шаблоне form.blade из сессионных переменных: success, data
         $files = Storage::files('users/');
         dump($files);
         die();
         $array_data = [];
         foreach($files as $item){
             array_push($array_data, json_decode($item));
         }
         dump($array_data);
         die();
         return redirect()->back()->with(['success' => 'JSON is uploaded', 
          'data' => $data]);
    }

}

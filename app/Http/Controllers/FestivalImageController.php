<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FestivalImage;
use Cloudinary\Cloudinary; //use宣言

class FestivalImageController extends Controller
{
    public function create()
    {
        return view('festival_images.create');  //create.blade.phpを表示
    }

    public function store(Request $request, FestivalImage $festivalImage)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
            'image' => 'required|image|max:4096',
        ]);
        // Cloudinaryアップロード
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);

        // 画像をアップロード
        $uploaded = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath());
        $image_url = $uploaded['secure_url'];


        //入力値を取得
        $input = $request->only(['title', 'body']); // ここで 'post[title]' や 'post[body]' が来る前提
        $input['image_url'] = $image_url;


        //モデルに保存
        $festivalImage = new FestivalImage();  // 新しいインスタンスを自分で生成
        $festivalImage->fill($input)->save();


        return redirect('/festival_images/' . $festivalImage->id);
    }

    public function index()
    {
        $festivalImages = FestivalImage::all();
        return view('festival_images.index')->with(['festivalImages' => $festivalImages]);
    }

    public function show(FestivalImage $festivalImage)
    {
        return view('festival_images.show')->with(['festivalImage' => $festivalImage]);
    }

    // 編集画面表示
    public function edit(FestivalImage $festivalImage)
    {
        return view('festival_images.edit', compact('festivalImage'));
    }

    // 更新処理
    public function update(Request $request, FestivalImage $festivalImage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $festivalImage->update($request->only('title', 'body'));

        return redirect()->route('index')->with('success', '更新しました');
    }
}

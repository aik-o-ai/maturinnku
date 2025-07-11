<?php

namespace App\Http\Controllers;

use App\Models\Event; //Model追加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    //DBから予定獲得
    public function get(Request $request, Event $event)
    {
        // バリデーション
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer'
        ]);
        // 現在カレンダーが表示している日付の期間
        $start_date = date('Y-m-d', $request->input('start_date') / 1000); // 日付変換（JSのタイムスタンプはミリ秒なので秒に変換）
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);
        // 予定取得処理（これがaxiosのresponse.dataに入る）
        return $event->query()
            // DBから取得する際にFullCalendarの形式にカラム名を変更する
            ->select(
                'id',
                'event_title as title',
                'event_body as description',
                'start_date as start',
                'end_date as end',
                'event_color as backgroundColor',
                'event_border_color as borderColor'
            )
            // 表示されているカレンダーのeventのみをDBから検索して表示
            ->where('end_date', '>', $start_date)
            ->where('start_date', '<', $end_date) // AND条件
            ->get();
    }



    // カレンダー表示
    public function show()
    {
        $events = Event::all(); // イベント一覧を取得
        return view('calendars.calendar', compact('events'));
    }

    //新規予定追加
    public function create(Request $request)
    {
        // バリデーション（eventsテーブルの中でNULLを許容していないものをrequired）
        $request->validate([
            'event_title' => 'required',
            'event_body' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'event_border_color' => 'required',
            'prefecture' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        //登録処理
        $event = new Event();
        $event->user_id = Auth::id();
        $event->event_title = $request->input('event_title');
        $event->event_body = $request->input('event_body');
        $event->start_date = $request->input('start_date');
        $event->end_date = date("Y-m-d", strtotime("{$request->input('end_date')} +1 day")); // FullCalendarが登録する終了日は仕様で1日ずれるので、その修正を行っている
        $event->event_color = $request->input('event_color');
        $event->event_border_color = $request->input('event_color');
        $event->prefecture = $request->input('prefecture'); // ← これがないとエラー
        $event->location = $request->input('location');     // ← これも必要なら
        $event->latitude = $request->input('latitude');
        $event->longitude = $request->input('longitude');
        $event->save();

        return redirect()->route('calendar.show');
    }


    // 予定の更新
    public function update(Request $request, Event $event)
    {
        $input = new Event();
        $input->event_title = $request->input('event_title');
        $input->event_body = $request->input('event_body');
        $input->start_date = $request->input('start_date');
        $input->end_date = date("Y-m-d", strtotime("{$request->input('end_date')} +1 day"));
        $input->event_color = $request->input('event_color');
        $input->event_border_color = $request->input('event_color');
        // 更新する予定をDBから探し（find）、内容が変更していたらupdated_timeを変更（fill）して、DBに保存する（save）
        $event->find($request->input('id'))->fill($input->attributesToArray())->save(); // fill()の中身はArray型が必要だが、$inputのままではコレクションが返ってきてしまうため、Array型に変換

        // カレンダー表示画面にリダイレクトする
        return redirect(route("calendar.show"));
    }

    // 予定の削除
    public function delete(Request $request, Event $event)
    {
        // 削除する予定をDBから探し（find）、DBから物理削除する（delete）
        $event->find($request->input('id'))->delete();
        // カレンダー表示画面にリダイレクトする
        return redirect(route("calendar.show"));
    }
}

// calendar.js
import axios from "axios"; ////HTTP通信ライブラリ「axios」を読み込み
import { Calendar } from "@fullcalendar/core"; //FullCalendarのメイン機能を提供する「Calendar」クラスをインポート
import dayGridPlugin from "@fullcalendar/daygrid"; //「月形式カレンダー（日がマス目に並ぶタイプ）」を表示するためのプラグインを読み込み
import timeGridPlugin from "@fullcalendar/timegrid"; //「時間ごとのスケジュール（週形式や日形式）」を表示するためのプラグイン

// 日付を-1してYYYY-MM-DDの書式で返すメソッド
function formatDate(date, pos) {
    const dt = new Date(date);
    if (pos === "end") {
        dt.setDate(dt.getDate() - 1);
    }
    return (
        dt.getFullYear() +
        "-" +
        ("0" + (dt.getMonth() + 1)).slice(-2) +
        "-" +
        ("0" + dt.getDate()).slice(-2)
    );
}

// カレンダーを表示させたいタグのidを取得
const calendarEl = document.getElementById("calendar");

// new Calender(カレンダーを表示させたいタグのid, {各種カレンダーの設定});
// "calendar"というidがないbladeファイルではエラーが出てしまうので、if文で除外。
if (calendarEl) {
    const calendar = new Calendar(calendarEl, {
        // プラグインの導入(import忘れずに)
        plugins: [dayGridPlugin, timeGridPlugin],

        // カレンダー表示
        initialView: "dayGridMonth", // 最初に表示させるページの形式

        customButtons: {
            // カスタムボタン
            eventAddButton: {
                // 新規予定追加ボタン
                text: "予定を追加",
                click: function () {
                    // 初期化（以前入力した値をクリアする）
                    document.getElementById("new-id").value = "";
                    document.getElementById("new-event_title").value = "";
                    document.getElementById("new-start_date").value = "";
                    document.getElementById("new-end_date").value = "";
                    document.getElementById("new-event_body").value = "";
                    document.getElementById("new-event_color").value = "blue";
                    // 新規予定追加モーダルを開く
                    document.getElementById("modal-add").style.display = "flex";
                },
            },
        },

        headerToolbar: {
            start: "prev,next today", // ヘッダー左（前月、次月、今日の順番で左から配置）
            center: "title", // ヘッダー中央（今表示している月、年）
            end: "eventAddButton dayGridMonth,timeGridWeek", // 追記2（半角スペースは必要）
        },
        height: "auto", // 高さをウィンドウサイズに揃える

        // DBに登録した予定を表示する
        events: function (info, successCallback, failureCallback) {
            // eventsはページが切り替わるたびに実行される
            // axiosでLaravelの予定取得処理を呼び出す
            axios
                .post("/calendar/get", {
                    // 現在カレンダーが表示している日付の期間(1月ならば、start_date=1月1日、end_date=1月31日となる)
                    start_date: info.start.valueOf(),
                    end_date: info.end.valueOf(),
                })
                .then((response) => {
                    // 既に表示されているイベントを削除（重複防止）
                    calendar.removeAllEvents(); // ver.6でもどうやら使える（ドキュメントにはない？）
                    // カレンダーに読み込み
                    successCallback(response.data); // successCallbackに予定をオブジェクト型で入れるとカレンダーに表示できる
                })
                .catch((error) => {
                    // バリデーションエラーなど
                    alert("登録に失敗しました。");
                });
        },

        // 予定をクリックすると予定編集モーダルが表示される
        eventClick: function (info) {
            // console.log(info.event); // info.event内に予定の全情報が入っているので、必要に応じて参照すること
            document.getElementById("id").value = info.event.id;
            document.getElementById("delete-id").value = info.event.id;
            document.getElementById("event_title").value = info.event.title;
            document.getElementById("start_date").value = formatDate(
                info.event.start
            );
            document.getElementById("end_date").value = formatDate(
                info.event.end,
                "end"
            );
            document.getElementById("event_body").value =
                info.event.extendedProps.description;
            document.getElementById("event_color").value =
                info.event.backgroundColor;
            // 予定編集モーダルを開く
            document.getElementById("modal-update").style.display = "flex";
        },
    });

    // カレンダーのレンダリング
    calendar.render();
    window.calendar = calendar;

    //新規モーダルを閉じる
    window.closeAddModal = function () {
        document.getElementById("modal-add").style.display = "none";
    };
    window.closeUpdateModal = function () {
        document.getElementById("modal-update").style.display = "none";
    };
    window.deleteEvent = function () {
        "use strict";
        if (confirm("削除すると復元できません。\n本当に削除しますか？")) {
            document.getElementById("delete-form").submit();
        }
    };
}

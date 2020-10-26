// 終了時間を取得->Auction/viewから入札終了時間を「end」に渡している
var endDate = new Date(end);
var interval = 1000;

function countdownTimer() {
    //現在日時の取得
    var nowDate = new Date();
    //終了日時と現在日時の差異を算出
    var period = endDate - nowDate;
    //0を付けて右側2桁を返す
    var addZero = function (n) { return ('0' + n).slice(-2); }
    //3桁を表示する可能性のある日にちに適用する。
    var addZeroDay = function (n) { return ('0' + n).slice(-3); }

    //算出した差異を時刻として表示する処理
    if (period >= 0) {
        //日にちを取得
        var day = Math.floor(period / (1000 * 60 * 60 * 24));
        period -= (day * (1000 * 60 * 60 * 24));
        //時間を取得
        var hour = Math.floor(period / (1000 * 60 * 60));
        period -= (hour * (1000 * 60 * 60));
        //分を取得
        var minutes = Math.floor(period / (1000 * 60));
        period -= (minutes * (1000 * 60));
        //秒を取得
        var second = Math.floor(period / 1000);

        //入札終了をアラートで宣言してページをリロードし、DBを更新する 
        if (hour == 0 && minutes == 0 && second == 0) {
            document.getElementById("countDown").innerHTML = "入札終了しました！";
            alert('入札時間が終了しました！') ? '' : location.reload(); // 入札終了時間とともにアラートを表示してページをリロード
        }
        //HTMLで表示するためにcountに表示する時間を入れる
        var count = "";
        count += '<span class="h">' + addZeroDay(day) + '日' + '</span>';
        count += '<span class="h">' + addZero(hour) + '時' + '</span>';
        count += '<span class="m">' + addZero(minutes) + '分' + '</span>';
        count += '<span class="s">' + addZero(second) + '秒' + '</span>';
        document.getElementById('countDown').innerHTML = count;
        setTimeout(countdownTimer, 10);
    }
    //カウントダウンが終了していても表示するテキスト
    else {
        document.getElementById("countDown").innerHTML = "入札終了しました！";
    }
}

countdownTimer();

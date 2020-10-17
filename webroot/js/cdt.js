function dateCounter() {

    var timer = setInterval(function () {

        //現在日時を取得
        var nowDate = Date.now();
        //入札終了時間を設定
        var anyDate = new Date(end);
        //日数を計算
        var daysBetween = Math.floor((anyDate - nowDate) / (24 * 60 * 60 * 1000));
        var ms = (anyDate - nowDate);
        if (ms >= 0) {
            //時間を取得
            var h = Math.floor(ms / 3600000);
            var _h = h % 24;
            //分を取得
            var m = Math.floor((ms - h * 3600000) / 60000);
            //秒を取得
            var s = Math.round((ms - h * 3600000 - m * 60000) / 1000);

            //HTML上に出力
            document.getElementById("countDown").innerHTML = daysBetween + "日と" + _h + "時間" + m + "分" + s + "秒";

            if ((h == 0) && (m == 0) && (s == 0)) {
                clearInterval(timer);
                document.getElementById("countDown").innerHTML = "入札終了しました！";
            }
        } else {
            document.getElementById("countDown").innerHTML = "入札終了しました！";
        }
    }, 1000);
}
dateCounter();

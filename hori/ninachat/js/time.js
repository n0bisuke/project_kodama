function jpDateTime(strMilliSecond) {
    "use strict";
    var time = new Date(parseInt(strMilliSecond, 10)),
        year = time.getFullYear(), // 年（4桁）
        month = time.getMonth() + 1, // 月（0〜11）
        date = time.getDate(), // 日
        weekDayJP = ["日", "月", "火", "水", "木", "金", "土"],
        wDJ = weekDayJP[time.getDay()],
        hour = time.getHours(), // 時（0〜23）
        minute = time.getMinutes(), // 分
        second = time.getSeconds(), // 秒
        result = year + "年" + month + "月" + date + "日（" + wDJ + "）" + hour + "時" + minute + "分" + second + "秒";
    return result;
}


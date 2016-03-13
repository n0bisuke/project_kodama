'use strict'

let http = require('http');
const URL = 'http://qiita.com/Qiita/items/c686397e4a0f4f11683d';
let re = new RegExp("(<\s*title[^>]*>(.+?)<\s*/\s*title)\>", "g");
// let re = new RegExp("(<\s*meta[^>]*>(.+?)", "g");

http.get(URL, (res) => {
  let body = '';
  res.setEncoding('utf8');

  res.on('data', (chunk) => {
      body += chunk;
  });

  res.on('end', (res) => {
    let match = re.exec(body);
    // console.log(match);
    if (match && match[2]) console.log(match[2]);
  });
}).on('error', (e) => {
  console.log(e.message); //エラー時
});

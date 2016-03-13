'use strict'

let http = require('http');
let https = require('https');

function getTitle(url, cb){
  let re = new RegExp("(<\s*title[^>]*>(.+?)<\s*/\s*title)\>", "g");
  let protocol = url.match(/^(.*?:\/\/)(.*?)([a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})[\:[0-9]*]?([\/].*?)?$/i)[1];
  let client = http;

  if(!protocol){
    console.log('Error: Need Protocol');
    process.exit(1);
  }

  if(protocol === 'https://')client = https;
  console.log('protocol is ' + protocol);

  client.get(url, (res) => {
    let body = '';
    res.setEncoding('utf8');

    res.on('data', (chunk) => {
        body += chunk;
    });

    res.on('end', (res) => {
      let match = re.exec(body);
      if (match && match[2]) cb(match[2]);
    });
  }).on('error', (e) => {
    console.log(e.message); //エラー時
  });
}

module.exports = getTitle;

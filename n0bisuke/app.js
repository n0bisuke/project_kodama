'use strict'

if(!process.argv[2]){
  console.log('Error: Argument shortage');
  process.exit(1);
}

const webshot = require('webshot');
const fs      = require('fs');
const Gyazo  = require('gyazo-api');
const TOKEN = require('./config');
const getTitle = require('./lib/gettitle');
const client = new Gyazo(TOKEN);
const FILENAME = 'output.png';
const TARGET_URL = process.argv[2];

let renderStream = webshot(TARGET_URL);
let file = fs.createWriteStream(FILENAME, {encoding: 'binary'});
console.log('downloading...');

getTitle(TARGET_URL, (title) => {
  console.log(title);
});

renderStream.on('data', (data) => {
  file.write(data.toString('binary'), 'binary');
});

renderStream.on('end', (data) => {
  console.log('image saved');
  gyazoUpload();
});

function gyazoUpload(){
  client.upload(FILENAME, {
    title: "my picture",
    desc: "upload from nodejs"
  })
  .then((res) => {
    console.log(TARGET_URL);
    console.log(res.data.image_id);
    console.log(res.data.permalink_url);
    console.log(res.data.url);
  })
  .catch((err) => {
    console.error(err);
  });
}

var webshot = require('webshot');
var fs      = require('fs');

var renderStream = webshot('http://mlkcca.connpass.com/event/27083/');
var file = fs.createWriteStream('google.png', {encoding: 'binary'});

renderStream.on('data', function(data) {
  file.write(data.toString('binary'), 'binary');
});

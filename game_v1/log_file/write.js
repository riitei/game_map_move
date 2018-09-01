// fs.writeFile(filename,data,[options],callback);
var w_data = '这是一段通过fs.writeFile函数写入的内容；\r\n';
var w_data = new Buffer(w_data);

/**
 * filename, 必选参数，文件名
 * data, 写入的数据，可以字符或一个Buffer对象
 * [options],flag,mode(权限),encoding
 * callback 读取文件后的回调函数，参数默认第一个err,第二个data 数据
 */

fs.writeFile('/Users/riitei/CODE/PHP/game_map_move/game_v1/log_file\n/test.txt', w_data, {flag: 'a'}, function (err) {
    if (err) {
        console.error(err);
    } else {
        console.log('写入成功');
    }
});

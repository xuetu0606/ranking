/**
 * 过滤返回数据转换为对象或数组
 * @param data
 * @returns {*}
 */
function jsonOrArrayToObject(data){
    if((typeof data=='string')&&data.constructor==String){
        data = JSON.parse(data);
    }
    return data;
}
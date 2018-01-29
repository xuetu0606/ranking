var textField = document.getElementById("input"), //获取表单域
    startText = textField.value; //获取开头字符串
textField.onkeyup = function () {
    //如果不是以startText开头的，就把文本框内的值设为startText
    (textField.value.indexOf(startText) === 0) || (textField.value = startText);
};


var textField1 = document.getElementById("input1"), //获取表单域
    startText1 = textField1.value; //获取开头字符串
textField1.onkeyup = function () {
    //如果不是以startText开头的，就把文本框内的值设为startText
    (textField1.value.indexOf(startText1) === 0) || (textField1.value = startText1);
};


var textField2 = document.getElementById("input2"), //获取表单域
    startText2 = textField2.value; //获取开头字符串
textField2.onkeyup = function () {
    //如果不是以startText开头的，就把文本框内的值设为startText
    (textField2.value.indexOf(startText2) === 0) || (textField2.value = startText2);
};


var textField3 = document.getElementById("input3"), //获取表单域
    startText3 = textField3.value; //获取开头字符串
textField3.onkeyup = function () {
    //如果不是以startText开头的，就把文本框内的值设为startText
    (textField3.value.indexOf(startText3) === 0) || (textField3.value = startText3);
};


var textField4 = document.getElementById("input4"), //获取表单域
    startText4 = textField4.value; //获取开头字符串
textField4.onkeyup = function () {
    //如果不是以startText开头的，就把文本框内的值设为startText
    (textField4.value.indexOf(startText4) === 0) || (textField4.value = startText4);
};
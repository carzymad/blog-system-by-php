function mosaic(lines, dir) {
	var n = lines.length;		// 输入的markdown原文的行数
	var output = "";					// 最后要输出的解析后的html代码		
	for (var i = 0; i < n; i++) {
		output += parse(lines[i]);
	}
	$(dir).html(output);
}

function parse(line) {
	var result = "";						// 返回值（字符串）
	var perl = /#{1,6}|\[.+\]+\(.+\)|\!\[.+\]+\(.+\)/;		// 正则表达式,匹配最重要的三个标签<a><img><h>
	var index = line.search(perl);			// 匹配到的字符串的第一个字符的位置 
	var subline = line.match(perl);		// 匹配到的子串 
	if (subline == null) {				// 如果匹配结果为空
		if (line == "") {			// 如果匹配串本身就是空串，就返回空
			return "";
		} else {
			return "<p>" + line + "</p>";
		}
	} else {
		subline = subline[0];
	}
	//alert("index"+index);
	//alert(subline);
	if (subline[0] == '#') {			// 匹配到<h>标签
		var level = subline.length;			// <h>标签的级别
		result = "<p>" + line.substring(0, index) + "</p>" + "<h"+level+">" + line.substring(index+level) + "</h"+level+">";
		//alert(result);
	} else if (subline[0] == '[') {		// 匹配到<a>标签
		var title = subline.match(/\[.+\]/)[0];
		title = title.substring(1, title.length-1);
		var href = subline.match(/\(.+\)/)[0];
		href = href.substring(1, href.length-1);
		result = "<p>" + line.substring(0, index) + "<a target='blank' href='" + href + "'>" + title + "</a>" + line.substring(index+subline.length) + "</p>";
	} else if (subline[0] == '!') {		// 匹配到<img>标签
		var title = subline.match(/\[.+\]/)[0];
		title = title.substring(1, title.length-1);
		var src = subline.match(/\(.+\)/)[0];
		src = src.substring(1, src.length-1);
		//alert(title+src);
		result = "<p>" + line.substring(0, index) + "<img src='" + src + "' alt='" + title + "' />" + line.substring(index+subline.length) + "</p>";
	}

	return result;
}


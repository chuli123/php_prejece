var counter = 1;  
var pageStart = 0,  
pageEnd = 20;  
$('.Container').dropload({  
    scrollArea: window,  
    loadDownFn: function(me) {  
        $.ajax({  
            type: 'GET',  
            url: a,  
            dataType: "json",  
            data: {  
                page: counter,  
                type: ''  
            },  
            success: function(responds) {  
                var html = "";  
                counter++;  
                if (responds.items.length < pageEnd && responds.items.length > 0) {  
  
                    for (var i = pageStart; i < responds.items.length; i++) {  
                        html += '<li class="clear">' + '<div class="list">' + '<img src="' + responds.items[i].image + '"/>' + '<div class="title">' + '<p><a href="main.html">' + responds.items[i].title + '</a></p>' + '<div class="info clear">' + '<span class="time">' + responds.items[i].data + '</span>'  
                        if (responds.items[i].type == 'tj') {  
                            html += '<span class="tip">推荐</span>'  
                        } else {  
                            html += '<span class="tip" style="border:none"></span>'  
                        }  
  
                        html += '<b class="read"><i>' + responds.items[i].view + '</i>人看过</b>' + '</div>' + '</div>' + '</div>' + '</li>'  
  
                    }  
  
                    setTimeout(function() {  
                        $(".container ul").append(html);  
                        me.lock();  
                        me.noData();  
                        me.resetload();  
                    },  
                    500);  
                } else if (responds.items.length == 0) {  
                    me.lock();  
                    me.noData();  
                    me.resetload();  
                } else {  
                    for (var i = pageStart; i < pageEnd; i++) {  
                        html += '<li class="clear">' + '<div class="list">' + '<img src="' + responds.items[i].image + '"/>' + '<div class="title">' + '<p><a href="main.html">' + responds.items[i].title + '</a></p>' + '<div class="info clear">' + '<span class="time">' + responds.items[i].data + '</span>'  
                        if (responds.items[i].type == 'tj') {  
                            html += '<span class="tip">推荐</span>'  
                        } else {  
                            html += '<span class="tip" style="border:none"></span>'  
                        }  
  
                        html += '<b class="read"><i>' + responds.items[i].view + '</i>人看过</b>' + '</div>' + '</div>' + '</div>' + '</li>'  
                    }  
                    setTimeout(function() {  
                        $('.container ul').append(html);  
                        me.resetload();  
                    },  
                    500);  
                }  
            },  
            error: function(xhr, type) {  
                $("#dialog1").weuiDialog({  
  
                    title: "提示",  
  
                    content: "数据加载失败！",  
  
                    cancle: ''  
                });  
            }  
        });  
    }  
});
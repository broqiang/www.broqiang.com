<script src="https://cdn.bootcss.com/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">
$('#posts_search').typeahead({
    source: function(query, process) {
        return $.ajax({
            url: '{{ route('search.posts') }}',
            type: 'post',
            data: { query: query },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                var resultList = result.map(function(item) {
                    var aItem = { id: item.id, name: item.title };
                    return JSON.stringify(aItem);
                });
                return process(resultList);
            }
        });
    },
    matcher: function(obj) {
        var item = JSON.parse(obj);
        return ~item.name.toLowerCase().indexOf(this.query.toLowerCase())
    },
    sorter: function(items) {
        var beginswith = [],
            caseSensitive = [],
            caseInsensitive = [],
            item;
        while (aItem = items.shift()) {
            var item = JSON.parse(aItem);
            if (!item.name.toLowerCase().indexOf(this.query.toLowerCase())) beginswith.push(JSON.stringify(item));
            else if (~item.name.indexOf(this.query)) caseSensitive.push(JSON.stringify(item));
            else caseInsensitive.push(JSON.stringify(item));
        }
        return beginswith.concat(caseSensitive, caseInsensitive)
    },
    // 显示的内容，可以自定义下样式，如果不配置这个，就会把后台传回来的原样输出
    highlighter: function(obj) {
        var item = JSON.parse(obj);
        var query = this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, '\\$&')
        return item.name.replace(new RegExp('(' + query + ')', 'ig'), function($1, match) {
            return '<strong class="text-success font-weight-bold font-italic">' + match + '</strong>'
        })
    },
    // 选中后触发的动作
    updater: function(obj) {
        var item = JSON.parse(obj);
        location.href = "{{ asset('posts/') }}/" + item.id
        return item.name;
    },
    minLength: 2, // 触发搜索动作的词数
    items: 10, //显示条数,all 是显示所有
    delay: 500, //延迟时间
});
</script>
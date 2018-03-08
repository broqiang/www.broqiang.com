/**
 * 删除按钮
 * 为了自定义样式，减少样式用的代码量，点击确定后的操作通过回调函数进行
 * @param  {Function} callback [回调函数，点击确定按钮后的操作]
 */
window.swal_delete = function(callback) {
    swal({
        title: "确定删除？",
        text: "删除后无法恢复，请谨慎操作！",
        icon: "warning",
        buttons: ["取消", "确定"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            callback();
        } else {
            swal({
                text: "已经取消 ！",
                buttons: false,
                timer: 1000,
                icon: "info"
            });
            swal.close();
        }
    });
}
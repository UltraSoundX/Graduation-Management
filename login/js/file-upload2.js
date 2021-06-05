(function($) {
    'use strict';
    $(function() {
            $('.file-upload-browse').on('click', function() {
                if (!$("#uploadNumber").val()){
                    layer.alert("请选择论文编号！");
                    return 0;
                } else {
                    var alert = "您正在提交编号为："+$("#uploadNumber").val() +" 的论文！";
                    layer.alert(alert,{
                        title:"提示",
                        skin:"layui-layer-lan",
                        closeBtn:0,
                        anim:4
                    },function (){
                        layer.closeAll();
                        var file = $('.file-upload-browse').parent().parent().parent().find('.file-upload-default');
                        file.trigger('click');
                    });
                }
            });
            $('.file-upload-default').on('change', function() {
                $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
            });
    });
})(jQuery);
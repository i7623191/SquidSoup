(function() {
    tinymce.create('tinymce.plugins.video_jacker', {
        init : function(ed, url) {
            ed.addCommand('video_jacker', function() {
                ed.windowManager.open({
                    file : ajaxurl + '?action=vidjac_shortpop',
                    width : 450 + parseInt(ed.getLang('example.delta_width', 0)),
                    height : 550 + parseInt(ed.getLang('example.delta_height', 0)),
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            ed.addButton('video_jacker', {
                title : 'Video Jacker',
                image : url+'/video_jacker.png',
                cmd : 'video_jacker'
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Video Jacker",
                author : 'BZ9',
                authorurl : 'http://bz9.com',
                infourl : 'http://bz9.com',
                version : "1.4"
            };
        }
    });
    tinymce.PluginManager.add('video_jacker', tinymce.plugins.video_jacker);
})();
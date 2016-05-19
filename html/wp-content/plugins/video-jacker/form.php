<?php
/**
 * File : form.php
 **/

$saved_videos = '<option value="0">Select Saved Video</option>';
$args = array(
    'post_type' => 'video_jacker',
	'posts_per_page' => -1
);
$products = new WP_Query( $args );
if( $products->have_posts() ) {
    while( $products->have_posts() ) {
        $products->the_post();
        $saved_videos .= '<option value="'.get_the_ID().'">'.get_the_title().'</option>';
    }
}
else {
    $saved_videos = '<option value="0">No Saved Videos Found</option>';
}
?>
<!DOCTYPE html>
<head>
    <title>Video Jacker</title>
    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
    <script type="text/javascript" src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
    <script type="text/javascript">
        var $ = jQuery;
        var video_jacker = {
            e: '',
            init: function(e) {
                video_jacker.e = e;
                tinyMCEPopup.resizeToInnerSize();
            },
            insert: function createVJShortcode(e) {
                var value = $('#vidjac_code').val();
                var value2 = $('#vidjac_code2').val();
                var value3 = $('#vidjac_code3').val();
                var saved_tool = $('#vidjac_saved_videos').val();
                var src = "";
                var atts = new Array();
                var style = "";
                var flashvars = "";

                if ( value !== '' )
                {
                    flashvars = $(value).find('param[name="flashVars"]').val();
                    value = vartest(value);
                    src = $(value).attr("src");
                    atts['height'] = $(value).attr("height");
                    atts['width'] = $(value).attr("width");
                    style = $(value).attr("style");
                    insertshort(src,atts,style);
                }
                if ( value2 !== '' )
                {
                    flashvars = $(value2).find('param[name="flashVars"]').val();
                    value2 = vartest(value2);
                    src = $(value2).attr("src");
                    atts['height'] = $(value2).attr("height");
                    atts['width'] = $(value2).attr("width");
                    style = $(value2).attr("style");
                    insertshort(src,atts,style);
                }
                if ( value3 !== '' )
                {
                    flashvars = $(value3).find('param[name="flashVars"]').val();
                    value3 = vartest(value3);
                    src = $(value3).attr("src");
                    atts['height'] = $(value).attr("height");
                    atts['width'] = $(value).attr("width");
                    style = $(value3).attr("style");
                    insertshort(src,atts,style,flashvars);
                }
                if( saved_tool != 0)
                {
                    insertshort(saved_tool,'','saved');
                }
                tinyMCEPopup.close();
            }
        }
        tinyMCEPopup.onInit.add(video_jacker.init, video_jacker);

        function vartest(tvalue)
        {
            tvalue = strip_tags(tvalue, '<iframe>');

            var myRe = new RegExp("var.+?;", "g");
            var pattern = /<object><iframe>.+?<\/iframe><\/object>/;
            var myArray;
            var params = "";
            while (myArray = myRe.exec(tvalue))
            {
                params = params+htmlEntities(myArray[0]);
            }
            if(params != ""){
                insertshort(params,'','saved_var');
                tvalue = tvalue.replace(pattern, "");
                return tvalue;
            }
            return tvalue;
        }

        function strip_tags (input, allowed) {
            allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
            var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
                commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
            return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
                return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
            });
        }


        function htmlEntities(str) {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }


        function insertshort(src,atts,style,flashvars)
        {
            var shortcode = 'video_jacker';
            var shortcode_close = '[/video_jacker]';
            var vidjac;
            var height;
            var width;
            var flashvartxt;

            if (atts['height'] !== undefined) {
                height = ' height=' + atts['height'];
            }
            if (atts['width'] !== undefined) {
                width = ' width=' + atts['width'];
            }

            if (flashvars !== undefined) {
                flashvartxt = flashvars.replace(/&/gi," ")
            }

            if (style === undefined) {

                if (src !== undefined) {
                    vidjac = '[' + shortcode + height + width +']' + src + shortcode_close;
                    tinyMCEPopup.execCommand('mceInsertContent', 0, vidjac);
                }



            } else if(style === 'saved'){
                vidjac = '[' + shortcode + ' saved="' + src + '" /]';
                tinyMCEPopup.execCommand('mceInsertContent', 0, vidjac);

            } else if(style === 'saved_var'){
                vidjac = '[' + shortcode + ' type="vars"]' + src + shortcode_close;
                tinyMCEPopup.execCommand('mceInsertContent', 0, vidjac);

            }else {
                vidjac = '[' + shortcode + height + width + ' ' + flashvartxt + ' style="' + style + '"]' + src + shortcode_close;
                tinyMCEPopup.execCommand('mceInsertContent', 0, vidjac);
            }
            return;
        }
    </script>
    <style>
        label {
            display: block;
        }
        textarea {
            margin-bottom: 10px;
        }
        #bz9_tools_txt {
            margin-bottom: 10px;
        }
        a {
            width:155px;
            display:block;
            margin-left:auto;
            margin-right:auto;
            padding: 2px 5px 2px 5px;
            text-decoration:none;
            font-family:arial;
            font-weight:bold;
            text-align:center;
            background-color: #fff9f8;
            color: white;
            font-size:9pt;
            border: 3px #454545 ridge;
        }
        a:hover {
            color: #5c79b7;
        }
    </style>
</head>
<body>
<div id="video_jacker_txt">Enter your video embed code into one of the boxes below. To save you time three boxes have been provided to make multiple shortcodes.</div>
<div id="vidjac-form"><table id="vidjac-table" class="form-table">
        <tr>
            <th><label for="vidjac_code">Video Code</label></th>
            <td><textarea id="vidjac_code" name="columns" rows="5" cols="40" /></textarea>
            </td>
        </tr>
        <tr>
            <th><label for="vidjac_code2">Video Code</label></th>
            <td><textarea id="vidjac_code2" name="columns" rows="5" cols="40" /></textarea>
            </td>
        </tr>
        <tr>
            <th><label for="vidjac_code3">Video Code</label></th>
            <td><textarea id="vidjac_code3" name="columns" rows="5" cols="40" /></textarea>
            </td>
        </tr>
        <tr>
            <th><label for="vidjac_saved_videos">Saved Videos</label></th>
            <td><select name="vidjac_saved_videos" id="vidjac_saved_videos"><?php echo $saved_videos; ?></select></td>
        </tr>
    </table>
    <p class="submit">
        <a href="javascript:video_jacker.insert(video_jacker.e)">Create Shortcode</a>
    </p>
</div>
</body>
</html>
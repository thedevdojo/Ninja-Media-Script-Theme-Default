
var abc = 0;
var deleteImgs = '';
var noExecute = [];
$(document).ready(function() {
    $('#add_more').click(function() {//When Add More Files button Clicked these function Willbe Called (new file field is added dynamically)
        $(this).before($("<div/>", {class: 'filediv'}).fadeIn('slow').append(
            $("<input/>", {name: 'pic_url_multi[]', type: 'file', id: 'pic_url_multi', multiple: 'true'})
        ));
    });

    $('body').on('change', '#pic_url_multi', function(evt){
        if (this.files) {
            var files = evt.target.files;
            for (var i = 0, f; f = files[i]; i++) {
                var reader = new FileReader();
                var crrfile = $(this);
                reader.onload = (function(theFile) {
                    var filesize = files[i].size;
                    var filename = files[i].name;
                    return function(e) {
                        abc += 1;
                        noExecute[abc] = 0;
                        crrfile.before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' class='img"+ abc + "' src='"+e.target.result+"' filesize='"+filesize+"' filename='"+filename+"'/><span class='delete' alt='"+abc+"'></span> </div>");

                        $(".delete").click(function() {
                            var noImgDel = $(this).attr('alt');
                            if(noExecute[noImgDel]) {
                                return false;
                            } else {
                                noExecute[noImgDel]=1;
                                var strName = $(this).parent().children("img").attr( "filename" );
                                var strSize = $(this).parent().children("img").attr( "filesize" );
                                var strPush = strSize + "-" + strName ;

                                if( $('#delete_img').val() == ''){
                                    deleteImgs = strPush;
                                } else {
                                    deleteImgs = $('#delete_img').val() + ';' + strPush;
                                }

                                $('#delete_img').val(deleteImgs);

                                $(this).parent('.abcd').remove();
                            }
                        });
                    };
                })(f);

                reader.readAsDataURL(f);
                crrfile.hide();
            };
        }
    });

    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});
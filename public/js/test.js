/*
inputにファイルが選択された時にアップロードする。
アップロードをクリックした時に動作させるためにはchangeをclickにする。
$(document).onはあとから追加した要素にも対応させるため。
*/
$(document).on('change','input[name="hoge"]',function(){
  var fd = new FormData();
  if ($("input[name='hoge']").val()!== '') {
    fd.append( "file", $("input[name='hoge']").prop("files")[0] );
  }
  fd.append("dir",$("#hoge").val());
  var postData = {
    type : "POST",
    dataType : "text",
    data : fd,
    processData : false,
    contentType : false
  };
  $.ajax(
    "ajax/index.php", postData
  ).done(function( text ){
    console.log(text);
  });
});
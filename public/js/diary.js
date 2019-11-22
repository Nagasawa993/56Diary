$(document).on('click','.js-like',function(){

  //いいねされた日記のIDを取得
  //$(this) : 今回クリックされたiタグ(ハートマーク)
  //.siblings('XXX') : 兄弟要素を取得する
  //val() : inputタグのvalueの値を取得する
  let diaryId = $(this).siblings('.diary-id').val();

  //likeメソッドを実行
  like(diaryId, $(this));
});

//diaryId : いいねする日記のID
//clickedBtn : 今回クリックされたいいねアイコン
function like(diaryId, clickedBtn){

  $.ajax({
    url: 'diary/' + diaryId + '/like',
    type:'POST',
    datatype:'json',
    //CSRF対策のため、tokenを送信する
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }

  }).done((data)=>{
    console.log(data);
    //いいねの数を増やそう
    //1.現在のいいね数を取得
    //2.1プラスした結果を設定する
    //text() : <a>XXX</a> XXXの部分を取得
    let num = clickedBtn.siblings('.js-like-num').text();

    //numを数値に変換する
    num = Number(num);

    //いいねのボタンデザインを変更
    //text(YYY) : <a>XXX</a> XXXの部分をYYYに置き換える。
    clickedBtn.siblings('.js-like-num').text(num+1);

    //いいね
    changeLikeBtn(clickedBtn);
  }).fail((error)=>{
    console.log(error);
  });

}

//btn : 色を変えたいいいねアイコン
//js-like, js-dislikeの切り替え
function changeLikeBtn(btn){
  btn.toggleClass('far');
  btn.toggleClass('fas');
  btn.toggleClass('js-like');
  btn.toggleClass('js-dislike');
}

//いいね解除の処理
$(document).on('click','.js-dislike',function(){
    //いいね処理された日記のID取得
    let diaryId = $(this).siblings('.diary-id').val();

    //dislikeメソッドの実行
    dislike(diaryId,$(this));

});





function dislike(diaryId, clickedBtn){

    $.ajax({
        url: 'diary/' + diaryId + '/dislike',
        type:'POST',
        datatype:'json',
        //CSRF対策のため、tokenを送信する
        headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }

    }).done((data)=>{
    console.log(data);
    //いいねの数を減らす
    //1.現在のいいね数を取得
    //2.1プラスした結果を設定する
    //text() : <a>XXX</a> XXXの部分を取得
    let num = clickedBtn.siblings('.js-like-num').text();

    //numを数値に変換する
    num = Number(num);

    //いいねのボタンデザインを変更
    //text(YYY) : <a>XXX</a> XXXの部分をYYYに置き換える。
    clickedBtn.siblings('.js-like-num').text(num-1);

    //いいね
    changeLikeBtn(clickedBtn);
  }).fail((error)=>{
    console.log(error);
  });

}
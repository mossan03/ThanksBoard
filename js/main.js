$(document).ready(function(){
    $('.accordion h2').on('click', function(){
        $(this).next().toggleClass('hidden');
    });
});


let logout = document.querySelector('#logout');
logout.addEventListener('click', function() {
let result = window.confirm('ログアウトしますか？');
    if (result) {
        document.location.href = "logout.php";
    }
})

let deleteId = document.querySelector('#deleteId');
deleteId.addEventListener('click', function() {
let result = window.confirm('退会されますと、再度会員登録することはできません。本当に退会しますか？');
    if (result) {
        document.location.href = "delete.php";
    }
})
// ham lay id va dieu huong den trang tim kiem
function search(){
    const param = document.getElementById('search').value;
    const name=document.getElementById('hide_name').value;
    // alert('Please enter a valid search');
    if(param){
        window.location.href='http://localhost:8080/ommani/learn/phrases1/index.php?cat='+name+'&view=search&param='+param+'&page=1';
    }else{
        alert('Please enter a valid search');
    }
    
};
// 
function deleteKey(id){
    if (confirm("Are you sure you want to delete this item?")) {
        // Nếu người dùng chọn OK, submit form
        window.location.assign('http://localhost:8080/ommani/learn/phrases1/index.php?cat=students&view=delete&id='+id);
    };
}
// 
// 
function handleId(){
    input=document.getElementById('student-id');
    if(input.hasAttribute('readonly')){
        input.removeAttribute('readonly');
        input.removeAttribute('disabled');
        input.focus();
    }else{
        input.value = '';
        input.setAttribute('readonly', true);
        input.setAttribute('disabled', true);
    }
}
// doi dom load
document.addEventListener('DOMContentLoaded',()=>{
    const btn = document.getElementById('search-btn');
    btn.addEventListener('click',search);
    const handBtn=document.getElementById('handle-id');
    handBtn.addEventListener('click',handleId);
})
// 

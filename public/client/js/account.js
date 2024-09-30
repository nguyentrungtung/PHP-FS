document.addEventListener('DOMContentLoaded',async ()=>{
    view= document.getElementById('account_view');
    changView(view);
}) 
async function getView(element,view){
    await fetch(`/fetch/account/`+view).then(response => response.text())
    .then(html=>{
        element.innerHTML=html;
    }).catch(e=>console.log(e));
}

// 
function changView(view){
    const tabs=document.querySelectorAll('.account_nav_item');
    tabs.forEach(tab => {
        tab.addEventListener('click',async ()=>{
            page=tab.getAttribute('data-page');
            if(page==='logout'){
                return
            }
            if(page==='bill'){
                await getView(view,page);
                await render();
                return ;
            }
            if(page==='accountDetail'){
                await getView(view,page);
                return ;
            }
            getView(view,page);
        })
    })
}
// 
async function render(){
    data=[];
    const row=document.getElementById('bill_rows');
    // console.log(row);
    // if(data.length==0){
    //     await getView(row,'null_bill');
    // }
}

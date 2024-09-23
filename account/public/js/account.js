document.addEventListener('DOMContentLoaded',async ()=>{
    view= document.getElementById('account_view');
    await getView(view,'accountDetail');
    accountSet();
    changView(view);
}) 
async function getView(element,view){
    await fetch(`./views/${view}.html`).then(response => response.text())
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
                accountSet();
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
// 
function accountSet(){
    const main_tab=document.getElementById('main-view-btn');
    const second_tab=document.getElementById('second-view-btn');
    const main=document.getElementById('main-view');
    const second=document.getElementById('second-view');
    const move=document.querySelector('.move');
    main_tab.addEventListener('click',()=>{
        move.style.left="0px"
        main_tab.classList.add('active');
        second_tab.classList.remove('active');
        main.classList.add('hidden');
        second.classList.remove('hidden');
    })
    second_tab.addEventListener('click',()=>{
        move.style.left="140px";
        main_tab.classList.remove('active');
        second_tab.classList.add('active');
        main.classList.remove('hidden');
        second.classList.add('hidden');
    })
    
}
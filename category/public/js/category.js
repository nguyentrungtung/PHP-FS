document.addEventListener("DOMContentLoaded",()=>{
    const title_btn=document.getElementById("title_btn");
    const list_subcat=document.getElementById("list_subcat");
    const sublist=document.getElementById('sublits');
    const brand_btn=document.getElementById("brand_btn");
    const brand_list_logo=document.getElementById("brand_list_logo");
    const list_content=document.getElementById("list_content");
    drop(title_btn,list_subcat,sublist,count1);
    drop(brand_btn,brand_list_logo,list_content,count2);
    fillter();
    brandFillter();
    changeCat();
});
// 
function count1(list){
    return list.childElementCount*50+'px'
}
function count2(list){
    console.log(Array.from(list.children)[0].childElementCount);
    return Math.ceil((Array.from(list.children)[0].childElementCount)/2)*80+50+'px'
}
function drop(btn,element,list,cb){
    btn.addEventListener("click",()=>{
        btn.classList.toggle("dropdown");
        list.classList.toggle("hidden");
        if(btn.classList.contains("dropdown")){
            element.style.height= cb(list);
            return;
        }
        element.style.height='0px';
    })
}
// 
function fillter(){
    const list=document.querySelectorAll('.fillter_detai');
    list.forEach(fill => {
        fill.addEventListener("click",(e)=>{
            const check=removeFill(e.target);
            if(!check){
                fill.classList.add("active");
            }
        });
    });
}
function removeFill(current){
    let check=false;
    const list=document.querySelectorAll('.fillter_detai');
    list.forEach(fill => {
        if(fill.classList.contains("active")){
            check=fill===current?true:false;
        }
        fill.classList.remove("active");
    });
    return check;
}
// 
function reload(){
    const brand_list=document.getElementById("brand_list");
    return Array.from(brand_list.children);
}
// 
function brandFillter(){
    const brand_fills=document.querySelectorAll('.brand_fill');
    const brand_logos=document.querySelectorAll('.brand_logo');
    const d_bnt=document.getElementById("delete");
    let list=reload();
    brand_logos.forEach(element => {
        // console.log(element.getAttribute('data-value'));
        element.addEventListener('click',(e)=>{
            let check = true;
            e.target.classList.toggle('active');
            const html=`<div data-id=\"${e.target.getAttribute('data-id')}\" class=\"brand_fill\"\>${e.target.getAttribute('data-value')} x</div>`
            if(!e.target.classList.contains("active")){
                list=list.filter(item=>item.getAttribute('data-id')!==e.target.getAttribute('data-id'));
                check=false;
            }
            const arr=list.map(item=>item.outerHTML);
            if(check) arr.push(html);
            brand_list.innerHTML=arr.join('');
            list=reload();
        })    
    });
    d_bnt.addEventListener('click',()=>{
        brand_logos.forEach(element => {
            if(element.classList.contains('active')){
                element.classList.remove('active');
            }
            
        });
        brand_list.innerHTML='';
        list=reload();
    });
}
//
function remove(list,arr,current){
    let check=false;
    list.forEach(item=>{
        if(item.classList.contains("active")){
            check=item===current?true:false;
            arr=arr.filter(value=>value!=item.getAttribute('data-value'));
        }
        
        item.classList.remove("active");
    })
    console.log(arr);
    return [arr,check];
    // console.log(list);
 
} 
// 

function changeCat(){
    const url=document.getElementById('category_url');
    const list=document.querySelectorAll('.subcat_title');
    let chooseArr=url.innerHTML.split(' / ');
    console.log(list);
    list.forEach(item=>{
        item.addEventListener('click',(e)=>{
            const [arr,check]=remove(list,chooseArr,e.target);
            chooseArr=arr;
            if(!check){
                e.target.classList.add('active');
                chooseArr.push(e.target.getAttribute('data-value'));
            }
            url.innerHTML=chooseArr.join(' / ');
        })
    })
}
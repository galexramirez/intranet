$(document).ready(function(){
    f_capitulo('inicio');
})

function f_capitulo(p_capitulo){
    let t_md = p_capitulo+'.md';
    let capitulo = document.querySelector("#div_capitulo");

    let md = fetch("Module/manual/Controller/"+t_md).then((response)=>response.text()).then(text => {
        let converter = new showdown.Converter();
        let html = converter.makeHtml(text);
        capitulo.innerHTML = html;
    });
        
}

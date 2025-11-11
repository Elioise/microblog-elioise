'use strict';
 
/* Selecionar todos os links de excluir */
const links = document.querySelectorAll('.excluir');
 
console.log(links);
 
for(const link of links){
    link.addEventListener("click", function (event){
        //anular o comportamento padrão do evento
        event.preventDefault();
 
        let resposta = confirm("Deseja realmente excluir este registro?")
 
        //se a rsposta for TRUE
        if(resposta){
            // Redirecionamos para o endereço (href) do link
            location.href = link.href;  
        }
       
    })
}
 
 
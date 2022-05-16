const suppr = document.querySelectorAll('.suppr')
for(let s of suppr){
    s.addEventListener('click',(e)=>{
        if(confirm('Confirmer la suppression')){
            alert('Entrée supprimée');
        }else{
            e.preventDefault()
        }
    })
}
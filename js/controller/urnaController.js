import Candidato from "../model/candidato";


class urnaController{
    constructor(){
        this.criarCandidato()
    }
    criarCandidato(){
        let candidato = new Candidato('Wolverine', 'Garras de adamantium','35', 'diretorio')

        console.log(candidato)
    }
}

window.app = new urnaController()